<?php

namespace App\Http\Controllers;

use App\Models\Koumnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $followingIDs = Auth::user()->followings()->pluck('user_id');

        $koumnits = Koumnit::whereIn('user_id', $followingIDs)->latest();

        if (request()->has('search')) {
            $koumnits = $koumnits->where('content', 'like', '%' . request()->get('search', '') . '%');
        }

        return view('dashboard', [
            'koumnits' => $koumnits->paginate(5)
        ]);
    }
}
