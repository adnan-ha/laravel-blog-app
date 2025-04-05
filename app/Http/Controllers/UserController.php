<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manageUser', User::class);
        $users = User::whereNot('id', Auth::id())->get();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manageuser', User::class);
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manageUser', User::class);
        $request->validate([
            'name' => 'required|string|min:4|max:20',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required|boolean',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            $imageName = time() . '-' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('assets/images/users'), $imageName);
        } else {
            $imageName = 'defaultUser.png';
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->role,
            'photo' => $imageName,
        ]);
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource (User).
     */
    public function edit_profile()
    {
        $user = Auth::user();
        $admin = $user->can('manageUser', User::class);
        return view('dashboard.users.editProfile', compact('user', 'admin'));
    }


    /**
     * Show the form for editing the specified resource (Admin).
     */
    public function edit(User $user)
    {
        $this->authorize('manageUser', User::class);
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage (User).
     */
    public function update_profile(Request $request, User $user)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|min:4|max:20',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'confirmed',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo != 'defaultUser.png') {
                if (file_exists(public_path('assets/images/users/' . $user->photo))) {
                    unlink(public_path('assets/images/users/' . $user->photo));
                }
            }
            $imageName = time() . '-' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('assets/images/users'), $imageName);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ?? $user->password,
            'is_admin' => $user->is_admin ? true : false,
            'photo' => $imageName ?? $user->photo,
        ]);

        return redirect()->route('editProfile');
    }

    /**
     * Update the specified resource in storage (Admin).
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('manageUser', User::class);
        $request->validate([
            'role' => 'required|boolean',
            'password' => 'confirmed',
        ]);

        $user->update([
            'password' => $request->password ?? $user->password,
            'is_admin' => $request->role,
        ]);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('manageUser', User::class);

        $posts = Post::where('user_id', $user->id)->get();
        if ($posts) {
            foreach ($posts as $post) {
                if ($post->image) {
                    if (file_exists(public_path('assets/images/posts/' . $post->image))) {
                        unlink(public_path('assets/images/posts/' . $post->image));
                    }
                }
            }
        }

        if ($user->photo != 'defaultUser.png') {
            if (file_exists(public_path('assets/images/users/' . $user->photo))) {
                unlink(public_path('assets/images/users/' . $user->photo));
            }
        }

        $user->delete();
        return redirect()->route('users.index');
    }
}
