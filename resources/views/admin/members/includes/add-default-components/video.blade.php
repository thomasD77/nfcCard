
<!-- Videos -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Video</h3>
        <p class="text-muted mb-1 d-none d-md-block" style="font-size: 12px">Upload your video or add link. This will play automatically
            on your profile page.</p>
    </div>
    <div class="block-content">
        <div class="row push">
            <div class="col-lg-10 offset-lg-1">
                <div class="form-group my-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('youtube_video','Video link:',['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_youtube_video"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" checked>
                        </div>
                    </div>
                    {!! Form::text('youtube_video',"" ,['class'=>'form-control' , 'placeholder' => 'https://www.youtube.com/watch?v=gg8gjO5pLps']) !!}
                    @error('Youtube_Video')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row push">
            <div class="col-lg-10 offset-lg-1">
                <div class="form-group mb-4">
                    <div class="form-check ps-0">
                        <div class="d-flex justify-content-between mb-2">
                            {!! Form::label('video_id', 'Video attachment:', ['class'=>'form-label']) !!}
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="check_video"
                                   style="width: 25px; height: 25px"
                                   value="{{ 1 }}" checked>
                        </div>
                    </div>
                    {!! Form::file('video_id',['class'=>'form-control', "accept"=>"video/mp4"]) !!}
                </div>
                @if(!$errors->isEmpty())
                    @foreach ($errors->all('<p>:message</p>') as $input_error)
                        <div class="alert alert-danger">
                            {{ str_replace("</p>", "", str_replace("<p>", "", $input_error)) }}
                        </div>
                    @endforeach
                @endif
                <div class="alert alert-dark fs-sm">
                    <div class="mt-2">
                        <p class="mb-0"><i class="fa fa-fw fa-info me-1 mb-0"></i>Don't try to upload .mp4 files larger then 200mb. </p>
                        Also larger files can take a second to upload.
                    </div>
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
