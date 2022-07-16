<!-- Page Content -->
<div class="content container-fluid">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded row">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Card credentials
            </h3>
        </div>
        <div class="block-content block-content-full overflow-scroll">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <div>
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        <th scope="col"># Card ID</th>
                        <th scope="col">URL</th>
                        <th scope="col">Material</th>
                        <th scope="col">Role</th>
                        <th scope="col">Business</th>
                        <th scope="col">Image</th>
                        <th scope="col">Reservation</th>
                    </tr>
                    </thead>
                    @if($members)
                        @foreach($members as $member)
                            <tbody>
                                <tr>
                                    <td>{{ $member->card_id }}</td>
                                    <td>{{ $member->memberURL ? $member->memberURL : 'No URL' }}</td>
                                    <td>{{ $member->material->name }}</td>
                                    <td>{{ $member->listRole->name }}</td>
                                    <td>{{ $member->business }}</td>
                                    <td>{{ $member->image }}</td>
                                    <td>{{ $member->reservation }}</td>
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
