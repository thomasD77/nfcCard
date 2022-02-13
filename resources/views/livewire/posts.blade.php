<div>
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Avatar</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Status</th>
            <th scope="col">Registered</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id ? $post->id : 'No ID'}}</td>
                    <td>
                        @foreach($post->photos->take(1) as $photo)
                            <img class="rounded" height="62" width="62" src="{{$photo ? asset('images/posts') . $photo->file : 'http://placehold.it/62x62'}}" alt="{{$post->title}}">
                        @endforeach
                    </td>
                    <td>{{$post->title ? $post->title : 'No Title'}}</td>
                    <td>{{$post->user ? $post->user->name : 'No Author'}}</td>

                    @if($post->book == null)
                        <td><i class="fa fa-dot-circle text-dark" data-toggle="tooltip" data-title="Archive Sub"></i></td>
                    @elseif($post->book > now()->addHour()->format('Y-m-d\TH:i'))
                        <td><i class="fa fa-dot-circle text-warning"></i></td>
                    @elseif($post->book <= now()->addHour()->format('Y-m-d\TH:i'))
                        <td><i class="fa fa-dot-circle text-success"></i></td>
                    @endif

                    <td>{{$post->created_at ? $post->created_at->diffForHumans() : 'Not Verified'}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route('posts.edit', $post->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Post">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                            </a>
                            <button class="btn btn-sm btn-alt-secondary" wire:click="archivePost({{$post->id}})"><i class="fa fa-archive"></i></button>
                            <a href="{{route('posts.show', $post->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show Post">
                                    <i class="far fa-eye"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $posts->links()  !!}
</div>
