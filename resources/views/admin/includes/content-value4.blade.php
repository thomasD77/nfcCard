<!-- Content Block -->

{{--- Title--}}
{{--- Text --}}
{{--- Picture --}}


<!-- Button trigger modal -->
<button type="button" class="btn btn-alt-primary w-100" data-bs-toggle="modal" data-bs-target="#createData{{$parent_id}}">
    + New
</button>

<table class="table table-striped table-hover table-vcenter  fs-sm">
    <thead>
    <tr>
        <th class="text-center">#</th>
        <th class="d-none d-sm-table-cell" >Title</th>
        <th class="d-none d-sm-table-cell" >Text</th>
        <th class="d-none d-sm-table-cell" >Picture</th>
        <th class="d-none d-sm-table-cell" >Crop (WxH)</th>
        <th class="d-none d-sm-table-cell text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contents as $content)
        @if($content->parent_id == $parent_id)
        <tr>
            <td class="text-center">{{$content->id ? $content->id : 'No ID'}}</td>
            <td>{{$content->title ? $content->title : 'No title'}}</td>
            <td>{{$content->text ? $content->text : 'No text'}}</td>
            <td><img src="{{ $content->file ? asset('images/content/' . $content->file) : 'http://placehold.it/62x62' }}" class="rounded" height="80" width="80" alt="{{ $content->title }}"></td>
            <td>{{$content->WxH ? $content->WxH : 'Original'}}</td>
            <td>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#updateData{{ $content->id }}">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                    {!! Form::open(['method'=>'DELETE',
                         'action'=>['App\Http\Controllers\AdminContentController@destroy', $content->id]]) !!}
                    <button type="submit" class="btn btn-sm bg-danger rounded text-white ms-2"><i class="far fa-trash-alt"></i></button>
                    {!! Form::close() !!}
                </div>

                <!-- Update Modal -->
                <div class="modal fade" id="updateData{{ $content->id }}" tabindex="-1" aria-labelledby="updateData{{ $content->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Record</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContentController@update',$content->id],
                                   'files'=>true])
                                    !!}
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                            <div class="mb-4">
                                                <label class="form-label" for="frontend-contact-firstname">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                       value="{{ $content->title ?? "" }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-4">
                                                <label class="form-label" for="frontend-contact-lastname">Text</label>
                                                <textarea type="text" class="form-control" name="text"
                                                >{{ $content->text ?? "" }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <img src="{{ $content->file ? asset('images/content/' . $content->file) : 'http://placehold.it/62x62' }}" class="rounded" height="80" width="80" alt="{{ $content->title }}">
                                            <div class="mb-4">
                                                <label class="form-label" for="frontend-contact-email">New Photo? </label>
                                                <input type="file" class="form-control" id="frontend-contact-tagline" name="photo">
                                            </div>
                                            <p>
                                                <button class="btn btn-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                                                    customize
                                                </button>
                                            </p>
                                            <div class="collapse collapse-horizontal" id="collapseWidthExample">
                                                <div class=" d-flex justify-content-between">
                                                    <div class="form-group col-5 mb-4">
                                                        {!! Form::label('x-as', 'Width:') !!}
                                                        {!! Form::number('pictWidth',null,['class'=>'form-control']) !!}
                                                    </div>
                                                    <div class="form-group col-5 mb-4">
                                                        {!! Form::label('y-as', 'Height:') !!}
                                                        {!! Form::number('pictHeight',null,['class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-alt-primary">
                                            <i class="fa fa-paper-plane me-1 opacity-50"></i> Update
                                        </button>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>

<!-- Create Modal -->
<div class="modal fade" id="createData{{$parent_id}}" tabindex="-1" aria-labelledby="createData" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row mb-0" name="contactformulier"
                      action="{{action('App\Http\Controllers\AdminContentController@store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                            <div class="mb-4">
                                <label class="form-label" for="frontend-contact-firstname">Title</label>
                                <input type="text" class="form-control" name="title"
                                       placeholder="Enter your title..">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label" for="frontend-contact-lastname">Text</label>
                                <textarea type="text" class="form-control" name="text"
                                       placeholder="Enter your text.."></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label" for="frontend-contact-email">New Photo? </label>
                                <input type="file" class="form-control" id="frontend-contact-tagline" name="photo">
                            </div>
                            <p>
                                <button class="btn btn-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                                    customize
                                </button>
                            </p>
                            <div class="collapse collapse-horizontal" id="collapseWidthExample">
                                <div class=" d-flex justify-content-between">
                                    <div class="form-group col-5 mb-4">
                                        {!! Form::label('x-as', 'Width:') !!}
                                        {!! Form::number('pictWidth',null,['class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group col-5 mb-4">
                                        {!! Form::label('y-as', 'Height:') !!}
                                        {!! Form::number('pictHeight',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-paper-plane me-1 opacity-50"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


