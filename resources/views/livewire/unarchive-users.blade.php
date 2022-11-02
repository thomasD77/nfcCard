<div class="parent">
@include('admin.includes.flash')
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">{{__('ID')}}</th>
            <th scope="col">{{__('Name')}}</th>
            <th scope="col">{{__('Avatar')}}</th>
            <th scope="col">{{__('Email')}}</th>
            <th scope="col">{{__('Role')}}</th>
            <th scope="col">{{__('Registered')}}</th>
            <th scope="col">{{__('Actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id ? $user->id : 'No ID'}}</td>
                    <td>{{$user->name ? $user->name : 'No Name'}}</td>
                    <td><img class="rounded-circle" height="62" width="62" src="{{$user->avatar ? asset('/') . $user->avatar->file : asset('/assets/front/img/Avatar-3.svg') }}" alt="{{$user->name}}"></td>
                    <td>{{$user->email ? $user->email : 'No Email'}}</td>
                    <td>@foreach($user->roles as $role)
                            <span class="rounded-pill bg-info-light text-info p-2">{{$role->name ? $role->name : 'No Role'}}</span>
                        @endforeach
                    </td>
                    <td>{{$user->email_verified_at ? $user->email_verified_at : 'Not Verified'}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-alt-secondary"
                                   wire:click="unArchiveUser({{$user->id}})"><i class="si si-refresh "></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $users->links()  !!}
</div>
