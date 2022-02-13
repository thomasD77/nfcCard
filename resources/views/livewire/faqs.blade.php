<div>
    <table class="table table-striped table-hover table-vcenter  fs-sm">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="d-none d-sm-table-cell" >Question</th>
            <th class="d-none d-sm-table-cell" >Created</th>
            <th class="d-none d-sm-table-cell" >Updated</th>
            <th class="d-none d-sm-table-cell text-center" >Actions</th>
        </tr>
        </thead>
        <tbody>

        @if($faqs)
            @foreach($faqs as $faq)
                <tr>
                    <td class="text-center">{{$faq->id ? $faq->id : 'No ID'}}</td>
                    <td>{{$faq->question ? $faq->question : 'No question'}}</td>
                    <td>{{$faq->created_at->diffForHumans()}}</td>
                    <td>{{$faq->updated_at->diffForHumans()}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <!-- Button trigger modal -->
                            <a href="{{route('faqs.edit', $faq->id)}}"><button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Faq">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button></a>
                            <button class="btn btn-sm btn-alt-secondary" wire:click="archiveFaq({{$faq->id}})"><i class="fa fa-archive"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $faqs->links()  !!}
</div>
