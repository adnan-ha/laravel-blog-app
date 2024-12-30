@extends('layouts.app')

@section('title', 'edit-comment')

@section('content')
    <h1>Edit comment:</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="mt-5">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="comment" class="form-label">comment:</label>
            <textarea type="text" class="form-control" id="comment" name="comment" rows="2">{{ $comment->comment }}</textarea>
        </div>
        <input type="submit" value="edit" class="btn btn-primary w-50 d-block m-auto">
    </form>

@endsection
