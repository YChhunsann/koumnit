<?php

namespace App\Http\Controllers;

use App\Models\Koumnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class KoumnitLikeController extends Controller
{
    public function like(Koumnit $koumnit)
    {
        $liker = Auth::user();
        $liker->likes()->attach($koumnit);
        return redirect()->route('dashboard');
    }

    public function unlike(Koumnit $koumnit)
    {
        $liker = Auth::user();
        $liker->likes()->detach($koumnit);
        return redirect()->route('dashboard');
    }
}
