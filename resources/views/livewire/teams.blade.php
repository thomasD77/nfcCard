<div class="parent">
@include('admin.includes.flash')
<!-- Search Form (visible on larger screens) -->
    <div class="d-none d-md-inline-block col-4 mb-3">
        <input type="text" wire:model="search" class="form-control form-control-alt" placeholder="Search for company..." id="page-header-search-input2" name="company">
    </div>
    <!-- END Search Form -->
        <div class="row">
            @if($teams)
                @foreach($teams as $team)
                    <div class="card col-md-6 col-xl-4 align-items-stretch my-2" style="border:none">
                        <h3 class="card-header d-flex justify-content-between">

                            {{ $team->name }}

                            <div>
                                <button class="btn btn-sm btn-secondary rounded mx-2" wire:click="archiveTeam({{ $team }})" data-bs-toggle="tooltip" title="Archive">
                                    <i class="fa fa-archive "></i>
                                </button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team->id}}">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <a href="{{route('team.users', Auth()->user()->team)}}">
                                    <button class="bt btn-sm btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="List users">
                                        <i class="fa fa-list-ul"></i>
                                    </button>
                                </a>
                            </div>
                        </h3>
                        <!-- Modal -->
                        {!! Form::open(['method'=>'PUT', 'action'=>['App\Http\Controllers\AdminTeamsController@update', $team->id],
                        'files'=>false]) !!}
                        <div class="modal fade" id="exampleModal{{$team->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Company</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-4">
                                            <div class="form-group mb-4">
                                                {!! Form::label('one-profile-edit-email', 'Name:', ['class'=>'form-label']) !!}
                                                {!! Form::text('name',$team->name,['class'=>'form-control']) !!}
                                                @error('name')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                {!! Form::label('one-profile-edit-email', 'VAT:', ['class'=>'form-label']) !!}
                                                {!! Form::text('VAT',$team->VAT,['class'=>'form-control']) !!}
                                                @error('VAT')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                {!! Form::label('one-profile-edit-email', 'Phone:', ['class'=>'form-label']) !!}
                                                {!! Form::text('phone',$team->phone,['class'=>'form-control']) !!}
                                                @error('phone')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                {!! Form::label('one-profile-edit-email', 'Street:', ['class'=>'form-label']) !!}
                                                {!! Form::text('street',$team->teamAddress->street,['class'=>'form-control']) !!}
                                                @error('street')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                {!! Form::label('one-profile-edit-email', 'Number:', ['class'=>'form-label']) !!}
                                                {!! Form::text('number',$team->teamAddress->number,['class'=>'form-control']) !!}
                                                @error('number')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                {!! Form::label('one-profile-edit-email', 'Zip:', ['class'=>'form-label']) !!}
                                                {!! Form::text('zip',$team->teamAddress->zip,['class'=>'form-control']) !!}
                                                @error('zip')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                {!! Form::label('one-profile-edit-email', 'City:', ['class'=>'form-label']) !!}
                                                {!! Form::text('city',$team->teamAddress->city,['class'=>'form-control']) !!}
                                                @error('city')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                {!! Form::label('one-profile-edit-email', 'Country:', ['class'=>'form-label']) !!}
                                                {!! Form::text('country',$team->teamAddress->country,['class'=>'form-control']) !!}
                                                @error('country')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                {!! Form::label('one-profile-edit-email', 'Description:', ['class'=>'form-label']) !!}
                                                {!! Form::textarea('description',$team->description,['class'=>'form-control']) !!}
                                                @error('description')
                                                <p class="text-danger mt-2"> {{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="d-flex flex-column mt-4">
                                                {!! Form::label('ambassador','Ambassador:', ['class'=>'form-label']) !!}
                                                {!! Form::select('ambassador',$ambassadors,null,['class'=>'form-control', 'placeholder' => 'Select if applicable...'])!!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    <!-- END Modal -->
                        <div class="card-body">
                            <strong>VAT: </strong><br>
                            <p>{{ $team->VAT }}</p>

                            <strong>Phone: </strong><br>
                            <p>{{ $team->phone }}</p>

                            <strong>Address: </strong><br>
                            <p class="mb-1">{{ $team->teamAddress ? $team->teamAddress->street : "" }} {{ $team->teamAddress ? $team->teamAddress->number : "" }}</p>
                            <p class="mb-1">{{ $team->teamAddress ? $team->teamAddress->zip : "" }} {{ $team->teamAddress ? $team->teamAddress->city : "" }}</p>
                            <p class="mb-1">{{ $team->teamAddress ? $team->teamAddress->country : "" }}</p>
                        </div>

                        @if($team->ambassador)
                            <div class="card-body">
                                <strong>Ambassador: </strong><br>
                                <p class="badge badge-pill p-2 bg-info">{{ $team->ambassador }}</p>
                            </div>
                        @endif
                        <div class="card-footer">
                            <p>{{ $team->description }}</p>
                        </div>
                    </div>

                @endforeach
            @endif
        </div>


</div>
<div class="d-flex justify-content-center">
    {!! $teams->links()  !!}
</div>
