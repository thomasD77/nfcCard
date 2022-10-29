<div>
    <div class="block block-rounded row">
        <div class="block-content block-content-full overflow-scroll">
            <div class="d-flex justify-content-between mb-5">
                <div class="d-flex">
                    <!-- Pagination Select-->
                    <select wire:model="pagination" style="width: 80px" class="form-select mb-3 d-flex justify-content-end" aria-label="Default select example">
                        <option value="5">5</option>
                        <option value="20">20</option>
                        <option selected value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                        <option value="500">500</option>
                    </select>
                    <!-- End Pagination -->

                    <div>
                        <button wire:click="toggleBulk" type="button" class="btn btn-alt-primary mx-3">
                            <i class="fa fa-chart-line mx-1 opacity-50"></i> BULK
                        </button>
                    </div>
                </div>

                <!-- Search Form (visible on larger screens) -->
                <div class="d-none d-md-inline-block col-6">
                    <input type="text" wire:model="filter" class="form-control form-control-alt" placeholder="Search for webshop id/user/reservation..." id="page-header-search-input2">
                </div>
                <!-- END Search Form -->

                <div>
                    <label class="d-flex">
                        <input style="width: 62px" wire:model="datepicker_day"  class="form-control" type="number" max="31" min="1">
                        <input wire:model="datepicker" id="datepicker" type="month" class="form-control" id="" name="" placeholder="Select date contact" data-inline="month" data-enable-time="false">
                        <button wire:click="dateALL" class="btn btn-secondary rounded" type="button" data-bs-toggle="tooltip" title="Refresh"><i class="si si-refresh"></i></button>
                    </label>
                </div>

                <div>


                    @if($urls->first() != null )
                        <a href="{{ route('card-credentials-sheet-generator', $urls->first()->team_id) }}" class="btn btn-alt-success" data-bs-toggle="tooltip" title="Supplier">
                            <i class="fa fa-print me-2"></i>
                        </a>
                    @endif

                    @if($urls->first() != null )
                        <a href="{{ route('print.list' , $urls->first()->team_id) }}" class="btn btn-alt-primary" data-bs-toggle="tooltip" title="Teamleader">
                            <i class="fa fa-copy me-2"></i>
                        </a>
                    @endif

                    @if($urls->first() != null )
                        <a href="{{ route('print.marketing')}}" class="btn btn-alt-warning" data-bs-toggle="tooltip" title="Mailchimp">
                            <i class="fab fa-mailchimp me-2"></i>
                        </a>
                    @endif

                </div>
            </div>
            <div class="parent">

                @include('admin.includes.flash')

                @if($bulk)
                    <div class="card shadow mb-5" style="border: none">
                        <form class="mb-0 card-body" name="contactformulier"
                              action="{{action('App\Http\Controllers\Dashboard\CardListGenerator@bulkSelectListUrl')}}" method="post">
                            @csrf

                            <div class="row">

                                <div class="form-check m-4 px-0 col-md-5">
                                    <label class="form-check-label mb-1">Reservation</label>
                                    <input class="form-control" type="text" name="reservation" value="">

                                    <input class="form-control" type="hidden" name="team" value="{{ $team->id }}">
                                </div>

                                <div class="form-check m-4 px-0 col-md-5">
                                    <label class="form-check-label mb-1">Design</label>
                                    <input class="form-control" type="text" name="design" value="">
                                </div>

                                <div class="form-check m-4 px-0 col-md-5">
                                    {!! Form::label('roles','Select role:', ['class'=>'form-label']) !!}
                                    {!! Form::select('roles',$roles,null,['class'=>'form-control', 'placeholder' => 'Select here...'])!!}
                                </div>

                                <div class="form-check m-4 px-0 col-md-5">
                                    {!! Form::label('materials','Select material:', ['class'=>'form-label']) !!}
                                    {!! Form::select('materials',$materials,null,['class'=>'form-control', 'placeholder' => 'Select here...'])!!}
                                </div>

                                <div class="form-check m-4 px-0 col-md-5">
                                    {!! Form::label('types','Select type:', ['class'=>'form-label']) !!}
                                    {!! Form::select('types',$types,null,['class'=>'form-control', 'placeholder' => 'Select here...'])!!}
                                </div>

                                @if($urls->first()->type_id == 8)
                                    <div class="form-check m-4 px-0 col-md-5">
                                        {!! Form::label('date','Select end trial date:', ['class'=>'form-label']) !!}
                                        {!! Form::date('date', now(),['class'=>'form-control'])!!}
                                    </div>
                                @endif

                            </div>


                            <!-- Button trigger modal -->
                            <button type="submit" class="btn btn-alt-primary m-4">
                                <i class="fa fa-arrow-circle-up me-1 opacity-50"></i> UPDATE
                            </button>

                        </form>

                        @if($urls->first() != null )
                            <div class="form-check d-flex justify-content-end m-4">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info mx-3" data-bs-toggle="modal" data-bs-target="#exampleModalKeep">
                                    KEEP/RESET
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalKeep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabelKeep">Keep User/ Reset Card</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the CARD ID on this member?
                                                This way the URL with this card ID will be available again.
                                                But the USER ACC will not be lost.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="{{ route('keep.bulk') }}" class="btn btn-info">RESET</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <label style="cursor: pointer" class="form-label">Bulk delete user accounts?</label>
                                </a>
                                <div class="collapse mx-5" id="collapseExample">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        DELETE/RESET
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete User(s)/ Reset Card</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this user account? All the information will be lost forever.
                                                    The card data for this user will be deleted as well.
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('bulk.delete', $urls->first()->team_id) }}" class="btn btn-danger">DELETE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                @endif

                <table class="table table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>

                        <th scope="col">User</th>

                        <th scope="col">Role</th>

                        <th scope="col">Material</th>

                        <th scope="col">#Card ID</th>

                        <th scope="col">Design</th>

                        <th scope="col">Type</th>

                        <th scope="col">Reservation</th>

                        <th scope="col">Date</th>

                        <th scope="col">Edit</th>

                        @can('is_superAdmin')
                            <th scope="col"> <i class="fa fa-print me-2"></i>
                                <input type="checkbox"
                                       @if($checkbox_active) checked @endif
                                       class="btn btn-sm btn-alt-secondary"
                                       wire:click="selectAll">
                            </th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @if($urls)
                        @foreach($urls as $url)
                            @if(!isset($url->member->user->name))
                                <tr class="bg-warning-light">
                            @else
                                <tr class="">
                                    @endif

                                    @if(isset($url->member->user))
                                        @if($url->member->user->archived == 1)
                                            <td><span class="rounded-pill btn-alt-warning p-2">archived</span></td>
                                        @else
                                            <td><a href="{{ route('users.edit', $url->member->user->id) }}">{{ $url->member->user->name }}</a></td>
                                        @endif
                                    @else
                                        <td> {...} </td>
                                    @endif

                                    @if(isset($url->member->user))
                                        @if($url->member->user->archived == 1)
                                            <td><span class="rounded-pill btn-alt-warning p-2">archived</span></td>
                                        @else
                                            <td>{{$url->listRole ? $url->listRole->name : "{...}" }}</td>
                                        @endif
                                    @else
                                        <td>{{$url->listRole ? $url->listRole->name : "{...}" }}</td>
                                    @endif

                                    <td>{{$url->material ? $url->material->name : "No Material" }}</td>

                                    <td>{{$url->card_id ? $url->card_id : 'No ID'}}</td>

                                    <td>{{$url->image ? $url->image : "*no image" }}</td>


                                    <td class="my-2 ms-3
                                    @if($url->listType)
                                        badge badge-pill w-75
                                    @if($url->listType->id == 1) bg-dark
                                            @elseif($url->listType->id == 2) bg-amethyst
                                            @elseif($url->listType->id == 3) bg-flat
                                            @elseif($url->listType->id == 4) bg-warning
                                            @elseif($url->listType->id == 5) bg-info
                                            @elseif($url->listType->id == 6) bg-success
                                            @elseif($url->listType->id == 7) bg-smooth
                                            @elseif($url->listType->id == 8) bg-danger
                                            @endif
                                    @endif
                                        ">{{$url->listType ? $url->listType->name  : "..." }} <br> <span class="my-5">{{ $url->webshop_order_id }}</span>
                                    </td>

                                    <td>{{$url->reservation ? $url->reservation : "*no reservation" }}</td>

                                    <td>{{$url->created_at ? $url->created_at->format('d-M-Y') : "*no reservation" }}</td>

                                    <td>
                                        <a href="{{ route('listurl.detail', $url) }}" class="btn btn-sm btn-alt-secondary"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                               @if($url->print)  checked @endif
                                               class="btn btn-sm btn-alt-secondary"
                                               wire:click="select({{$url->id}})">
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $urls->links()  !!}
            </div>
        </div>
    </div>
</div>




