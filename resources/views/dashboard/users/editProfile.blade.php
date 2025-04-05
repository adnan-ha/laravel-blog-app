@extends('layouts.app')

@section('title', 'edit-profile')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1>Edit Profile:</h1>
    <a href="{{ $admin ? route('users.index') : route('posts.index') }}" class="bg-light rounded-5 p-2 m-0 h5"><i class="fa fa-solid fa-arrow-left fa-lg text-primary"></i></a>
</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <img src="{{ asset('assets/images/users/' . $user->photo) }}" class="profile_img mx-auto d-block rounded-circle">
    <p class="text-center fw-bold fs-5 mt-2">{{ $user->name }} | {{ $user->email }}</p>
    <form action="{{ route('updateProfile') }}" method="POST" class="mt-3 row g-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3 col-md-6">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3 col-md-6">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="mb-3 col-md-6 mx-auto">
            <label for="formFile" class="form-label">choose photo:</label>
            <input class="form-control" type="file" id="formFile" name="photo">
        </div>
        <input type="submit" value="Edit" class="btn btn-primary w-100">
    </form>

@endsection
