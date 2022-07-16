<!-- Page Content -->
<div class="content container-fluid">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded row">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                SWAP SCANS
            </h3>
        </div>
        <div class="block-content block-content-full overflow-scroll">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <div>
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        <th scope="col">Member</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Message</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Notes</th>
                    </tr>
                    </thead>
                    @if($contacts)
                        @foreach($contacts as $contact)
                            <tbody>
                                <tr>
                                    <td>{{ $contact->member->firstname }} {{ $contact->member->lastname }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->message }}</td>
                                    <td>{{ $contact->created_at }}</td>
                                    <td>{{ $contact->notes }}</td>
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
