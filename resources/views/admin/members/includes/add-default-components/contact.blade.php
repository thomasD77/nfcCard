<!-- Contact info -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Contact info</h3>
    </div>
    <div class="block-content">
        <div class="row push">
            <div class="col-lg-10 offset-lg-1">

                <div class="form-group mb-4">
                    <div class="form-check ps-0 ">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('mobileWork','Mobile work:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_mobileWork"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" checked
                            >
                        </div>
                    </div>
                    {!! Form::text('mobileWork',"" ,['class'=>'form-control']) !!}
                    @error('mobileWork')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0 ">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('mobile','Mobile:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_mobile"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" checked
                            >
                        </div>
                    </div>
                    {!! Form::text('mobile',"",['class'=>'form-control']) !!}
                    @error('mobile')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0 ">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('addressLine1','Address (street and number):',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_addressLine1"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" checked
                            >
                        </div>
                    </div>
                    {!! Form::text('addressLine1',"" ,['class'=>'form-control']) !!}
                    @error('addressLine1')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0 ">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('city','City:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_city"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" checked
                            >
                        </div>
                    </div>
                    {!! Form::text('city',"" ,['class'=>'form-control']) !!}
                    @error('city')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0 ">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('postalCode','Postal Code:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_postalCode"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" checked
                            >
                        </div>
                    </div>
                    {!! Form::text('postalCode',"" ,['class'=>'form-control']) !!}
                    @error('postalCode')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0 ">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('country','Country:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_country"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" checked
                            >
                        </div>
                    </div>
                    {!! Form::text('country',"" ,['class'=>'form-control']) !!}
                    @error('country')
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
