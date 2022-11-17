<!-- Page Content -->
<div class="content container-fluid">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded row">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                SWAP STATS
            </h3>
        </div>
        <div class="block-content block-content-full overflow-scroll">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <div>
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Company</th>
                        <th scope="col">Swaps</th>
                        <th scope="col">Profile views</th>
                    </tr>
                    </thead>
                    @if($members)
                        @foreach($members as $member)
                            <tbody>
                            <tr>
                                <td>{{ $member->lastname }} {{ $member->firstname }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->user->company }}</td>
                                <td>{{ count($member->contacts) }}</td>
                                <td>{{ $member->profile_views }}</td>
                            </tr>
                            </tbody>
                            <br>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
