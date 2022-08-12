<div>
    @if(!$referred_members == [])
    <!-- Referred Members -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Referred Members</h3>
            </div>
            <div class="block-content">
                <div class="row items-push">
                    @foreach($referred_members as $member)
                        <div class="col-md-4">
                            <!-- Referred User -->
                            <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0" href="{{ $member->memberURL }}" target="_blank">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-semibold mb-1">{{ $member->firstname }} {{ $member->lastname }}</div>
                                        <div class="fs-sm text-muted">{{ $member->jobTitle }}</div>
                                    </div>
                                    <div class="ms-3">
                                        <td><img class="rounded-circle" height="80" width="80" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                                    </div>
                                </div>
                            </a>
                            <!-- END Referred User -->
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-center my-4 pb-4">
                {{ $referred_members->links() }}
            </div>

        </div>
        <!-- END Referred Members -->
    @endif
</div>
