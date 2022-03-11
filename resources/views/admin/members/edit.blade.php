<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="rounded-circle border border-white border border-3" height="80" width="80" src="{{Auth::user()->avatar ? asset('/') . Auth::user()->avatar->file : 'http://placehold.it/62x62'}}" alt="{{Auth::user()->name}}">
            </div>
            <h1 class="h2 text-white mb-0">Update Member</h1>
            <h2 class="h4 fw-normal text-white-75">
                <?php echo Auth::user()->name; ?>
            </h2>
            <a class="btn btn-alt-secondary" href="{{ asset('/admin/members') }}">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Members
            </a>
        </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">

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
            @endif
        </div>
        <!-- END member Profile -->
    </div>
    <!-- END Page Content -->

<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>
