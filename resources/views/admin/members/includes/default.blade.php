@include('admin.members.includes.default-components.css')

<ul class="nav nav-tabs mb-3 mb-md-0" id="pills-tab" role="tablist">
    @foreach($profiles as $profile)
        <li class="nav-item" role="presentation">
            <button class="nav-link @if($profile->active)active @endif"
                    id="pills-profile-tab"
                    data-toggle="pill"
                    data-target="#pills-tab-{{str_replace(" ","",$profile->profile_name)}}"
                    type="button" role="tab"
                    aria-controls="pills-profile"
                    style="color: #334155"
                    aria-selected="true">{{$profile->profile_name}}</button>
        </li>
    @endforeach
</ul>
<div class="tab-content" id="pills-tabContent">
    @foreach($profiles as $profile)
        <div class="tab-pane fade show @if($profile->active)active @endif" id="pills-tab-{{str_replace(" ","",$profile->profile_name)}}" role="tabpanel"
             aria-labelledby="pills-tab-{{str_replace(" ","",$profile->profile_name)}}">
            <ul class="nav nav-tabs mb-3 mb-md-0" id="pills-{{str_replace(" ","",$profile->profile_name)}}" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active"
                            id="pills-profile-tab-{{str_replace(" ","",$profile->profile_name)}}"
                            data-toggle="pill"
                            data-target="#pills-profile-{{str_replace(" ","",$profile->profile_name)}}"
                            type="button" role="tab"
                            aria-controls="pills-profile-{{str_replace(" ","",$profile->profile_name)}}"
                            style="color: #334155"
                            aria-selected="true">Profile
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-contact-tab-{{str_replace(" ","",$profile->profile_name)}}"
                            data-toggle="pill"
                            data-target="#pills-contact-{{str_replace(" ","",$profile->profile_name)}}"
                            type="button" role="tab"
                            aria-controls="pills-contact-{{str_replace(" ","",$profile->profile_name)}}"
                            style="color: #334155"
                            aria-selected="true">Contact
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-buttons-tab-{{str_replace(" ","",$profile->profile_name)}}"
                            data-toggle="pill"
                            data-target="#pills-buttons-{{str_replace(" ","",$profile->profile_name)}}"
                            type="button" role="tab"
                            aria-controls="pills-buttons-{{str_replace(" ","",$profile->profile_name)}}"
                            style="color: #334155"
                            aria-selected="true">Buttons
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-video-tab-{{str_replace(" ","",$profile->profile_name)}}"
                            data-toggle="pill"
                            data-target="#pills-video-{{str_replace(" ","",$profile->profile_name)}}"
                            type="button" role="tab"
                            aria-controls="pills-video-{{str_replace(" ","",$profile->profile_name)}}"
                            style="color: #334155"
                            aria-selected="false">Video
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-message-tab-{{str_replace(" ","",$profile->profile_name)}}"
                            data-toggle="pill"
                            data-target="#pills-message-{{str_replace(" ","",$profile->profile_name)}}"
                            type="button" role="tab"
                            aria-controls="pills-message-{{str_replace(" ","",$profile->profile_name)}}"
                            style="color: #334155"
                            aria-selected="false">Message
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="pills-extra-tab-{{str_replace(" ","",$profile->profile_name)}}"
                            data-toggle="pill"
                            data-target="#pills-extra-{{str_replace(" ","",$profile->profile_name)}}"
                            type="button" role="tab"
                            aria-controls="pills-extra-{{str_replace(" ","",$profile->profile_name)}}"
                            style="color: #334155"
                            aria-selected="false">Extra
                    </button>
                </li>


            </ul>

            {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminProfilesController@update', $profile->id]])!!}
            @csrf

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile-{{str_replace(" ","",$profile->profile_name)}}" role="tabpanel"
                     aria-labelledby="pills-profile-tab-{{str_replace(" ","",$profile->profile_name)}}">
                    @include('admin.members.includes.default-components.profile')
                </div>

                <div class="tab-pane fade show" id="pills-contact-{{str_replace(" ","",$profile->profile_name)}}" role="tabpanel"
                     aria-labelledby="pills-profile-tab-{{str_replace(" ","",$profile->profile_name)}}">
                    @include('admin.members.includes.default-components.contact')
                </div>

                <div class="tab-pane fade show" id="pills-buttons-{{str_replace(" ","",$profile->profile_name)}}" role="tabpanel"
                     aria-labelledby="pills-profile-tab-{{str_replace(" ","",$profile->profile_name)}}">
                    @include('admin.members.includes.default-components.buttons')
                </div>

                <div class="tab-pane fade" id="pills-video-{{str_replace(" ","",$profile->profile_name)}}" role="tabpanel"
                     aria-labelledby="pills-video-tab-{{str_replace(" ","",$profile->profile_name)}}">
                    @include('admin.members.includes.default-components.video')
                </div>

                <div class="tab-pane fade" id="pills-message-{{str_replace(" ","",$profile->profile_name)}}" role="tabpanel"
                     aria-labelledby="pills-message-tab-{{str_replace(" ","",$profile->profile_name)}}">
                    @include('admin.members.includes.default-components.message')
                </div>

                {!! Form::close() !!}

                <div class="tab-pane fade" id="pills-extra-{{str_replace(" ","",$profile->profile_name)}}" role="tabpanel"
                     aria-labelledby="pills-extra-tab-{{str_replace(" ","",$profile->profile_name)}}">
                    @livewire('custom-button', [ 'member' => $member ])
                </div>
            </div>
        </div>
    @endforeach
</div>

@include('admin.members.includes.default-components.script')
@foreach($profiles as $profile)
    @include('admin.members.includes.default-components.cropper')
@endforeach



