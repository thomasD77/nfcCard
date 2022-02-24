<!-- Dynamic Table Full -->
<div class="block block-rounded row">
    <div class="block-header block-header-default d-flex justify-content-between">
        @canany(['is_superAdmin', 'is_admin'])
            <!-- Search Form (visible on larger screens) -->
            <form class="d-none d-md-inline-block col-6" action="{{action('App\Http\Controllers\AdminMembersController@searchMember')}}" method="POST">
                @csrf
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="member">
                    <span class="input-group-text border-0"><button class="border border-0" type="submit"><i class="fa fa-fw fa-search"></i></button></span>
                </div>
            </form>
            <!-- END Search Form -->
        @endcanany

        <div>
            @canany(['is_superAdmin', 'is_admin'])
                <a class="btn btn-alt-warning" role="button" href="{{ route('members.credentials') }}">
                    <i class="fa fa-print me-2"></i> Member List
                </a>
                <a href="{{route('members.archive')}}">
                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Archive">
                        <i class="fa fa-archive "></i>
                    </button>
                </a>
            @endcanany
        </div>
    </div>
    <div class="block-content block-content-full overflow-scroll">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->

        <div>
            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">avatar</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    @canany(['is_superAdmin', 'is_admin'])
{{--                        <th scope="col">role</th>--}}
                    @endcanany
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($members)
                    @foreach($members as $member)
                        @if($active_user_role == 'client')
                            @if($active_user == $member->user_id)
                                <tr>
                                    <td>{{$member->id ? $member->id : 'No ID'}}</td>
                                    <td><img class="rounded-circle" height="62" width="62" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                                    <td>{{$member->lastname ? $member->lastname : "unknown"}} {{ $member->firstname ? $member->firstname : '' }}</td>
                                    <td>{{$member->email ? $member->email : "unknown"}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('members.edit', $member->id)}}">
                                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('members.show', $member->id)}}">
                                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td>{{$member->id ? $member->id : 'No ID'}}</td>
                                <td><img class="rounded-circle" height="62" width="62" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                                <td>{{$member->lastname ? $member->lastname : "unknown"}} {{ $member->firstname ? $member->firstname : '' }}</td>
                                <td>{{$member->email ? $member->email : "unknown"}}</td>
{{--                                <td>{{$member->user ? $member->user->roles->first()->name : ""}}</td>--}}
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('members.edit', $member->id)}}">
                                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-sm btn-alt-secondary" wire:click="archiveMember({{$member->id}})"><i class="fa fa-archive"></i></button>
                                        <a href="{{route('members.landingpageDefault', $member->id)}}" target="_blank">
                                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        @canany(['is_superAdmin', 'is_admin'])
            <div class="d-flex justify-content-center">
                {!! $members->links()  !!}
            </div>
        @endcanany

    </div>
</div>
<!-- END Dynamic Table Full -->
