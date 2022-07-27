
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

                <a href="{{ route('card-credentials-sheet-generator', $urls->first()->team_id) }}" class="btn btn-alt-success" data-bs-toggle="tooltip" title="Supplier">
                    <i class="fa fa-print me-2"></i>
                </a>

                <a href="{{ route('print.list' , $urls->first()->team_id) }}" class="btn btn-alt-primary" data-bs-toggle="tooltip" title="Teamleader">
                    <i class="fa fa-copy me-2"></i>
                </a>

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
                        </div>


                        <!-- Button trigger modal -->
                        <button type="submit" class="btn btn-alt-primary m-4">
                            <i class="fa fa-arrow-circle-up me-1 opacity-50"></i> UPDATE
                        </button>

                    </form>
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

                            @if($url->member)
                                @if($url->member->user->archived == 1)
                                    <td><span class="rounded-pill btn-alt-warning p-2">archived</span></td>
                                @else
                                    <td>{{$url->member->user ? $url->member->user->name : "{...}" }}</td>
                                @endif
                            @else
                                <td>{{$url->member ? $url->member->user->name : "{...}" }}</td>
                            @endif

                            @if($url->member)
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
                                    badge badge-pill
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
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$url->id}}">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$url->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"># CARD ID {{ $url->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\Cards\CardCredentialsController@updateCard', $url->id],
                                                       'files'=>false]) !!}
                                                <div class="form-group mb-4">

                                                    <div class="form-group mb-4">
                                                        <label class="form-label">Business account:</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" value="1" name="business" type="checkbox" id="flexSwitchCheckDefault" @if($url->business) checked @endif>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        {!! Form::label('one-profile-edit-email', 'Reservation for:', ['class'=>'form-label']) !!}
                                                        {!! Form::text('reservation',$url->reservation,['class'=>'form-control']) !!}
                                                        @error('reservation')
                                                        <p class="text-danger mt-2"> {{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        {!! Form::label('one-profile-edit-email', 'Image:', ['class'=>'form-label']) !!}
                                                        {!! Form::text('image',$url->image,['class'=>'form-control']) !!}
                                                        @error('image')
                                                        <p class="text-danger mt-2"> {{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="d-flex flex-column mt-4">
                                                        {!! Form::label('role','Select Role:', ['class'=>'form-label']) !!}
                                                        {!! Form::select('role_id',$roles,$url->role_id,['class'=>'form-control'])!!}
                                                    </div>

                                                    {!! Form::hidden('url_id',$url->card_id)!!}

                                                    <div class="d-flex flex-column mt-4">
                                                        {!! Form::label('material_id','Select Material:', ['class'=>'form-label']) !!}
                                                        {!! Form::select('material_id',$materials,$url->material_id,['class'=>'form-control'])!!}
                                                    </div>

                                                    <div class="d-flex flex-column mt-4">
                                                        {!! Form::label('type_id','Select type:', ['class'=>'form-label']) !!}
                                                        {!! Form::select('type_id',$types,$url->type_id,['class'=>'form-control', 'placeholder' => 'Select here...'])!!}
                                                    </div>

{{--                                                    If webshop--}}
                                                    @if($url->listType->id == 2 )
                                                    <div class="form-group my-4">
                                                        {!! Form::label('webshop_order_id', 'Webshop Order ID:', ['class'=>'form-label']) !!}
                                                        {!! Form::text('webshop_order_id',$url->webshop_order_id,['class'=>'form-control']) !!}
                                                        @error('webshop_order_id')
                                                        <p class="text-danger mt-2"> {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    @endif

                                                    <div class="d-flex flex-column mt-4">
                                                        <a class="form-label text-dark d-flex justify-content-between" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                                            Custom Card url <i class="fa fa-arrow-down"></i>
                                                        </a>
                                                        <div class="collapse" id="collapseExample2">
                                                            <input class="form-control" type="text" name="custom_url" value="{{ $url->memberURL }}">                                                                </div>
                                                    </div>
                                                    @if($QRcode->status == 1)
                                                        <div class="d-flex flex-column mt-4">
                                                            <a class="form-label text-dark d-flex justify-content-between" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                Custom QRCODE url <i class="fa fa-arrow-down"></i>
                                                            </a>
                                                            <div class="collapse" id="collapseExample">
                                                                <input class="form-control" type="text" value="{{ $url->custom_QR_url  }}" name="input_QR_url">
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
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



