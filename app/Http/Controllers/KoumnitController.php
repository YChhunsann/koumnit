<?php

namespace App\Http\Controllers;

use App\Models\Koumnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Gate;

class KoumnitController extends Controller
{

    public function show(Koumnit $koumnit)
    {
        return view('koumnits.show', compact('koumnit'));
    }


    public function store()
    {
        $validated = request()->validate([
            'content' => 'required|min:5|max:255',
        ]);

        $validated['user_id'] = Auth::id();

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

    public function update(Koumnit $koumnit)
    {
        Gate::authorize('koumnit.delete', $koumnit);

        $validated = request()->validate([
            'content' => 'required|min:5|max:255',
        ]);
        $koumnit->update($validated);
        return redirect()->route('koumnits.show', $koumnit->id)->with('success', 'Koumnit updated successfully!');
    }
}
