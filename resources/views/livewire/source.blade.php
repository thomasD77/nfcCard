<div>
    {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminSourceController@store'],'files'=>false])!!}
    <div class="d-flex">
        <div class="form-group mb-3">
            {!! Form::text('name',null,['class'=>'form-control', 'placeholder'=>'new source...']) !!}
            @error('name')
            <p class="text-danger mt-2"> {{ $message }}</p>
            @enderror
        </div>
        <div class="form-group mr-1 mb-3">
            {!! Form::submit('Submit',['class'=>'btn btn-secondary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
