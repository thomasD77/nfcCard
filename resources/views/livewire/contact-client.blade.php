<div>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-header block-header-default row px-0 py-3 px-md-3">

            <!-- Search Form  -->
            <form class="col-md-6">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-alt" placeholder="Search for name..." id="page-header-search-input2" wire:model="name">
                </div>
            </form>
            <!-- END Search Form -->

            <!-- Datepicker  -->
{{--            <label class="d-flex p-2 col-md-4">--}}
{{--                <input style="width: 65px" wire:model="datepicker_day"  class="form-control" type="number" max="31" min="1">--}}
{{--                <input wire:model="datepicker" id="datepicker" type="month" class="form-control" id="" name="" placeholder="Select date contact" data-inline="month" data-enable-time="false">--}}
{{--                <button wire:click="dateALL" class="btn btn-secondary rounded" type="button" data-bs-toggle="tooltip" title="Refresh"><i class="si si-refresh"></i></button>--}}
{{--            </label>--}}
            <!-- Datepicker  -->

            <label class="d-flex p-2 justify-content-md-end col-md-2">
                <a href="{{route('contact.archive-clients', Auth()->user() )}}">
                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Archive">
                        <i class="fa fa-archive "></i>
                    </button>
                </a>
                <a href="{{ route('print.scans.client') }}" class="btn btn-alt-success">
                    <i class="fa fa-print me-2"></i>
                </a>
            </label>
        </div>

        <!-- Table Mobile -->
        <div class="d-md-none block-content block-content-full overflow-scroll px-1">
            <!-- Pagination Select-->
            <div class="d-flex justify-content-md-end">
                <select wire:model="pagination" style="width: 80px" class="form-select " aria-label="Default select example">
                    <option value="5">5</option>
                    <option value="20">20</option>
                    <option selected value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <!-- End Pagination -->

            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Details</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($contacts)
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->name ? $contact->name : 'No Name'}}</td>
                            <td><!-- Button trigger modal -->
                                <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$contact->id}}">
                                    <img src="{{ asset('images/content/swap_log.png') }}" alt="logo" class="img-fluid">
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" wire:ignore.self id="exampleModal{{$contact->id}}" wire:key="{{ $contact->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">SCAN DETAILS</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if($contact->name)
                                                    <p><strong>Name:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->name ? $contact->name : 'No Name'}}</p>
                                                @endif

                                                @if($contact->email)
                                                    <p><strong>Email:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->email ? $contact->email : 'No email'}}</p>
                                                @endif

                                                @if($contact->phone)
                                                    <p><strong>Phone:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->phone ? $contact->phone : 'No Phone'}}</p>
                                                @endif

                                                @if($contact->company)
                                                    <p><strong>Company:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->company ? $contact->company : ''}}</p>
                                                @endif

                                                @if($contact->VAT)
                                                    <p><strong>VAT:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->VAT ? $contact->VAT : ''}}</p>
                                                @endif

                                                @if($contact->notes)
                                                    <p><strong>Message:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->message ? $contact->message : 'No message'}}</p>
                                                @endif

                                                <p class="mb-2"><strong>Status</strong></p>
                                                {{--                                                {!! Form::select('statusses',$statusses,null,['class'=>'form-control', 'placeholder' => 'Select here...'])!!}--}}

                                                <select name="status" wire:model="status" wire:change="contact({{ $contact }})" class="form-control">
                                                    <option value=''>choose status</option>
                                                    @foreach($statusses as $status)
                                                        <option value={{ $status->id }}>{{ $status->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if($contact->created_at)
                                                    <p><strong>Created at:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->created_at ? $contact->created_at : 'No date'}}</p>
                                                @endif

                                                <hr>

                                                <div class="d-flex justify-content-between mb-2">
                                                    <p><strong>My notes:</strong></p> <button class="btn btn-sm btn-primary" wire:click="showNotes"> <i  class="fa fa-fw fa-pencil-alt"></i></button>
                                                </div>
                                                <p class="bg-light p-2">{{$contact->notes ? $contact->notes : 'No notes'}}</p>
                                            </div>
                                            @if($showNotes)
                                                <div class="modal-body">
                                                    <form wire:submit.prevent="saveNote({{ $contact }})">
                                                        <textarea type="text" class="form-control form-control-alt" placeholder="Type your note..." id="page-header-search-input2" wire:model="notes"></textarea>
                                                        <button class="btn btn-primary mt-1" type="submit" >SAVE</button>
                                                    </form>
                                                </div>
                                            @endif
                                            <div class="card-body d-flex justify-content-end">
                                                <button type="button" class=" btn btn-primary p-2 m-3" data-bs-dismiss="modal" aria-label="Close">Thanks</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-alt-secondary" wire:click="archiveContact({{$contact->id}})"><i class="fa fa-archive "></i></button>
                                </div>
                                <div class="btn-group">
                                    @if(in_array($contact->id, $ids))
                                        <button class="btn btn-sm btn-alt-success"><i class="fa fa-check"></i></button>
                                    @else
                                        <button class="btn btn-sm btn-alt-info" wire:key="{{ $contact->id }}" wire:click="toggleToContact({{$contact->id}})"><i class="far fa-address-book "></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>

        <!-- Table Desktop -->
        <div class="d-none d-md-block block-content block-content-full overflow-scroll px-1">
            <!-- Pagination Select-->
            <div class="d-flex justify-content-md-end">
                <select wire:model="pagination" style="width: 80px" class="form-select " aria-label="Default select example">
                    <option value="5">5</option>
                    <option value="20">20</option>
                    <option selected value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <!-- End Pagination -->

            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">phone</th>
                    <th class="text-center" scope="col">Details</th>
                    <th scope="col">Status</th>
                    <th scope="col">Registered</th>
                    <th scope="col">Actions</th>

                </tr>
                </thead>
                <tbody>
                @if($contacts)
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->name ? $contact->name : 'No Name'}}</td>
                            <td><a href="mailto:{{$contact->email}}"> {{$contact->email ? $contact->email : 'No Email'}}</a></td>
                            <td>{{$contact->phone ? $contact->phone : 'No Phone'}}</td>
                            <td class="text-center"><!-- Button trigger modal -->
                                <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$contact->id}}">
                                    <img src="{{ asset('images/content/swap_log.png') }}" alt="logo" class="img-fluid" width="80" height="80">
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" wire:ignore.self id="exampleModal2{{$contact->id}}" wire:key="{{ $contact->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">SCAN DETAILS</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if($contact->name)
                                                    <p><strong>Name:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->name ? $contact->name : 'No Name'}}</p>
                                                @endif

                                                @if($contact->email)
                                                    <p><strong>Email:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->email ? $contact->email : 'No email'}}</p>
                                                @endif

                                                @if($contact->phone)
                                                    <p><strong>Phone:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->phone ? $contact->phone : 'No Phone'}}</p>
                                                @endif

                                                @if($contact->company)
                                                    <p><strong>Company:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->company ? $contact->company : ''}}</p>
                                                @endif

                                                @if($contact->VAT)
                                                    <p><strong>VAT:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->VAT ? $contact->VAT : ''}}</p>
                                                @endif

                                                @if($contact->notes)
                                                    <p><strong>Message:</strong></p>
                                                    <p class="bg-light p-2">{{$contact->message ? $contact->message : 'No message'}}</p>
                                                @endif

                                                <p class="mb-2"><strong>Status</strong></p>
                                                {{--                                                {!! Form::select('statusses',$statusses,null,['class'=>'form-control', 'placeholder' => 'Select here...'])!!}--}}

                                                <select name="status" wire:model="status" wire:change="contact({{ $contact }})" class="form-control">
                                                    <option value=''>choose status</option>
                                                    @foreach($statusses as $status)
                                                        <option value={{ $status->id }}>{{ $status->name }}</option>
                                                    @endforeach
                                                </select>

                                                <hr>

                                                <div class="d-flex justify-content-between mb-2">
                                                    <p><strong>My notes:</strong></p> <button class="btn btn-sm btn-primary" wire:click="showNotes"> <i  class="fa fa-fw fa-pencil-alt"></i></button>
                                                </div>
                                                <p class="bg-light p-2">{{$contact->notes ? $contact->notes : 'No notes'}}</p>
                                            </div>
                                            @if($showNotes)
                                                <div class="modal-body">
                                                    <form wire:submit.prevent="saveNote({{ $contact }})">
                                                        <textarea type="text" class="form-control form-control-alt" placeholder="Type your note..." id="page-header-search-input2" wire:model="notes"></textarea>
                                                        <button class="btn btn-primary mt-1" type="submit" >SAVE</button>
                                                    </form>
                                                </div>
                                            @endif
                                            <div class="card-body d-flex justify-content-end">
                                                <button type="button" class=" btn btn-primary p-2 m-3" data-bs-dismiss="modal" aria-label="Close">Thanks</button>
                                            </div>
                                        </div>
                                    </div>

                                </div></td>
                            <td>
                                @if($contact->contactStatus)

                                    <span class="badge badge-pill

                                            @if($contact->contactStatus->id == 1) bg-dark
                                            @elseif($contact->contactStatus->id == 2) bg-amethyst-lighter
                                            @elseif($contact->contactStatus->id == 3) bg-amethyst-light
                                            @elseif($contact->contactStatus->id == 4) bg-warning-light
                                            @elseif($contact->contactStatus->id == 5) bg-success
                                            @endif p-2">
                                            {{ $contact->contactStatus->name }}
                                    </span>

                                @else

                                    no status

                                @endif
                            </td>
                            <td>{{$contact->created_at ? \Carbon\Carbon::parse($contact->created_at)->format('Y-M-d') : 'No Date'}}</td>                                <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-alt-secondary" wire:click="archiveContact({{$contact->id}})"><i class="fa fa-archive "></i></button>
                                </div>
                                <div class="btn-group">
                                    @if(in_array($contact->id, $ids))
                                        <button class="btn btn-sm btn-alt-success"><i class="fa fa-check"></i></button>
                                    @else
                                        <button class="btn btn-sm btn-alt-info" wire:key="{{ $contact->id }}" wire:click="toggleToContact({{$contact->id}})"><i class="far fa-address-book "></i></button>
                                    @endif
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

