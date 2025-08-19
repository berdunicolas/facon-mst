import '../datatables/datatables.min';
/*
const buttons = {
    btn: document.createElement('button').className('btn btn-sm btn-light',
    btnEdit: '<button class="btn btn-sm btn-light"><i class="bi bi-pencil-square color-primary"></i></button>',
    btnDelete: '<button class="btn btn-sm btn-light"><i class="bi bi-trash color-danger"></i></button>',
    btnView: '',
}*/
 
let table = new DataTable('#users-datatable', {
    processing: true,
    serverSide: true,
    ajax: {
        url: window.API_ROUTES.usersApi,
        dataSrc: 'data',
        beforeSend: function(xhr) {
            xhr.setRequestHeader('Accept', 'application/json');
        },
        xhrFields: {
            withCredentials: true
        }
    },
    //ordering: false,
    columnControl: ['searchDropdown', 'order'],
    columnDefs: [
        {target: 0, columnControl: ['order']},
        {target: -1, columnControl: []}
    ],
    columns: [
        { data: 'id', name: "id", type: 'string'},
        { data: 'name', name: "name" },
        { data: 'email', name: "email" },
        { data: 'actions', name: "actions",
            render: function (data, type, row) {

                let div = document.createElement("div");
                div.className = "d-flex flex-nowrap";

                if(data.can_edit){
                    div.innerHTML += `<button id="dt-row-action-edit" class="btn btn-light btn-sm mx-1" data-url=${data.url} data-name="${row.name}" data-email="${row.email}"><i class="bi bi-pencil-square text-primary"></i></button>`;
                }
                if(data.can_delete){
                    div.innerHTML += `<button id="dt-row-action-delete" class="btn btn-light btn-sm mx-1" data-url="${data.url}" data-name="${row.name}"><i class="bi bi-trash text-danger"></i></button>`;
                }
                
                return div;
            }
        },
    ],
    layout: { topStart: {}, topEnd: {}, bottomStart: {}, bottomEnd: {} },
});


function pageInfoRefresh() {
    let pageInfo = table.page.info();

    $('#dt-entries-part').html(pageInfo.length);
    $('#dt-total-entries').html(pageInfo.recordsDisplay);

    let $paging = $('#dt-paging');
    $paging.find('.page-number').remove();

    let currentPage = pageInfo.page + 1;
    let totalPages = pageInfo.pages;

    function addButton(num, active = false) {
        let $btn = $('<button>', {
            class: 'btn btn-light page-number' + (active ? ' active' : ''),
            text: num,
            click: function () {
                table.page(num - 1).draw('page');
            }
        });
        $btn.insertBefore('#dt-to-next-page');
    }

    function addEllipsis() {
        $('<span>', {
            class: 'btn btn-light disabled page-number',
            html: '&hellip;'
        }).insertBefore('#dt-to-next-page');
    }

    let range = 1;

    addButton(1, currentPage === 1);

    if (currentPage > range + 2) addEllipsis();

    let start = Math.max(2, currentPage - range);
    let end = Math.min(totalPages - 1, currentPage + range);

    for (let i = start; i <= end; i++) addButton(i, currentPage === i);

    if (currentPage < totalPages - (range + 1)) addEllipsis();

    if (totalPages > 1) addButton(totalPages, currentPage === totalPages);

    // Flechas
    $('#dt-to-first-page').off().on('click', () => table.page(0).draw('page'));
    $('#dt-to-last-page').off().on('click', () => table.page(totalPages - 1).draw('page'));
    $('#dt-to-previous-page').off().on('click', () => table.page('previous').draw('page'));
    $('#dt-to-next-page').off().on('click', () => table.page('next').draw('page'));
}

// Refrescar siempre tras dibujar
table.on('draw.dt', pageInfoRefresh);

// Page length
$('#dt-length').on('change', function () {
    table.page.len(this.value).draw();
});

// Searcher con debounce
let searchTimeout;
$('#dt-searcher').on('keyup', function () {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        table.search(this.value).draw();
    }, 300);
});


document.getElementById('new-user-form').addEventListener("submit", function (e) {
    e.preventDefault();
    const form = e.target
    const data = Object.fromEntries((new FormData(form)).entries());
    const closeModal = document.getElementById('btn-close-new-user-modal');

    fetch(form.action, {
        method: form.method,
        credentials: 'include',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
        
    })
    .then(async response => {
        const statusCode = response.status;
        const text = await response.text();
        const data = text ? JSON.parse(text) : {};
        return ({ statusCode, data });
    })
    .then(({statusCode, data}) => {
        if(statusCode === 201){
            table.ajax.reload();
            closeModal.click();
        } else {
            console.error(data);
        }
    })
    .catch(error => console.error('Error:', error));
});


$('#users-datatable tbody').on('click', '#dt-row-action-edit', function () {
    const url = $(this).data('url');
});


let url = null;

document.getElementById('confirm-user-delete').addEventListener('click', function() {
    request(url, 'DELETE', null, 204, function () {
        table.ajax.reload();
        document.getElementById('close-delete-user-modal').click();
    });
});

document.getElementById('user-edit-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target
    const data = Object.fromEntries((new FormData(form)).entries());

    request(url, 'PUT', JSON.stringify(data), 200, function () {
        table.ajax.reload();
        document.getElementById('btn-close-edit-user-modal').click();
    });
});

$('#users-datatable tbody').on('click', '#dt-row-action-delete', function () {
    url = $(this).data('url');
    const name = $(this).data('name');
    const modalDom = document.getElementById('delete-user-modal');
    const delModal = bootstrap.Modal.getOrCreateInstance(modalDom);

    let title = modalDom.querySelector('#modal-title');
    let titleAux = modalDom.querySelector('#modal-title-aux');

    title.innerHTML = titleAux.innerHTML.replace('{name}', name);

    delModal.show();

});

$('#users-datatable tbody').on('click', '#dt-row-action-edit', function () {
    url = $(this).data('url');
    const name = $(this).data('name');
    const email = $(this).data('email');
    const modalDom = document.getElementById('edit-user-modal');
    const editModal = bootstrap.Modal.getOrCreateInstance(modalDom);

    let nameInput = modalDom.querySelector('#name-edit-field');
    let emailInput = modalDom.querySelector('#email-edit-field');

    nameInput.value = name;
    emailInput.value = email;

    editModal.show();

});


function request(url, method, data, code, callback){
    fetch(url, {
        method: method,
        credentials: 'include',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: data
    })
    .then(async response => {
        const statusCode = response.status;
        const text = await response.text();
        const data = text ? JSON.parse(text) : {};
        return ({ statusCode, data });
    })
    .then(({statusCode, data}) => {
        if(statusCode === code){
            callback();
        } else {
            console.error(data, "error");
        }
    })
    .catch(error => console.error('Error:', error));
}