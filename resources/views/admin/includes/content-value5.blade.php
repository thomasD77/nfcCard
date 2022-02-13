<!-- Content Block -->

{{--- Title--}}
{{--- Number--}}



<!-- Button trigger modal -->
<button type="button" class="btn btn-alt-primary w-100" data-bs-toggle="modal" data-bs-target="#createData{{$parent_id}}">
    + New
</button>

<table class="table table-striped table-hover table-vcenter  fs-sm">
    <thead>
    <tr>
        <th class="text-center">#</th>
        <th class="d-none d-sm-table-cell" >Title</th>
        <th class="d-none d-sm-table-cell" >Number</th>
        <th class="d-none d-sm-table-cell text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contents as $content)
        @if($content->parent_id == $parent_id)
        <tr>
            <td class="text-center">{{$content->id ? $content->id : 'No ID'}}</td>
            <td>{{$content->title ? $content->title : 'No title'}}</td>
            <td>{{$content->number ? $content->number : 'No number'}}</td>
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
                                  'files'=>false])
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
                                                <label class="form-label" for="frontend-contact-lastname">Number %</label>
                                                <input type="number" class="form-control" name="number"
                                                       value="{{ $content->number ?? "" }}">
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
                      action="{{action('App\Http\Controllers\AdminContentController@store')}}" method="post">
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
                                <label class="form-label" for="frontend-contact-lastname">Number %</label>
                                <input type="number" class="form-control" name="number"
                                          placeholder="Enter your number..">
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


