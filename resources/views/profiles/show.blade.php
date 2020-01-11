@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        <h4>{{$profile_user->name}} </h4>
                        <p>Member since {{$profile_user->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Recent Activities</div>

                    <div class="card-body">
                       @forelse($activities as $activity)
                           <div>
                               @include("profiles.activities.{$activity->event_type}")
{{--                               @if($activity->event_type == 'thread_created')--}}
{{--                                    <p> He created a thread {{$activity->subject->title}}</p>--}}
{{--                               @endif--}}
{{--                               @if($activity->event_type == 'reply_created')--}}
{{--                                   <p> He Replied a thread</p>--}}
{{--                               @endif--}}

                           </div>
                           @empty
                           <p>No Threads Yet!</p>
                       @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
