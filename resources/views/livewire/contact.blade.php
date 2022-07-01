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
                    <div>
                        <label class="mb-0 mx-2">Day:</label>
                    </div>
                    <input style="width: 65px" wire:model="datepicker_day"  class="form-control" type="number" max="31" min="1">
                    <input wire:model="datepicker" id="datepicker" type="month" class="form-control" id="" name="" placeholder="Select date contact" data-inline="month" data-enable-time="false">
                    <button wire:click="dateALL" class="btn btn-secondary rounded" type="button" data-bs-toggle="tooltip" title="Refresh"><i class="si si-refresh"></i></button>
                    <a href="{{route('contact.archive')}}">
                        <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Archive">
                            <i class="fa fa-archive "></i>
                        </button>
                    </a>
                    <a href="{{ route('print.scans') }}" class="btn btn-alt-success">
                        <i class="fa fa-print me-2"></i>
                    </a>
                </label>
            </div>
            <div class="block-content block-content-full overflow-scroll">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        <th scope="col">CARD Holder</th>
                        <th scope="col">CARD Holder Company</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Details</th>
                        <th scope="col">Registered</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($contacts)
                        @foreach($contacts as $contact)
                            <tr>
                                <td><strong>{{$contact->member ? $contact->member->lastname : ''}} {{$contact->member ? $contact->member->firstname : ''}}</strong></td>
                                <td><strong>{{$contact->member ? $contact->member->company : ''}}</strong></td>
                                <td>{{$contact->name ? $contact->name : 'No Name'}}</td>
                                <td><a href="mailto:{{$contact->mail}}"> {{$contact->email ? $contact->email : 'No Email'}}</a></td>
                                <td><!-- Button trigger modal -->
                                    <button type="button" class="btn btn-alt-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{$contact->id}}">
                                        SWAP
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$contact->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">SCAN DETAILS</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Name:</strong></p>
                                                    <p>{{$contact->name ? $contact->name : 'No Name'}}</p>
                                                    <p><strong>Email:</strong></p>
                                                    <p>{{$contact->email ? $contact->email : 'No email'}}</p>
                                                    <p><strong>Phone:</strong></p>
                                                    <p>{{$contact->phone ? $contact->phone : 'No Phone'}}</p>
                                                    <p><strong>Message:</strong></p>
                                                    <p>{{$contact->message ? $contact->message : 'No message'}}</p>
                                                    <hr>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <p><strong>My notes:</strong></p> <button class="btn btn-primary" wire:click="showNotes"> <i  class="fa fa-fw fa-pencil-alt"></i></button>
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
                                            </div>
                                        </div>
                                    </div></td>
                                <td>{{$contact->created_at ? \Carbon\Carbon::parse($contact->created_at)->format('Y-M-d') : 'No Date'}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-alt-secondary" wire:click="archiveContact({{$contact->id}})"><i class="fa fa-archive "></i></button>
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
@endcanany


