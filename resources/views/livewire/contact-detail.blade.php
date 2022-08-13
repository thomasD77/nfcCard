<div>
    <!-- Page Content -->
    <div class="content">
        <!-- Quick Actions -->
        <div class="row">
            <div class="col-md-6">
                <a class="block block-rounded block-link-shadow text-center">
                    <div class="block-content block-content-full" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$contact->id}}">
                        <div class="fs-2 fw-semibold text-dark py-1 py-md-0">
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
                                        <div class="form-group mb-4">
                                            <p class="mb-2 mt-4" style="text-align: left"><strong>Email:</strong></p>
                                            <input type="email"  value="{{ $contact->email }}" name="email" class="form-control">
                                            @error('email')
                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endif

                                    @if($contact->phone)
                                        <div class="form-group mb-4">
                                            <p class="mb-2 mt-4" style="text-align: left"><strong>Phone:</strong></p>
                                            <input type="phone"  value="{{ $contact->phone }}" name="phone" class="form-control">
                                            @error('phone')
                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                            @enderror
                                        </div>
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
                    <div class="mb-3 row justify-content-center">
                        @if($member)
                            <img class="rounded-circle" width="150" height="150" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}">
                        @else
                            <img class="rounded-circle" width="150" height="150" src="{{ asset('/assets/front/img/Avatar-4.svg') }}" alt="">
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
                        <a class="link-fx fs-3 text-primary" >{{ $notes }}</a>
                    </div>
                    <div class="col-md-3">
                        <div class="fw-semibold text-dark mb-1">Events</div>
                        <a class="link-fx fs-3 text-primary" >{{ $events }}</a>
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
                                <a class="btn btn-sm btn-alt-secondary me-3" href="{{ route('contact.vCard', $contact->id) }}">
                                    <i class="fa fa-fw fa-phone"></i>
                                </a>
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
                                    <div class="row w-100 ">
                                        <div class="col-10">
                                            <h3 class="block-title">SWAP Account</h3>
                                        </div>
                                        <div class="col-2 d-flex justify-content-end px-0">
                                            <a class="btn btn-sm btn-alt-secondary me-3" href="{{ route('members.vCard', $member->card_id) }}">
                                                <i class="fa fa-fw fa-phone"></i>
                                            </a>
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

                                        @if($member->addressLine1)
                                            {{ $member->addressLine1 }}<br>
                                        @endif

                                        @if($member->city){{ $member->city }},@endif @if($member->postalCode){{ $member->postalCode }},@endif

                                        @if($member->country)
                                            {{ $member->country }}<br><br>
                                        @endif
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

        <div class="row">
            <div class="col-lg-6">
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
            </div>
            <div class="col-lg-6">
                <!-- Short Note -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Short Note</h3>
                        <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalShortNotes{{$contact->id}}">
                            <i class="si si-pencil"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalShortNotes{{$contact->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContactsController@updateShortNoteContact',$contact->id]]) !!}
                                        <textarea type="text"
                                                  class="form-control"
                                                  placeholder="Type your note..."
                                                  rows="4"
                                                  name="notes"
                                        >{{ $contact->notes }}</textarea>
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
                    <div class="block-content p-2 p-lg-4">
                        {{ $contact->notes }}
                    </div>
                </div>
                <!-- END Message -->
            </div>
        </div>


    @livewire('contact-detail-reffered-members', [ 'contact' => $contact ])

    @livewire('contact-detail-events', [ 'contact' => $contact ])

    @livewire('contact-detail-notes', [ 'contact' => $contact ])

    </div>
    <!-- END Page Content -->
</div>
