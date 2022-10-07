<!-- Buttons -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Buttons</h3>
        <p class="text-muted mb-1 d-none d-md-block" style="font-size: 12px">Insert all your personal links here.
    </div>
    <div class="block-content">
        <div class="row push">
            <div class="col-lg-10 offset-lg-1">

                <div class="alert alert-dark fs-sm">
                    <a href="https://swap-nfc.be/manual/" target="_blank">
                        <div class="d-md-flex align-items-center mt-2">
                            <p class="text-dark mb-0"><i class="fa fa-fw fa-info me-1"></i>View our manual to successfully
                                complete these functionalities: </p>
                            <p class="text-dark d-flex mt-3 mt-md-0 mb-0">
                                <i class="fa fa-book me-1 text-dark ms-md-4" style="font-size: 15px"></i>
                                SWAP MANUAL -- <strong>click here</strong>
                            </p>
                        </div>
                    </a>
                </div>


                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('facebook','Facebook:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_facebook"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->facebook) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('facebook',$member->facebook ,['class'=>'form-control col-6', 'placeholder' => 'ex: https://www.facebook.com/Innova-Webcreations-107384388503435']) !!}
                    @error('facebook')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('instagram','Instagram:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_instagram"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->instagram) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('instagram',$member->instagram ,['class'=>'form-control', 'placeholder' => 'ex: https://www.instagram.com/innovawebcreations/']) !!}
                    @error('instagram')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('twitter','Twitter:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_twitter"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->twitter) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('twitter',$member->twitter ,['class'=>'form-control', 'placeholder' => 'ex: https://twitter.com/elonmusk']) !!}
                    @error('twitter')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('youTube','Youtube:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_youTube"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->youTube) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('youTube',$member->youTube ,['class'=>'form-control' , 'placeholder' => 'ex: https://www.youtube.com/watch?v=fsDmW1o6ufA']) !!}
                    @error('youTube')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('linkedIn','LinkedIn:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_linkedIn"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->linkedIn) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('linkedIn',$member->linkedIn ,['class'=>'form-control' , 'placeholder' => 'ex: https://www.linkedin.com/in/thomas-demeulenaere-39997662/']) !!}
                    @error('linkedIn')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('tikTok','TikTok:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_tikTok"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->tikTok) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('tikTok',$member->tikTok ,['class'=>'form-control' , 'placeholder' => 'ex: https://www.tiktok.com/@elonxmusk']) !!}
                    @error('tikTok')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('whatsApp','WhatsApp:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_whatsApp"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->whatsApp) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('whatsApp',$member->whatsApp ,['class'=>'form-control' , 'placeholder' => 'ex: +32474411556']) !!}
                    @error('whatsApp')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group  my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('CustomText','Button text:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_customField"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" @if($member->state->customField) checked @endif>
                        </div>
                    </div>
                    {!! Form::text('customText',$member->customText ,['class'=>'form-control']) !!}
                    @error('customText')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                    {!! Form::label('CustomField','Button link:',['class'=>'form-label']) !!}
                    {!! Form::text('customField',$member->customField ,['class'=>'form-control', 'placeholder' => 'ex: https://yourLinkHere']) !!}
                    @error('customField')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-end">
            <div class="form-group m-4">
                <button type="submit" class="btn btn-alt-primary">Update</button>
            </div>
        </div>
    </div>
</div>
