<style>
    .table {
        width: 100%;
    }
    td {
        border: 1px solid #000;
    }
    .QRcode {
        margin-left: 15px;
    }
    .non {
        border: none
    }
    .spacing {
        margin: 25px 0;
    }
    .text {
        text-align: center;
    }
</style>

<!-- Page Content -->
<div class="content container-fluid">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded row">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Card credentials
            </h3>
        </div>
        <table class="table table-striped table-hover table-vcenter fs-sm">
            <thead>
            <tr>
                <th >URL <br> (printed in the NFC chip)</th>

                <th >Card Material</th>

                <th >Design FRONT <br> (printed or engraved)</th>

                <th >QR-code BACK <br> (printed or engraved)</th>
            </tr>
            </thead>
            <div class="spacing"></div>
            @if($members)
                @foreach($members as $member)
                    <tbody>
                    <tr>
                        <td class="text">{{$member->memberURL ? $member->memberURL : 'No URL'}}</td>

                        <td class="text">{{$member->material ? $member->material->name : 'No Material'}}</td>

                        <td class="text">{{$member->image ? $member->image : 'No Image'}}</td>

                        <td class="text non"><img class="QRcode" src="{{ $member->memberQRcode }}" alt="QRcode"></td>
                    </tr>
                    </tbody>
                    <br>
                @endforeach
            @endif
        </table>
    </div>
    <!-- END Dynamic Table Full -->
</div>
