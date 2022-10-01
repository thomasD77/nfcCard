<div>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="row block-header block-header-default" style="background-color: transparent">

            <!-- Back to list-->
            <div class="col-6 col-md-1">
                <a href="{{route('contacts.index')}}">
                    <button class="btn btn-secondary rounded mx-lg-2" data-bs-toggle="tooltip" title="Back to list">
                        <i class="far fa-list-alt "></i>
                    </button>
                </a>
            </div>
            <!-- End Back to list-->

            <!-- Pagination Select-->
            <div class="col-6 d-flex justify-content-end col-md-1">
                <select wire:model="pagination" style="width: 80px" class="form-select" aria-label="Default select example">
                    <option value="5">5</option>
                    <option value="20">20</option>
                    <option selected value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <!-- End Pagination -->

            <!-- Datepicker  -->
            <div class="col-md-10 my-4 my-md-0">
                <div class="row justify-content-end">
                    <div class="col-md-9 d-flex">
                        <label class="d-flex align-items-center text-muted d-none d-md-block pt-2" style="font-size: 10px">DAY</label>
                        <input style="width: 65px" wire:model="datepicker_day" class="form-control" type="number" max="31" min="1">
                        <label class="d-flex align-items-center text-muted ms-1 d-none d-md-block pt-2" style="font-size: 10px">MONTH/YEAR</label>
                        <input wire:model="datepicker" id="datepicker" type="month" class="form-control" id="" name="" placeholder="Select date contact" data-inline="month" data-enable-time="false">
                        <button wire:click="dateALL" class="btn btn-secondary rounded" type="button" data-bs-toggle="tooltip" title="Refresh"><i class="si si-refresh"></i></button>
                    </div>
                </div>
            </div>
            <!-- Datepicker  -->
        </div>

        <div class="block-content block-content-full overflow-scroll">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">phone</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($contacts)
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->name ? $contact->name : 'No Name'}}</td>

                            <td><a style="{{$contact->email ? '' : 'color:black'}}" href="mailto:{{$contact->email ? $contact->email : '#'}}"> {{$contact->email ? $contact->email : 'x'}}</a></td>

                            <td><a style="{{$contact->phone ? '' : 'color:black'}}" href="{{$contact->phone ? $contact->phone : '#'}}">{{$contact->phone ? $contact->phone : 'x'}}</a></td>

                            <td>{{$contact->created_at ? \Carbon\Carbon::parse($contact->created_at)->format('d-M-Y') : 'x'}}</td>

                            <td>
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
