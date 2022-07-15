@can('is_client')


    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- member Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Member Profile</h3>
                <div>
                    <p style="font-weight: bold">#Card ID: {{ $member->card_id }}</p>
                </div>
            </div>
            @if($member->user->archived == 0)

                @if($member->package->package == 'vCard')
                    @include('admin.members.includes.vCard')

                @elseif($member->package->package == 'Default')
                    @include('admin.members.includes.default')

                @elseif($member->package->package == "Custom")
                    @include('admin.members.includes.custom')

                @endif
            @else
                <p class="p-2">Sorry, the admin blocked your account. Please contact him for this situation.</p>
            @endif
        </div>
        <!-- END member Profile -->
    </div>
    <!-- END Page Content -->

@endcan
