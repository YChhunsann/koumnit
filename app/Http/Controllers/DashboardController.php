<?php

namespace App\Http\Controllers;

use App\Models\Koumnit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $koumnits = Koumnit::orderBy('created_at', 'desc');

        if (request()->has('search')) {
            $koumnits = $koumnits->where('content', 'like', '%' . request()->get('search', '') . '%');
        }

        return view('dashboard', [
            'koumnits' => $koumnits->paginate(5)
        ]);
    }
}
