<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CategoryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manageUser', User::class);
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manageUser', User::class);
        $request->validate([
            'name' => 'required|string|min:4|max:15',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        ]);

        if ($request->hasFile('category_image')) {
            $imageName = time() . '-' . $request->file('category_image')->getClientOriginalName();
            $request->file('category_image')->move(public_path('assets/images/categories'), $imageName);
        }

        Category::create([
            'name' => $request->name,
            'image' => $imageName,
        ]);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('manageUser', User::class);
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('manageUser', User::class);
        $request->validate([
            'name' => 'required|string|min:4|max:15',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        ]);

        if ($request->hasFile('image')) {
            if (file_exists(public_path('assets/images/categories/' . $category->image))) {
                unlink(public_path('assets/images/categories/' . $category->image));
            }
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/images/categories'), $imageName);
            $category->image = $imageName;
        }

        $category->update([
            'name' => $request->name,
            'image' => $category->image,
        ]);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('manageUser', User::class);
        $category->delete();
        if (file_exists(public_path('assets/images/categories/' . $category->image))) {
            unlink(public_path('assets/images/categories/' . $category->image));
        }
        return redirect()->route('categories.index');
    }
}
