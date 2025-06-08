<?php

namespace App\Http\Controllers;

use App\Models\Koumnit;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $search = request('search');

        $koumnits = Koumnit::with('user')
            ->when($search, function ($query, $search) {
                $query->where('content', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboard', compact('koumnits'));
    }
}
