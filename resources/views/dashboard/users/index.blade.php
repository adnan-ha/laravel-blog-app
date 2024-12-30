@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('layouts.navbar')
    <div class="content my-3 p-4 rounded-4">
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-circle-plus"></i>
            Add User
        </a>
        <table class="users_table table mt-3">
            <thead>
                <tr>
                    <th class="text-danger" scope="col">#</th>
                    <th class="text-danger" scope="col">Name</th>
                    <th class="text-danger" scope="col">Email</th>
                    <th class="text-danger" scope="col">role</th>
                    <th class="text-danger" scope="col">Update</th>
                    <th class="text-danger" scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->is_admin == 1)
                                admin
                            @else
                                user
                            @endif
                        </td>
                        <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">update</a></td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
