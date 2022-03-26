<div>

    <!-- Dynamic Table Full -->
    <div class="block block-rounded row">
        <div class="block-header block-header-default">
            <div>
                <!-- Pagination Select-->
                <select wire:model="pagination" style="width: 80px" class="form-select mb-3 d-flex justify-content-end" aria-label="Default select example">
                    <option value="5">5</option>
                    <option value="20">20</option>
                    <option selected value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <!-- End Pagination -->
            </div>
            <label class="d-flex">
                <input wire:model="datepicker" id="datepicker" type="date" class="form-control" id="" name="" placeholder="Select date contact" data-inline="month" data-enable-time="false">
                <button wire:click="dateALL" class="btn btn-secondary rounded" type="button" data-bs-toggle="tooltip" title="Refresh"><i class="si si-refresh"></i></button>
                <a href="{{route('contacts.index.client')}}">
                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="List">
                        <i class="far fa-list-alt "></i>
                    </button>
                </a>
            </label>
        </div>
        <div class="block-content block-content-full overflow-scroll">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">phone</th>
                    <th scope="col">Registered</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($contacts)
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->name ? $contact->name : 'No Name'}}</td>
                            <td><a href="mailto:{{$contact->mail}}"> {{$contact->email ? $contact->email : 'No Email'}}</a></td>
                            <td>{{$contact->phone ? $contact->phone : 'No Phone'}}</td>
                            <td>{{$contact->created_at ? \Carbon\Carbon::parse($contact->created_at)->format('Y-M-d') : 'No Date'}}</td>                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-alt-secondary" wire:click="unArchiveContact({{$contact->id}})"><i class="si si-refresh"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $contacts->links()  !!}
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
