
<div class="block block-rounded row">
    <div class="block-content block-content-full overflow-scroll">
        <div class="d-flex justify-content-between mb-5">
            <!-- Pagination Select-->
            <select wire:model="pagination" style="width: 80px" class="form-select mb-3 d-flex justify-content-end" aria-label="Default select example">
                <option value="5">5</option>
                <option value="20">20</option>
                <option selected value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <!-- End Pagination -->
            <div>

                <a href="{{ route('card-credentials-sheet-generator') }}" class="btn btn-alt-success">
                    <i class="fa fa-print me-2"></i>
                </a>

            </div>
        </div>
        <div class="parent">
            @include('admin.includes.flash')
            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">User</th>

                    <th scope="col">Material</th>

                    <th scope="col">#Card ID</th>

                    @if($QRcode->status == 1)
                        <th scope="col">QRCODE URL</th>
                    @endif

                    <th scope="col">Design</th>

                    <th scope="col">Edit</th>

                    @can('is_superAdmin')
                        <th scope="col"> <i class="fa fa-print me-2"></i></th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @if($urls)
                    @foreach($urls as $url)
                        <tr>
                            <td>{{ $loop->index + 1  }}</td>

                            @if($url->member)
                                @if($url->member->user->archived == 1)
                                    <td><span class="rounded-pill btn-alt-warning p-2">archived</span></td>
                                @else
                                    <td>{{$url->member->user ? $url->member->user->name : "*not-active" }}</td>
                                @endif
                            @else
                                <td>{{$url->member ? $url->member->user->name : "*not-active" }}</td>
                            @endif

                            <td>{{$url->material ? $url->material->name : "No Material" }}</td>

                            <td>{{$url->card_id ? $url->card_id : 'No ID'}}</td>

                            <td>{{$url->image ? $url->image : "*no image" }}</td>

                            @if($QRcode->status == 1)
                                @if($url->custom_QR_url != "")
                                    <td>
                                        <span class="rounded-pill p-2 btn-success">CUSTOM</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="rounded-pill p-2 btn-primary">Default</span>
                                    </td>
                                @endif
                            @endif

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

                                                    {!! Form::hidden('url_id',$url->id)!!}

                                                    <div class="d-flex flex-column mt-4">
                                                        {!! Form::label('loyal','Select Material:', ['class'=>'form-label']) !!}
                                                        {!! Form::select('material_id',$materials,$url->material->id,['class'=>'form-control'])!!}
                                                    </div>
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
                                       @if($url->print == 1)  checked @endif
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



