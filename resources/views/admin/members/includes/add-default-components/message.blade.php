<!-- Thank you  -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Thank you message</h3>
        <p class="text-muted mb-1 d-none d-md-block" style="font-size: 12px">This text will be shown when someone has entered their
            details on your form</p>
    </div>
    <div class="block-content">
        <div class="row push">
            <div class="col-lg-10 offset-lg-1">
                <div class="form-group my-4">
                    {!! Form::label('titleMessage','Title:',['class'=>'form-label']) !!}
                    {!! Form::text('titleMessage',"" ,['class'=>'form-control']) !!}
                    @error('titleMessage')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group my-4">
                    {!! Form::label('message','Message:',['class'=>'form-label']) !!}
                    {!! Form::textarea('message',"" ,['class'=>'form-control']) !!}
                    @error('message')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <div class="form-group m-4">
                <button type="submit" class="btn btn-alt-primary">Save</button>
            </div>
        </div>

    </div>
</div>
