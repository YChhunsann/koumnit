<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $koumnits = $user->koumnits()->paginate(5);
        return view('users.show', compact('user', 'koumnits'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('profile.update', $user);
        $editing = true;
        $koumnits = $user->koumnits()->paginate(5);
        return view('users.edit', compact('user', 'editing', 'koumnits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        Gate::authorize('profile.update', $user);

        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'bio' => 'nullable|min:1|max:255',
                'image' => [
                    'nullable',
                    'image',
                    'mimes:jpeg,png,jpg,webp',
                ]
            ]
        );
        if (request()->has('image')) {
            $imagePath = request()->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }
        $user->update($validated);
        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(Auth::user());
    }
}
