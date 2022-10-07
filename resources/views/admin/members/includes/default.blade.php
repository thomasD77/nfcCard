@include('admin.members.includes.default-components.css')

<ul class="nav nav-tabs mb-3 mb-md-0" id="pills-tab" role="tablist">

    <li class="nav-item" role="presentation">
        <button class="nav-link active"
                id="pills-profile-tab"
                data-toggle="pill"
                data-target="#pills-profile"
                type="button" role="tab"
                aria-controls="pills-profile"
                style="color: #334155"
                aria-selected="true">Profile</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-contact-tab"
                data-toggle="pill"
                data-target="#pills-contact"
                type="button" role="tab"
                aria-controls="pills-contact"
                style="color: #334155"
                aria-selected="false">Contact</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-buttons-tab"
                data-toggle="pill"
                data-target="#pills-buttons"
                type="button" role="tab"
                aria-controls="pills-buttons"
                style="color: #334155"
                aria-selected="false">Buttons</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-video-tab"
                data-toggle="pill"
                data-target="#pills-video"
                type="button" role="tab"
                aria-controls="pills-video"
                style="color: #334155"
                aria-selected="false">Video</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-message-tab"
                data-toggle="pill"
                data-target="#pills-message"
                type="button" role="tab"
                aria-controls="pills-message"
                style="color: #334155"
                aria-selected="false">Message</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="pills-extra-tab"
                data-toggle="pill"
                data-target="#pills-extra"
                type="button" role="tab"
                aria-controls="pills-extra"
                style="color: #334155"
                aria-selected="false">Extra</button>
    </li>


</ul>

{!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminMembersController@update', $member->id],'files'=>true])!!}

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        @include('admin.members.includes.default-components.profile')
    </div>

    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        @include('admin.members.includes.default-components.contact')
    </div>

    <div class="tab-pane fade" id="pills-buttons" role="tabpanel" aria-labelledby="pills-buttons-tab">
        @include('admin.members.includes.default-components.buttons')
    </div>

    <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
        @include('admin.members.includes.default-components.video')
    </div>

    <div class="tab-pane fade" id="pills-message" role="tabpanel" aria-labelledby="pills-message-tab">
        @include('admin.members.includes.default-components.message')
    </div>

    {!! Form::close() !!}

    <div class="tab-pane fade" id="pills-extra" role="tabpanel" aria-labelledby="pills-extra-tab">
        @livewire('custom-button', [ 'member' => $member ])
    </div>
</div>




@include('admin.members.includes.default-components.script')



