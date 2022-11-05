
    <div>
        <!-- Dynamic Table Full -->
        <div class="block block-rounded row">
            <div class="block-header block-header-default">
                <div>
                    <!-- Pagination Select-->
                    <select wire:model="pagination" style="width: 80px"
                            class="form-select mb-3 d-flex justify-content-end" aria-label="Default select example">
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
                        <input type="text" class="form-control form-control-alt" placeholder="Search for name..."
                               id="page-header-search-input2" wire:model="name">
                    </div>
                </form>
                <!-- END Search Form -->
                <button type="button" class="btn btn-secondary rounded" data-bs-toggle="modal"
                        data-bs-target="#addEvent">
                    <i class="fa fa-plus"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" wire:ignore.self id="addEvent" tabindex="-1" aria-labelledby="addEventModal"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="margin-top: 30%">
                            <div class="modal-header" style="background-color: #1F2A37">
                                <h5 class="modal-title text-white" id="exampleModalLabel">ADD EVENT</h5>
                                <button type="button" class="btn-close btn-close-white" id="btn-event-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="addEvent" id="addEventForm"
                                      class="d-flex align-center justify-content-center flex-column">
                                    <div class="form-group mb-4">
                                        <label for="locationName" class="form-label">Name:</label>
                                        <input type="text" class="form-control" wire:model="ev_name" id="locationName" />
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="locationDate" class="form-label">Date:</label>
                                        <input type="date" class="form-control" wire:model="date" id="locationDate" value="{{date("Y-m-d",time())}}"/>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="locationRemark" class="form-label">Remark:</label>
                                        <textarea wire:model="remark" class="form-control" id="locationRemark" ></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary mt-1" id="submit-button" type="submit" style="background-color: #1F2A37" data-bs-toggle="modal" data-bs-target="#addEvent">SAVE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block-content block-content-full overflow-scroll">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($locations)
                        @foreach($locations as $location)
                            <tr>
                                <td>{{$location->name}}</td>
                                <td>{{$location->date}}</td>
                                <td>
                                    <div class="btn-group">
                                        <!-- view Event button -->
                                        <a href="{{route("event.detail", $location->id)}}">
                                            <button type="button"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title=""
                                                    data-bs-original-title="Show event">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
        <div class="d-flex justify-content-center">
            {{ $locations->links() }}
        </div>
    </div>



