<div>
    <!-- Page Content -->
    <div class="content">
        <!-- Quick Actions -->
        <div class="row">
            <div class="col-md-6">
                <a class="block block-rounded block-link-shadow text-center mb-0">
                    <div class="block-content block-content-full" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$contact->id}}">
                        <div class="fs-2 fw-semibold text-dark">
                            <i class="fa fa-pencil-alt"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light"   type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$contact->id}}">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Edit Contact
                        </p>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" wire:ignore.self id="exampleModal{{$contact->id}}" wire:key="{{ $contact->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">SCAN DETAILS</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContactsController@updateContact',$contact->id]]) !!}
                                    @if($contact->name)
                                        <div class="form-group mb-4">
                                            <p class="mb-2 mt-4" style="text-align: left"><strong>Name:</strong></p>
                                            <input type="text"  value="{{ $contact->name }}" name="name" class="form-control">
                                            @error('name')
                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endif

                                    @if($contact->email)
                                        <p class="mb-2 mt-4" style="text-align: left"><strong>Email:</strong></p>
                                        <p class="bg-light p-2">{{$contact->email ? $contact->email : 'No email'}}</p>
                                    @endif

                                    @if($contact->phone)
                                        <p class="mb-2 mt-4" style="text-align: left"><strong>Phone:</strong></p>
                                        <p class="bg-light p-2">{{$contact->phone ? $contact->phone : 'No Phone'}}</p>
                                    @endif

                                    @if($contact->company)
                                        <p class="mb-2 mt-4" style="text-align: left"><strong>Company:</strong></p>
                                        <p class="bg-light p-2">{{$contact->company ? $contact->company : ''}}</p>
                                    @endif

                                    @if($contact->VAT)
                                        <p class="mb-2 mt-4" style="text-align: left"><strong>VAT:</strong></p>
                                        <p class="bg-light p-2">{{$contact->VAT ? $contact->VAT : ''}}</p>
                                    @endif

                                    @if($contact->notes)
                                        <p class="mb-2 mt-4" style="text-align: left"><strong>Message:</strong></p>
                                        <p class="bg-light p-2">{{$contact->message ? $contact->message : 'No message'}}</p>
                                    @endif

                                    <p class="mb-2 mt-4" style="text-align: left"><strong>Status:</strong></p>

                                    <div class="form-group mb-4">
                                        {!! Form::label('one-profile-edit-roles', 'choose status:', ['class'=>'form-label']) !!}
                                        {!! Form::select('status',$statusses,$contact->status_id,['class'=>'form-control',])!!}
                                    </div>

                                    <p class="mb-2 mt-4" style="text-align: left"><strong>Sector:</strong></p>

                                    <div class="form-group mb-4">
                                        {!! Form::label('one-profile-edit-roles', 'choose sector:', ['class'=>'form-label']) !!}
                                        {!! Form::select('sector',$sectors,$contact->sector_id,['class'=>'form-control',])!!}
                                    </div>

                                    <div class="card-body d-flex justify-content-end">
                                        <button type="submit" class=" btn btn-primary p-2 m-3">Update</button>
                                    </div>

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 mt-3 mt-md-0">
                <a class="block block-rounded block-link-shadow text-center" >
                    <div class="block-content block-content-full" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer">
                        <div class="fs-2 fw-semibold text-danger">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer">
                        <p class="fw-medium fs-sm text-danger mb-0">
                            Remove Contact
                        </p>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Remove Contact</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this contact account? All the information will be lost forever.
                                </div>
                                <div class="modal-footer" >
                                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                    <a wire:click="deleteContact"  class="btn btn-danger">DELETE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Quick Actions -->

        <!-- User Info -->
        <div class="block block-rounded">
            <div class="block-content text-center">
                <div class="py-4">
                    <div class="mb-3">
                        @if($member)
                            <td><img class="rounded-circle" height="150" width="150" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                        @else
                            <td><img class="rounded-circle" height="150" width="150" src="{{ asset('/assets/front/img/Avatar-4.svg') }}" alt=""></td>
                        @endif
                    </div>
                    <h1 class="fs-lg mb-0">
                        <span>{{ $contact->name }}</span>
                    </h1>
                    @if($member)
                        <p class="fs-sm fw-medium text-muted">{{ $member->jobTitle }}</p>
                    @endif
                </div>
            </div>
            <div class="block-content bg-body-light text-center">
                <div class="row items-push text-uppercase">
                    <div class="col-md-3">
                        <div class="fw-semibold text-dark mb-1">SWAP DATE</div>
                        <a class="link-fx fs-3 text-primary" >{{ $contact->created_at->format('d-M-Y') }}</a>
                    </div>
                    @if($contact->sector)
                        <div class="col-md-3">
                            <div class="fw-semibold text-dark mb-1">Sector</div>
                            <a class="link-fx fs-3 text-primary" >{{ $contact->sector ? $contact->sector->name : "" }}</a>
                        </div>
                    @endif
                    <div class="col-md-3">
                        <div class="fw-semibold text-dark mb-1">Notes</div>
                        <a class="link-fx fs-3 text-primary" >{{ $notes ? $notes->count() : 0 }}</a>
                    </div>
                    <div class="col-md-3">
                        <div class="fw-semibold text-dark mb-1">Events</div>
                        <a class="link-fx fs-3 text-primary" >{{ $contact->events ? $contact->events->count() : 0 }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END User Info -->

        <!-- Addresses -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Addresses</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-6 pb-4">
                        <!-- Contact information -->
                        <div class="block block-rounded block-bordered" style="height: 100%">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Contact information</h3>
                            </div>
                            <div class="block-content">
                                <div class="fs-4 mb-1">{{ $contact->name }}</div>
                                <address class="fs-sm">

                                    @if($contact->phone)
                                        <i class="fa fa-phone mb-2"></i> {{ $contact->phone }}<br>
                                    @endif
                                    @if($contact->email)
                                        <i class="far fa-envelope mb-2"></i> <a href="mailto:{{$contact->email}}">{{ $contact->email }}</a><br>
                                    @endif
                                    @if($contact->company)
                                        <i class="fa fa-building mb-2"></i> {{ $contact->company }}<br>
                                    @endif
                                    @if($contact->VAT)
                                        <i class="far fa-bookmark mb-2"></i> {{ $contact->VAT }}<br>
                                    @endif
                                </address>
                            </div>
                        </div>
                        <!-- END Contact information -->
                    </div>
                    <div class="col-lg-6 pb-4">
                    @if($member)
                        <!-- Member-->
                            <div class="block block-rounded block-bordered" style="height: 100%">
                                <div class="block-header border-bottom">
                                    <div class="row w-100">
                                        <div class="col-10">
                                            <h3 class="block-title">SWAP Account</h3>
                                        </div>
                                        <div class="col-2 d-flex justify-content-end">
                                            <a class="btn btn-sm btn-alt-secondary" target="_blank" href="{{ $member->memberURL }}" data-bs-toggle="tooltip" title="Profile">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="fs-4 mb-1">{{ $member->firstname }} {{ $member->lastname }}</div>
                                    <address class="fs-sm">
                                        @if($member->mobile)
                                            <i class="fa fa-phone mb-2"></i>{{ $member->mobile }}<br>
                                        @endif
                                        @if($member->mobileWork)
                                            <i class="fa fa-phone mb-2"></i>{{ $member->mobileWork }}<br>
                                        @endif
                                        <i class="far fa-envelope mb-2"></i> <a href="mailto:{{$member->email}}">{{ $member->email }}</a><br>

                                        {{ $member->addressLine1 }}<br>
                                        {{ $member->city }}, {{ $member->postalCode }}<br>
                                        {{ $member->country }}<br><br>

                                    </address>
                                </div>
                            </div>
                            <!-- END Member -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END Addresses -->

    @if($contact->message)
        <!-- Message -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Message</h3>
                </div>
                <div class="block-content p-2 p-lg-4">
                    {{ $contact->message }}
                </div>
            </div>
            <!-- END Message -->
    @endif

    @if(!$referred_members == [])
        <!-- Referred Members -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Referred Members</h3>
                </div>
                <div class="block-content">
                    <div class="row items-push">
                        @foreach($referred_members as $member)
                            <div class="col-md-4">
                                <!-- Referred User -->
                                <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0" href="{{ $member->memberURL }}" target="_blank">
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="fw-semibold mb-1">{{ $member->firstname }} {{ $member->lastname }}</div>
                                            <div class="fs-sm text-muted">{{ $member->jobTitle }}</div>
                                        </div>
                                        <div class="ms-3">
                                            <td><img class="rounded-circle" height="80" width="80" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                                        </div>
                                    </div>
                                </a>
                                <!-- END Referred User -->
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-center my-4 pb-4">
                    {{ $referred_members->links() }}
                </div>

            </div>
            <!-- END Referred Members -->
    @endif

    <!-- Events -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Events</h3>
            </div>
            <div class="block-content">

                @if($events)
                    @foreach($events as $event)
                        <div class="card shadow my-3" style="border: none">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-9 py-2 mt-4">
                                        {{ $event->name }}
                                    </div>
                                    <div class="col-lg-2 d-none d-lg-block text-center py-2 mt-4">
                                        <strong>{{ \Carbon\Carbon::parse($event->date)->format('d-M-Y') }}</strong>
                                    </div>
                                    <div class="col-lg-1 d-flex justify-content-end py-2 mt-4">
                                        <div>
                                            <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalNotes{{$event->id}}">
                                                <i class="si si-pencil"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalNotes{{$event->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContactsController@updateEventContact',$event->id]]) !!}
                                                            <div class="my-4 col-md-4">
                                                                <label for=""><strong>When?</strong></label>
                                                                <input type="date"
                                                                       class="form-control"
                                                                       name="date"
                                                                       value="{{ $event->date }}"
                                                                >
                                                                @error('date')
                                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="my-4">
                                                                <label for=""><strong>Where?</strong></label>
                                                                <textarea type="text"
                                                                          class="form-control"
                                                                          placeholder="Type your location/memories"
                                                                          rows="4"
                                                                          name="event"
                                                                >{{ $event->name }}</textarea>
                                                                @error('event')
                                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="my-4">
                                                                <button type="submit" class="btn btn-alt-primary">Update</button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminContactsController@deleteEventContact',$event->id]]) !!}
                                            <button type="submit" class="btn btn-sm btn-alt-danger"  data-bs-toggle="tooltip" title="Delete">
                                                <i class="fa fa-fw fa-times text-danger"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="d-flex justify-content-center my-4">
                    {{ $events->links() }}
                </div>


                <p class="alert alert-dark fs-sm">
                    <i class="fa fa-fw fa-info me-1"></i> From where/when do you know this contact?
                </p>

                {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminContactsController@createEventContact',$contact->id]]) !!}

                <div class="my-4 col-md-4">
                    <label for=""><strong>When?</strong></label>
                    <input type="date"
                           class="form-control"
                           name="date"
                    >
                    @error('date')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="my-4">
                    <label for=""><strong>Where?</strong></label>
                    <textarea type="text"
                              class="form-control"
                              placeholder="Type your location/memories"
                              rows="4"
                              name="event"
                    ></textarea>
                    @error('event')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <button type="submit" class="btn btn-alt-primary">Add Event</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <!-- END Events -->

        <!-- Private Notes -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Private Notes</h3>
            </div>
            <div class="block-content">

                @if($notes)
                    @foreach($notes as $note)
                        <div class="card shadow my-3" style="border: none">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-9 py-2 mt-4">
                                        {{ $note->name }}
                                    </div>
                                    <div class="col-lg-2 d-none d-lg-block text-center py-2 mt-4">
                                        <strong>{{ $note->created_at->format('d-M-Y') }}</strong>
                                    </div>
                                    <div class="col-lg-1 d-flex justify-content-end py-2 mt-4">
                                        <div>


                                            <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalNotes{{$note->id}}">
                                                <i class="si si-pencil"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalNotes{{$note->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContactsController@updateNoteContact',$note->id]]) !!}
                                                            <textarea type="text"
                                                                      class="form-control"
                                                                      placeholder="Type your note..."
                                                                      rows="4"
                                                                      name="notes"
                                                            >{{ $note->name }}</textarea>
                                                            @error('notes')
                                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                                            @enderror

                                                            <div class="my-4">
                                                                <button type="submit" class="btn btn-alt-primary">Update</button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminContactsController@deleteNoteContact',$note->id]]) !!}
                                            <button type="submit" class="btn btn-sm btn-alt-danger"  data-bs-toggle="tooltip" title="Delete">
                                                <i class="fa fa-fw fa-times text-danger"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="d-flex justify-content-center my-4">
                    {{ $notes->links() }}
                </div>

                <p class="alert alert-dark fs-sm">
                    <i class="fa fa-fw fa-info me-1"></i> These notes will not be displayed to the customer.
                </p>

                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContactsController@createNoteContact',$contact->id]]) !!}

                <div class="my-4">
                <textarea type="text"
                          class="form-control"
                          placeholder="Type your note..."
                          rows="4"
                          name="notes"
                ></textarea>
                    @error('notes')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-alt-primary">Add Note</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <!-- END Private Notes -->
    </div>
    <!-- END Page Content -->
</div>
