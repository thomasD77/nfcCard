@include('admin.members.includes.default-components.css')

<ul class="nav nav-tabs mb-3 mb-md-0" id="pills-tab" role="tablist">
    @foreach($profiles as $profile)
        <li class="nav-item" role="presentation">
            <button class="nav-link @if($profile->active)active show @endif"
                    id="pills-profile-tab"
                    data-toggle="pill"
                    data-target="#pills-tab-{{ $profile->id }}"
                    type="button" role="tab"
                    aria-controls="pills-profile"
                    style="color: #334155"
                    aria-selected="true">{{$profile->profile_name}}</button>
        </li>
    @endforeach
</ul>
<div class="tab-content" id="pills-tabContent">
    @foreach($profiles as $profile)
        <div class="tab-pane fade show @if($profile->active)active @endif" id="pills-tab-{{ $profile->id }}" role="tabpanel"
             aria-labelledby="pills-tab-{{ $profile->id }}">
            <ul class="nav nav-tabs mb-3 mb-md-0" id="pills-{{ $profile->id }}" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active"
                            id="pills-profile-tab-{{ $profile->id }}"
                            data-toggle="pill"
                            data-target="#pills-profile-{{ $profile->id }}"
                            type="button" role="tab"
                            aria-controls="pills-profile-{{ $profile->id }}"
                            style="color: #334155"
                            aria-selected="true">Profile
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-contact-tab-{{ $profile->id }}"
                            data-toggle="pill"
                            data-target="#pills-contact-{{ $profile->id }}"
                            type="button" role="tab"
                            aria-controls="pills-contact-{{ $profile->id }}"
                            style="color: #334155"
                            aria-selected="true">Contact
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-buttons-tab-{{ $profile->id }}"
                            data-toggle="pill"
                            data-target="#pills-buttons-{{ $profile->id }}"
                            type="button" role="tab"
                            aria-controls="pills-buttons-{{ $profile->id }}"
                            style="color: #334155"
                            aria-selected="true">Buttons
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-video-tab-{{ $profile->id }}"
                            data-toggle="pill"
                            data-target="#pills-video-{{ $profile->id }}"
                            type="button" role="tab"
                            aria-controls="pills-video-{{ $profile->id }}"
                            style="color: #334155"
                            aria-selected="false">Video
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-message-tab-{{ $profile->id }}"
                            data-toggle="pill"
                            data-target="#pills-message-{{ $profile->id }}"
                            type="button" role="tab"
                            aria-controls="pills-message-{{ $profile->id }}"
                            style="color: #334155"
                            aria-selected="false">Message
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-extra-tab-{{ $profile->id }}"
                            data-toggle="pill"
                            data-target="#pills-extra-{{ $profile->id }}"
                            type="button" role="tab"
                            aria-controls="pills-extra-{{ $profile->id }}"
                            style="color: #334155"
                            aria-selected="false">Extra
                    </button>
                </li>

            </ul>

            {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminProfilesController@update', $profile->id]])!!}
            @csrf

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile-{{ $profile->id }}" role="tabpanel"
                     aria-labelledby="pills-profile-tab-{{ $profile->id }}">
                    @include('admin.members.includes.default-components.profile')
                </div>

                <div class="tab-pane fade show" id="pills-contact-{{ $profile->id }}" role="tabpanel"
                     aria-labelledby="pills-profile-tab-{{ $profile->id }}">
                    @include('admin.members.includes.default-components.contact')
                </div>

                <div class="tab-pane fade show" id="pills-buttons-{{ $profile->id }}" role="tabpanel"
                     aria-labelledby="pills-profile-tab-{{ $profile->id }}">
                    @include('admin.members.includes.default-components.buttons')
                </div>

                <div class="tab-pane fade" id="pills-video-{{ $profile->id }}" role="tabpanel"
                     aria-labelledby="pills-video-tab-{{ $profile->id }}">
                    @include('admin.members.includes.default-components.video')
                </div>

                <div class="tab-pane fade" id="pills-message-{{ $profile->id }}" role="tabpanel"
                     aria-labelledby="pills-message-tab-{{ $profile->id }}">
                    @include('admin.members.includes.default-components.message')
                </div>

                {!! Form::close() !!}

{{--                <div class="tab-pane fade" id="pills-extra-{{ $profile->id }}" role="tabpanel"--}}
{{--                     aria-labelledby="pills-extra-tab-{{ $profile->id }}">--}}
{{--                    @livewire('custom-button', [ 'member' => $member ])--}}
{{--                </div>--}}
            </div>
        </div>
    @endforeach
</div>

@include('admin.members.includes.default-components.script')
@foreach($profiles as $profile)
    @include('admin.members.includes.default-components.cropper')
@endforeach



