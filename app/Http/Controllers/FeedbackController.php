<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Mail\Feedback;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function create () {
        return view('feedback-form');

    }

    public function send (Request $request): RedirectResponse {
        $validate = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
            'comment' => 'required|max:150'

        ]);

        $fullname = $request->input('name');
        $email = $request->input('email');
        $comment = $request->input('comment');

        Mail::to('comp3385@uwi.edu', 'COMP3385 Course Admin')
            ->send(new Feedback($fullname, $email, $comment));

        
        return redirect('/success');     
    }
}
