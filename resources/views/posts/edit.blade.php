@extends('layouts.app')

@section('title', 'edit-post')

@section('content')

    <h1>Edit Post:</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="mt-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="post title"
                value="{{ $post->title }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">description:</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="post description">{{ $post->description }}</textarea>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="category">category:</label>
            <select class="form-select" id="category" name="category">
                <option value="" selected>choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($post->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="tag">tags:</label>
            <select class="form-select" id="tag" name="tags[]" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                        @foreach ($postTags as $postTag)
                          @if ($tag->id == $postTag)
                              selected
                          @endif @endforeach>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">choose image:</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>
        <input type="submit" value="Edit" class="btn btn-primary w-50 d-block m-auto">
    </form>

@endsection
