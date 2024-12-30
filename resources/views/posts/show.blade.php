@extends('layouts.app')

@section('title', 'Post')

@section('content')
    @include('layouts.navbar')
    <div class="content my-3 p-4 rounded-4">
        <div class="container bg-transparent">
            <div class="card bg-transparent mb-3 p-0 p-md-3 p-lg-4 border-0">
                <div class="user_info d-flex align-items-center gap-2 pb-2 border-bottom border-secondary">
                    <img src="{{ asset('assets/images/users/' . $user->photo) }}" class="show_post_user_photo rounded-circle">
                    <p class="fw-normal m-0 fw-bold">{{ $user->name }}</p>
                </div>
                <p class="card-text"><small class="text-body-secondary fs-5 ">{{ $category }}</small></p>
                @if ($post->image)
                    <img src="{{ asset('assets/images/posts/' . $post->image) }}" class="card-img-top mt-2 rounded">
                @endif
                <div class="card-body bg-transparent">
                    <h4 class="card-title mb-4 mb-4">{{ $post->title }}</h4>
                    <p class="card-text fs-5">{{ $post->description }}</p>
                    <div class="post_tags d-flex flex-wrap">
                        @foreach ($tags as $tag)
                            <a href=""
                                class="post_tag mx-1 my-2 p-2 bg-secondary text-light rounded-pill text-decoration-none">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
                @include('comments.index')
            </div>
        </div>
    </div>
@endsection
