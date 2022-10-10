@canany(['is_superAdmin', 'is_admin'])
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
                <!-- Search Form (visible on larger screens) -->
                <form class="d-none d-md-inline-block col-6">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-alt" placeholder="Search for name..." id="page-header-search-input2" wire:model="name">
                    </div>
                </form>
                <!-- END Search Form -->
                <label class="d-flex">
                    <button wire:click="addEvent" class="btn btn-secondary rounded" type="button" data-bs-toggle="tooltip" title="Add Event">Add Event</button>

                </label>
            </div>

            <div class="block-content block-content-full overflow-scroll">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Date</th>
                        <th scope="col">Remark</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($locations)
                        @foreach($locations as $location)
                            <tr>
                                <td>{{$location->name}}</td>
                                <td>{{$location->date}}</td>
                                <td>{{$location->remark}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
@endcanany


