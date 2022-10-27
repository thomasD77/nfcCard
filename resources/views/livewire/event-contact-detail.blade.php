<div>
    <div class="block-content block-content-full overflow-scroll">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
        @if(count($contacts) > 0)
        <table class="table table-striped table-hover table-vcenter fs-sm">
            <thead>
            <tr>
                <th scope="col">Contact name</th>
                <th scope="col">Contact email</th>
                <th scope="col">Contact phone</th>
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
                            {{$contact->contact->email}}
                        </td>
                        <td>
                            {{$contact->contact->phone}}
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
                                    <div class="modal-content">
                                        <form wire:submit.prevent="deleteContactFromEvent({{$contact->location->id}},{{$contact->contact->id}})"
                                              id="deleteEventForm{{$contact->contact->id}}"
                                              class="d-flex align-center justify-content-center flex-column">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="DeleteEventLabel">DELETE
                                                    CONTACT FROM EVENT</h5>
                                                <button type="button" class="btn-close"
                                                        id="btn-event-close-delete"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </form>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this event?</p>
                                            <div class="delete-event-buttons">
                                                <button id="delete-button" form="deleteEventForm{{$contact->contact->id}}" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteEvent{{$contact->contact->id}}">Yes
                                                </button>
                                                <button id="delete-decline-button"
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
        @else
            <p>No contacts found for this event</p>
        @endif
    </div>
</div>
