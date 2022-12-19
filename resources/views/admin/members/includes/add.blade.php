@include('admin.members.includes.default-components.css')

<ul class="nav nav-tabs mb-3 mb-md-0" id="pills-add" role="tablist">

    <li class="nav-item" role="presentation">
        <button class="nav-link active"
                id="pills-profile-tab-add"
                data-toggle="pill"
                data-target="#pills-profile-add"
                type="button" role="tab"
                aria-controls="pills-profile-add"
                style="color: #334155"
                aria-selected="true">Profile
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-contact-tab-add"
                data-toggle="pill"
                data-target="#pills-contact-add"
                type="button" role="tab"
                aria-controls="pills-contact-add"
                style="color: #334155"
                aria-selected="true">Contact
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-buttons-tab-add"
                data-toggle="pill"
                data-target="#pills-buttons-add"
                type="button" role="tab"
                aria-controls="pills-buttons-add"
                style="color: #334155"
                aria-selected="true">Buttons
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-video-tab-add"
                data-toggle="pill"
                data-target="#pills-video-add"
                type="button" role="tab"
                aria-controls="pills-video-add"
                style="color: #334155"
                aria-selected="false">Video
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-message-tab-add"
                data-toggle="pill"
                data-target="#pills-message-add"
                type="button" role="tab"
                aria-controls="pills-message-add"
                style="color: #334155"
                aria-selected="false">Message
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-extra-tab-add"
                data-toggle="pill"
                data-target="#pills-extra-add"
                type="button" role="tab"
                aria-controls="pills-extra-add"
                style="color: #334155"
                aria-selected="false">Extra
        </button>
    </li>
</ul>

{!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminProfilesController@store']])!!}
@csrf
<input type="hidden" name="member_id" value="{{$member->id}}" />
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile-add" role="tabpanel"
         aria-labelledby="pills-profile-tab-add">
        @include('admin.members.includes.add-default-components.profile')
    </div>

    <div class="tab-pane fade show" id="pills-contact-add" role="tabpanel"
         aria-labelledby="pills-profile-tab-add">
        @include('admin.members.includes.add-default-components.contact')
    </div>

    <div class="tab-pane fade show" id="pills-buttons-add" role="tabpanel"
         aria-labelledby="pills-profile-tab-add">
        @include('admin.members.includes.add-default-components.buttons')
    </div>

    <div class="tab-pane fade" id="pills-video-add" role="tabpanel"
         aria-labelledby="pills-video-tab-add">
        @include('admin.members.includes.add-default-components.video')
    </div>

    <div class="tab-pane fade" id="pills-message-add" role="tabpanel"
         aria-labelledby="pills-message-tab-add">
        @include('admin.members.includes.add-default-components.message')
    </div>

{!! Form::close() !!}


@include('admin.members.includes.add-default-components.script')
