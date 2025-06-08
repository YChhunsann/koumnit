<?php

namespace App\Http\Controllers;

use App\Models\Koumnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\CommonMarkConverter;




class KoumnitController extends Controller
{

    public function show(Koumnit $koumnit)
    {
        return view('koumnits.show', compact('koumnit'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|min:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp|max:5120', // allows 5MB
        ]);

        $validated['user_id'] = Auth::id();

        // If image is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('koumnit_images', 'public');
            $validated['image'] = $imagePath;
        }

        Koumnit::create($validated);

        return redirect()->route('dashboard')->with('success', 'Koumnit created successfully!');
    }

    public function destroy(Koumnit $koumnit)
    {
        Gate::authorize('koumnit.delete', $koumnit);

        $koumnit->delete();

        return redirect()->route('dashboard')->with('success', 'Koumnit deleted successfully!');
    }

    public function edit(Koumnit $koumnit)
    {
        Gate::authorize('koumnit.delete', $koumnit);
        $editing = true;
        return view('koumnits.show', compact('koumnit', 'editing'));
    }

    public function update(Koumnit $koumnit, Request $request)
    {
        Gate::authorize('koumnit.delete', $koumnit);

        $validated = $request->validate([
            'content' => 'required|min:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($koumnit->image && Storage::disk('public')->exists($koumnit->image)) {
                Storage::disk('public')->delete($koumnit->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('koumnit_images', 'public');
            $validated['image'] = $imagePath;
        }

        $koumnit->update($validated);

        return redirect()->route('koumnits.show', $koumnit->id)->with('success', 'Koumnit updated successfully!');
    }
}
