<div>

    <div class="block-content block-content-full overflow-scroll">
        <div class="row">
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
        <div class="row">
            <div class="col-md-8">
                <strong>{{ $location->remark }}</strong>
            </div>
            <div class="col-md-2">
                <strong>{{ $location->date }}</strong>
            </div>
            <div class="col-md-2 text-end">
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
                        <div class="modal-content" style="margin-top: 30%">
                            <div class="modal-header" style="background-color: #1F2A37">
                                <h5 class="modal-title text-white" id="exampleModalLabel">UPDATE EVENT</h5>
                                <button type="button" class="btn-close btn-close-white" id="btn-event-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="updateEvent({{ $location }})" id="updateEvent{{$location->id}}"
                                      class="d-flex align-center justify-content-center flex-column">
                                    <div class="form-group mb-4 text-start">
                                        <label for="locationName{{$location->id}}" class="form-label text-start">Name:</label>
                                        <input type="text" class="form-control" wire:model="ev_name" id="locationName{{$location->id}}" />
                                    </div>
                                    <div class="form-group mb-4 text-start">
                                        <label for="locationDate{{$location->id}}" class="form-label">Date:</label>
                                        <input type="date" class="form-control" wire:model="date" id="locationDate{{$location->id}}"/>
                                    </div>
                                    <div class="form-group mb-4 text-start">
                                        <label for="locationRemark{{$location->id}}" class="form-label">Remark:</label>
                                        <textarea wire:model="remark" class="form-control" id="locationRemark{{$location->id}}"> {{$remark}}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary mt-1" id="submit-button" style="background-color: #1F2A37" type="submit" data-bs-target="#updateEvent{{$location->id}}" data-bs-toggle="modal">UPDATE</button>
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
                        <div class="modal-content" style="margin-top: 30%;">
                            <form wire:submit.prevent="deleteEvent({{$location->id}})"
                                  id="deleteEventForm{{$location->id}}"
                                  class="d-flex align-center justify-content-center flex-column">
                                <div class="modal-header" style="background-color: #1F2A37">
                                    <h5 class="modal-title text-white" id="DeleteEventLabel">DELETE
                                        EVENT</h5>
                                    <button type="button" class="btn-close btn-close-white"
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
                                            class="btn btn-primary" style="background-color: #1F2A37" data-bs-toggle="modal"
                                            data-bs-target="#deleteEvent{{$location->id}}">No
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
    </div>


    <div class="block-content block-content-full overflow-scroll">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
        @if(count($contacts) > 0)
        <table class="table table-striped table-hover table-vcenter fs-sm">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>
                            {{$contact->contact->name}}
                        </td>
                        <td>
                            <a href="mailto:{{$contact->contact->email}}">{{$contact->contact->email}}</a>
                        </td>
                        <td>
                            <a href="tel:{{$contact->contact->phone}}">{{$contact->contact->phone}}</a>
                        </td>
                        <td>
                            <a href="{{route("contact.detail", $contact->contact->id)}}">
                                <button type="button"
                                        class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                        data-bs-toggle="tooltip" title=""
                                        data-bs-original-title="Show event">
                                    <i class="far fa-eye"></i>
                                </button>
                            </a>
                            <a>
                                <button type="button"
                                        class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteEvent{{$contact->contact->id}}">
                                    <i class="fa fa-fw fa-trash-alt"></i>
                                </button>
                            </a>
                            <div class="modal fade" wire:ignore.self id="deleteEvent{{$contact->contact->id}}"
                                 tabindex="-1"
                                 aria-labelledby="deleteEventModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="margin-top: 30%">
                                        <form wire:submit.prevent="deleteContactFromEvent({{$contact->location->id}},{{$contact->contact->id}})"
                                              id="deleteEventForm{{$contact->contact->id}}"
                                              class="d-flex align-center justify-content-center flex-column">
                                            <div class="modal-header" style="background-color: #1F2A37">
                                                <h5 class="modal-title text-white" id="DeleteEventLabel">DELETE
                                                    CONTACT FROM EVENT</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                        id="btn-event-close-delete"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </form>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this contact from this event?</p>
                                            <div class="delete-event-buttons">
                                                <button id="delete-button" form="deleteEventForm{{$contact->contact->id}}" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteEvent{{$contact->contact->id}}">Yes
                                                </button>
                                                <button id="delete-decline-button"
                                                        style="background-color: #1F2A37"
                                                        class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#deleteEvent{{$contact->contact->id}}">No
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $contacts->links() }}
        </div>
        @else
            <p>No contacts found for this event</p>
        @endif
    </div>
</div>
