<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Koumnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function store(Koumnit $koumnit){
        request()->validate([
            'content' => 'required|min:5',
        ]);

        $comment = new Comment();
        $comment->koumnit_id = $koumnit->id;
        $comment->user_id = Auth::id();
        $comment->content = request('content');
        $comment->save();
        
        return redirect()->route('koumnits.show', $koumnit->id)->with('success', 'Comment created successfully!');
    }
}
