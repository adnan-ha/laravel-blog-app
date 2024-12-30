<div class="border-top border-secondary ">
    <h5 class="mt-3">Comments:</h5>
    <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <textarea class="form-control" id="comment" name="comment" rows="2" placeholder="Enter your comment"></textarea>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit <i class="fas fa-paper-plane"></i></button>
    </form>
    <div class="comments mt-5">
        @foreach ($comments as $comment)
            <div class="comment gap-3 mb-4">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('assets/images/users/' . $comment->user->photo) }}"
                        class="user_photo rounded-circle">
                    <p class="fw-normal m-0">{{ $comment->user->name }}</p>
                </div>
                <div class="d-flex align-items-center">
                    <div class="comment_content py-2 px-3 bg-light rounded-4 mt-1 ms-5">{{ $comment->comment }}</div>
                    @if (auth()->id() == $comment->user_id || auth()->id() == $post->user_id)
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false"> <i
                                class="fa-solid fa-ellipsis text-muted fs-4"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="dropdownMenuButton">
                            @if (auth()->id() == $comment->user_id)
                                <li>
                                    <a class="dropdown-item" href="{{ route('comments.edit', $comment->id) }}">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        Edit
                                    </a>
                                </li>
                            @endif
                            <li>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">
                                        <i class="fa-solid fa-trash me-2"></i>
                                        Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
