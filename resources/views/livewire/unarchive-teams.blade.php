<div class="parent">
@include('admin.includes.flash')

    <div class="row">
        @if($teams)
            @foreach($teams as $team)
                <div class="card col-md-6 col-xl-4 align-items-stretch my-2" style="border:none">
                    <h3 class="card-header d-flex justify-content-between">

                        {{ $team->name }}

                        <button class="btn btn-sm btn-alt-secondary"
                                data-bs-toggle="tooltip" title="Reset Member"
                                wire:click="unArchiveTeam({{$team}})"><i class="si si-refresh "></i>
                        </button>
                    </h3>

                    <div class="card-body">
                        <strong>VAT: </strong><br>
                        <p>{{ $team->VAT }}</p>
                        <strong>Phone: </strong><br>
                        <p>{{ $team->phone }}</p>
                    </div>
                    <div class="card-body">
                        <strong>Address: </strong><br>
                        <p>{{ $team->teamAddress ? $team->teamAddress->street : "" }} {{ $team->teamAddress ? $team->teamAddress->number : "" }}</p>
                        <p>{{ $team->teamAddress ? $team->teamAddress->zip : "" }} {{ $team->teamAddress ? $team->teamAddress->city : "" }}</p>
                        <p>{{ $team->teamAddress ? $team->teamAddress->country : "" }}</p>
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
