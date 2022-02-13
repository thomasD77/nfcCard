@php
    $photo = $photos->where('id', $image_id)->first()
@endphp
<div class="mb-4">
    <label class="form-label">Photo {{ $image_id }}</label>
    @if($photo)
        <div class="mb-4 d-flex align-items-start">
            <img class="rounded" height="150" width="150"
                 src="{{$photo ? asset('images/content') . $photo->file   : 'http://placehold.it/62x62'}}"
                 alt="photo"
            >
            <input type="hidden" value="{{ $photo->id }}" name="ex__pic{{$photo->id}}">
            <label class="ms-2" for="checkbox">
                <input class="me-1"
                       type="checkbox"
                       alue="1"
                       name="is_active{{$image_id}}" {{ $photo->is_active == 1 ? 'checked' : "" }}
                >Online
            </label>
        </div>
        <p>Measurements: {{ $photo ? $photo->WxH : "default"}}</p>
    @endif
    <div class="form-group mb-4">
        <label class="form-label" for="frontend-contact-email">New Photo? </label>
        <input type="file"
               class="form-control w-50"
               id="frontend-contact-tagline"
               name="photo_{{$image_id}}"
        >
    </div>
    <p>
        <button class="btn btn-light btn-sm" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse{{$image_id}}"
                aria-expanded="false"
                aria-controls="collapseWidthExample">
            customize
        </button>
    </p>
    <div class="collapse collapse-horizontal" id="collapse{{$image_id}}">
        <div class=" d-flex justify-content-between">
            <div class="form-group col-5 mb-4">
                {!! Form::label('x-as', 'Width:') !!}
                {!! Form::number('pictWidth' . $image_id, null ,['class'=>'form-control']) !!}
            </div>
            <div class="form-group col-5 mb-4">
                {!! Form::label('y-as', 'Height:') !!}
                {!! Form::number('pictHeight' . $image_id, null ,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
