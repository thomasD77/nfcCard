@canany(['is_superAdmin', 'is_admin'])
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
                    Add Event
                </button>
                <!-- Modal -->
                <style>
                    .modal {
                        background-color: rgba(0, 0, 0, 0.5);
                        width: 100%;
                        aspect-ratio: 1;

                    }

                    .modal-content {
                        margin-top: 30%;
                    }
                </style>
                <div class="modal fade" wire:ignore.self id="addEvent" tabindex="-1" aria-labelledby="addEventModal"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ADD EVENT</h5>
                                <button type="button" class="btn-close" id="btn-event-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="addEvent(Object.fromEntries(new FormData($event.target)))" id="addEventForm"
                                      class="d-flex align-center justify-content-center flex-column">
                                    <div class="form-group mb-4">
                                        <label for="locationName" class="form-label">Name:</label>
                                        <input type="text" class="form-control" name="name" id="locationName" />
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="locationDate" class="form-label">Date:</label>
                                        <input type="date" class="form-control" name="date" id="locationDate" value="{{date("Y-m-d",time())}}" min="{{date("Y-m-d",time())}}" />
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="locationRemark" class="form-label">Remark:</label>
                                        <textarea name="remark" class="form-control" id="locationRemark" ></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary mt-1" id="submit-button" type="submit" data-bs-toggle="modal" data-bs-target="#addEvent">SAVE</button>
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
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Date</th>
                        <th scope="col">Remark</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($locations)
                        @foreach($locations as $location)
                            <tr>
                                <td>{{$location->name}}</td>
                                <td>{{$location->date}}</td>
                                <td>{{$location->remark}}</td>
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

                                        <!-- Update Event button & modal -->
                                        <a>
                                            <button type="button"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="modal" title=""
                                                    data-bs-target="#updateEvent{{$location->id}}">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                        </a>
                                        <div class="modal fade" wire:ignore.self id="updateEvent{{$location->id}}"
                                             tabindex="-1"
                                             aria-labelledby="updateEventModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">UPDATE EVENT: "{{$location->name}}"</h5>
                                                        <button type="button" class="btn-close" id="btn-event-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form wire:submit.prevent="updateEvent({{$location->id}}, Object.fromEntries(new FormData($event.target)))" id="updateEvent{{$location->id}}"
                                                              class="d-flex align-center justify-content-center flex-column">
                                                            <div class="form-group mb-4">
                                                                <label for="locationName{{$location->id}}" class="form-label">Name:</label>
                                                                <input type="text" class="form-control" name="name" id="locationName{{$location->id}}" value="{{$location->name}}" />
                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <label for="locationDate{{$location->id}}" class="form-label">Date:</label>
                                                                <input type="date" class="form-control" name="date" id="locationDate{{$location->id}}" value="{{$location->date}}" min="{{date("Y-m-d",time())}}"" />
                                                            </div>
                                                            <div class="form-group mb-4">
                                                                <label for="locationRemark{{$location->id}}" class="form-label">Remark:</label>
                                                                <textarea name="remark" class="form-control" id="locationRemark{{$location->id}}" {{$location->remark}} ></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary mt-1" id="submit-button" type="submit" data-bs-target="#updateEvent{{$location->id}}" data-bs-toggle="modal">SAVE</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete Event button & modal -->
                                        <a>
                                            <button type="button"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteEvent{{$location->id}}">
                                                <i class="fa fa-fw fa-trash-alt"></i>
                                            </button>
                                        </a>
                                        <div class="modal fade" wire:ignore.self id="deleteEvent{{$location->id}}"
                                             tabindex="-1"
                                             aria-labelledby="deleteEventModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form wire:submit.prevent="deleteEvent({{$location->id}})"
                                                          id="deleteEventForm{{$location->id}}"
                                                          class="d-flex align-center justify-content-center flex-column">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="DeleteEventLabel">DELETE
                                                                EVENT</h5>
                                                            <button type="button" class="btn-close"
                                                                    id="btn-event-close-delete"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                    </form>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this event?</p>
                                                        <div class="delete-event-buttons">
                                                            <button id="delete-button" form="deleteEventForm{{$location->id}}" class="btn btn-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteEvent{{$location->id}}">Yes
                                                            </button>
                                                            <button id="delete-decline-button"
                                                                    class="btn btn-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteEvent{{$location->id}}">No
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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
    </div>
@endcanany


