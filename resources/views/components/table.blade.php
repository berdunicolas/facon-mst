<div class="d-flex justify-content-between mb-3">
    <div class="bg-light rounded-1 shadow p-1 d-flex">
        <select name="" class="form-sm-select bg-light border-0" id="dt-length">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="75">75</option>
            <option value="100">100</option>
        </select>
        <span class="text-nowrap my-auto mx-2">{{__('entries per page')}}</span>
    </div>
    <div class="d-flex w-25">
        <div class="bg-light shadow rounded-1 flex-grow-1 me-2 p-1 d-flex">
            <div class="flex-grow-1">
                <x-input id="dt-searcher" class="bg-light form-control-sm border-0 focus-ring focus-ring-light" type="text" placeholder="{{__('Search...')}}" />
            </div>
            <span class="align-middle p-1 mx-2">
                <i class="bi bi-search fs-6"></i>
            </span>
        </div>
        <div class="d-flex shadow">
            <button type="button" class="btn btn-sm btn-light btn-lg rounded-1 font-size-1" data-bs-toggle="modal" data-bs-target="{{$modalTarget}}">
                <i class="bi bi-plus-lg fs-6 px-1"></i>
            </button>
        </div>
    </div>
</div>


<div class="rounded-1 bg-light p-2 shadow overflow-auto" style="min-height: 150px; max-height: 65vh">
    @if($columns)
        <table id="{{$id}}" class="table table-hover table-sm table-borderless">
            <thead class="">
                <tr id="table-head">
                @foreach ($columns as $column)
                    <th scope="col" class="pb-3">{{$column}}</th>
                @endforeach
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>
    @else
        <table class="table table-sm table-borderless">
            <tbody>
                <tr class="text-center">
                    <td>Sin contenido...</td>
                </tr>
            </tbody>
        </table>
    @endif
</div>

<div class="d-flex justify-content-between mt-3">
    <div class="p-2">
        <p class="mb-0">
            {{__('Showing')}} 1 {{__('to')}} <span id="dt-entries-part"></span> {{__('of')}} <span id="dt-total-entries"></span> {{__('entries')}}
        </p>
    </div>

    <div class="btn-group ms-auto shadow" id="dt-paging">
        <button class="btn btn-light" role="link" type="button" id="dt-to-first-page">
            <i class="bi bi-chevron-double-left"></i>
        </button>
        <button class="btn btn-light" role="link" type="button" id="dt-to-previous-page">
            <i class="bi bi-chevron-left"></i>
        </button>      
        {{-- Los botones numericos se insertan dinamicamente | Number buttons are inserted dynamically --}}
        <button class="btn btn-light" role="link" type="button" id="dt-to-next-page">
            <i class="bi bi-chevron-right"></i>
        </button>
        <button class="btn btn-light" role="link" type="button" id="dt-to-last-page">
            <i class="bi bi-chevron-double-right"></i>
        </button>
    </div>
</div>