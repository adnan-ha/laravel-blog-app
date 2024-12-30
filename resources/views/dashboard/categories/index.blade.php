@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    @include('layouts.navbar')
    <div class="content my-3 p-4 rounded-4">
        @can('manageUser', Auth()->user())
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-circle-plus"></i>
                Add Category
            </a>
        @endcan
        <div class="container text-center my-4 p-5 rounded-4">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-2 g-lg-3">
                @foreach ($categories as $category)
                    <div class="col m-0 mb-3">
                        <div class="position-relative category_img_wrapper">
                            @can('manageUser', auth()->user())
                                <button class="btn btn-secondary dropdown-toggle position-absolute end-0 z-1" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis fs-4"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>
                                            Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="fa-solid fa-trash me-2"></i>
                                                delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            @endcan
                            <img src="{{ asset('assets/images/categories/' . $category->image) }}"
                                class="rounded-5 category_img">
                            <p class="fs-3 m-0 z-1 position-absolute top-50 start-50 translate-middle text-white">
                                {{ $category->name }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
