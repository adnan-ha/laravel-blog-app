@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    @include('layouts.navbar')
    <div class="content my-3 p-4 rounded-4">
        <a href="{{ route('posts.create') }}" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Add Post</a>
        <div class="posts_wrapper row row-cols-1 mt-4 px-md-5">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('assets/images/users/' . $post->user->photo) }}"
                                        class="user_photo rounded-circle">
                                    <p class="fw-normal m-0 fw-bold">{{ $post->user->name }}</p>
                                </div>
                                @if (auth()->id() == $post->user_id)
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false"> <i
                                            class="fa-solid fa-ellipsis text-dark fs-4"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
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
                            <h5 class="card-title my-3">{{ $post->title }}</h5>
                            @if ($post->image)
                                <img src="{{ asset('assets/images/posts/' . $post->image) }}" class="post-image rounded-3">
                            @endif
                            <div class="d-flex justify-content-end mt-2">
                                <a href="{{ route('posts.show', $post->id) }}"
                                    class=" read_more_link text-secondary text-decoration-none ">
                                    read more
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
