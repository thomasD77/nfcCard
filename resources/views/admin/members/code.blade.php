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
                        <th scope="col">URL</th>
                        <th scope="col">=> url needs to be programmed in the NFC card</th>
                        <th scope="col">Material</th>
                        <th scope="col">QR-code</th>
                        <th scope="col">=> QRcode needs to be PRINTED ON the backside OF NFC Card</th>
                    </tr>
                    </thead>
                    @if($members)
                        @foreach($members as $member)
                            <tbody>
                                <tr>
                                    <td>{{$member->memberURL ? $member->memberURL : 'No URL'}}</td>
                                    <td></td>
                                    <td>{{$member->material ? $member->material->name : 'No Material'}}</td>
                                    <td></td>
                                    <td><img class="my-3" src="{{ $member->memberQRcode }}" alt="QRcode"></td>
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
