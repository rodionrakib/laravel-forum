<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $threads = $user->threads;
        return view('profiles.show',[
            'profile_user'=>$user,
            'threads' => $threads
        ]);
    }
}
