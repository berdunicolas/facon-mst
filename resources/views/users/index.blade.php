<x-app-layout
    :cssSheets="[
        'resources/datatables/datatables.min.css',
        'resources/css/custom-datatable.css'
    ]"

    :jsScriptsToEnd="[
        'resources/js/users-datatable.js'
    ]"

    :apiRoutes="[
        'usersApi' => route('api.users.index'),
        'newUserApi' => route('api.users.store'),
    ]"
>
    <x-slot name="sectionName">
        {{__('Users')}}
    </x-slot>

    <x-slot name="sectionId">users</x-slot>
    
    <main class="container flex-grow-1 p-4">
        <header class="py-5">
            <h5 class="display-5 header-section">{{__('Users')}}</h5>
        </header>
        <x-table 
            id="users-datatable" 
            :columns="[__('#'), __('Fullname'), __('Email'), __('Action')]"
            modalTarget="#new-user-modal"
        />
    </main>
    <div id="new-user-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-light rounded-1">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('Create new user')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="new-user-form" action="{{route('api.users.store')}}" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">{{__('Fullname')}}</label>
                            <input type="text" name="name" class="form-control bg-light">
                        </div>
                        <div class="mb-3">
                            <label for="name">{{__('Email')}}</label>
                            <input type="email" name="email" class="form-control bg-light">
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button id="btn-close-new-user-modal" type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                            <button type="submit" class="btn btn-primary ms-2">{{__('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="edit-user-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-light rounded-1">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('Edit user')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="user-edit-form" action="" method="UPDATE">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">{{__('Fullname')}}</label>
                            <input type="text" id="name-edit-field" name="name" class="form-control bg-light">
                        </div>
                        <div class="mb-3">
                            <label for="name">{{__('Email')}}</label>
                            <input type="email" id="email-edit-field" name="email" class="form-control bg-light">
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button id="btn-close-edit-user-modal" type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                            <button type="submit" class="btn btn-primary ms-2">{{__('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="delete-user-modal" class="modal fade" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light rounded-1">
                <div class="modal-header border-0 align-items-start">
                    <h1 class="modal-title fs-5" id="modal-title"></h1>
                    <h1 class="visually-hidden" id="modal-title-aux">{{__('Are you sure you want to delete {name}?')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>{{__('The data will be permanently lost.')}}</p>
                    <div class="d-flex justify-content-end mt-4">
                        <button id="close-delete-user-modal" type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                        <button id="confirm-user-delete" type="submit" class="btn btn-danger ms-2">{{__('Delete')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>