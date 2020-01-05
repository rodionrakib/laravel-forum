<?php


namespace App\Filter;


use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadFilter extends Filter
{


    public function name($userName)
    {
        $user = User::where('name', $userName)->firstOrFail();
        return $this->builder->where('user_id', $user->id);


    }


}