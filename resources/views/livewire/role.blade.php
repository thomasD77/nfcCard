<div>
{{--    <form wire:submit.prevent="submit" method="POST" class="row mb-0 ">--}}
{{--        <div class="input-group border border-1 px-0">--}}
{{--            <button  class="btn btn-alt-primary">--}}
{{--                <i class="fa fa-plus"></i>--}}
{{--            </button>--}}
{{--            <input wire:model="name"--}}
{{--                    type="text"--}}
{{--                    class="form-control form-control-alt"--}}
{{--                    id="example-group3-input3-alt2"--}}
{{--                    name="role"--}}
{{--                    placeholder="New Role">--}}
{{--            <button type="submit" class="btn btn-secondary">--}}
{{--                Submit--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </form>--}}
    {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminRolesController@store'],'files'=>false])!!}
    <div class="d-flex">
        <div class="form-group mb-3">
            {!! Form::text('name',null,['class'=>'form-control', 'placeholder'=>'new role...']) !!}
        </div>
        <div class="form-group mr-1 mb-3">
            {!! Form::submit('Submit',['class'=>'btn btn-secondary']) !!}
        </div>
    </div>

    {!! Form::close() !!}
</div>
