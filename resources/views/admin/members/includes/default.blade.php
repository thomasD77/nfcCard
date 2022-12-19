@include('admin.members.includes.default-components.css')
    <div class="block-content block-content-full overflow-scroll">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
        <table class="table table-striped table-hover table-vcenter fs-sm">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">active</th>
                <th scope="col">
                    <a href="{{route("profile.add")}}" type="button" class="btn btn-secondary rounded">
                        <i class="fa fa-plus"></i>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @if($profiles)
                @foreach($profiles as $profile)
                    <tr>
                        <td>{{$profile->profile_name}}</td>
                        <td>
                            <!-- Active -->
                            <div class="form-group my-4">
                                <div class="slider-profile">
                                    <input type="checkbox" name="active" class="slider-checkbox-profile" id="sliderSwitch-profile-{{$profile->id}}" value="{{ 1 }}"
                                           @if($profile->active === 1) checked @endif disabled="disabled">
                                    <label class="slider-label-profile" for="sliderSwitch-profile-{{$profile->id}}">
                                        <span class="slider-inner-profile"></span>
                                        <span class="slider-circle-profile"></span>
                                    </label>
                                </div>
                            </div>
                            <!-- End Active -->
                        </td>
                        <td>
                            <div class="btn-group">
                                <!-- view Event button -->
                                    <a href="{{route("profile.edit",$profile->id)}}">
                                        <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                            data-bs-toggle="modal" title=""
                                            data-bs-target="#deleteProfile-{{$profile->id}}"
                                            data-bs-original-title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                            </div>
                            <div class="modal fade" wire:ignore.self id="deleteProfile-{{$profile->id}}"
                                 tabindex="-1"
                                 aria-labelledby="deleteEventModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="margin-top: 30%;">
                                        <form action="{{route('profile.delete', $profile->id)}}" method="post"
                                              id="deleteEventForm{{$profile->id}}"
                                              class="d-flex align-center justify-content-center flex-column">
                                            @csrf
                                            <div class="modal-header" style="background-color: #1F2A37">
                                                <h5 class="modal-title text-white" id="DeleteEventLabel">DELETE
                                                    EVENT</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                        id="btn-event-close-delete"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </form>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this event?</p>
                                            <div class="delete-event-buttons">
                                                <button id="delete-button" form="deleteEventForm{{$profile->id}}" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteEvent{{$profile->id}}">Yes
                                                </button>
                                                <button id="delete-decline-button"
                                                        class="btn btn-primary" style="background-color: #1F2A37" data-bs-toggle="modal"
                                                        data-bs-target="#deleteEvent{{$profile->id}}">No
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

{{--
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
                --}}

{{--                <div class="tab-pane fade" id="pills-extra-{{ $profile->id }}" role="tabpanel"--}}
{{--                     aria-labelledby="pills-extra-tab-{{ $profile->id }}">--}}
{{--                    @livewire('custom-button', [ 'member' => $member ])--}}
{{--                </div>--}}
 {{--           </div>
        </div>
    @endforeach
</div>--}}

@include('admin.members.includes.default-components.script')
@foreach($profiles as $profile)
    @include('admin.members.includes.default-components.cropper')
@endforeach



