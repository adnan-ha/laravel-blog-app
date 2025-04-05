@extends('layouts.app')
@section('title', 'register')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
            <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-bold fs-4">Register</h5>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="name">
                            <label for="name">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="confirm" name="password_confirmation" placeholder="Confirm">
                            <label for="confirm">Confirm Password</label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
