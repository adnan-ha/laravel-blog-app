@extends('layouts.app')

@section('title', 'create-post')

@section('content')

    <h1>Add Post:</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" class="mt-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="post title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">description:</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="post description"></textarea>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="category">category:</label>
            <select class="form-select" id="category" name="category">
                <option value="">choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="tag">tags:</label>
            <select class="form-select" id="tag" name="tags[]" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">choose image:</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>
        <input type="submit" value="Send" class="btn btn-primary w-50 d-block m-auto">
    </form>

@endsection
