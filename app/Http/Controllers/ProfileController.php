<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $activities = $this->getActivities($user);


        return view('profiles.show',[
            'profile_user'=>$user,
            'activities' => $activities
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getActivities(User $user)
    {
        $activities = $user->activities()->with('subject')->latest()->get()->groupBy(function ($activity) {
            return $activity->created_at->toDateString();
        });
        return $activities;
    }
}
