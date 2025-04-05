@extends('layouts.app')

@section('title', 'edit-user')

@section('content')

    <h1>Edit User:</h1>

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
    <form action="{{ route('users.update', $user->id) }}" method="POST" class="mt-5 g-3">
        @csrf
        @method('PUT')
        <div class="mb-3 col-md-6 mx-auto">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3 col-md-6 mx-auto">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="mb-3 col-md-6 mx-auto">
            <label class="form-label" for="role">Role:</label>
            <select class="form-select" id="role" name="role">
                @if ($user->is_admin == 1)
                    <option value="1" selected>admin</option>
                    <option value="0">user</option>
                @else
                    <option value="1">admin</option>
                    <option value="0" selected>user</option>
                @endif
            </select>
        </div>
        <input type="submit" value="Edit" class="btn btn-primary w-50 d-block mx-auto">
    </form>

@endsection
