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
                       @forelse($activities as $date=>$activity)
                            <div class="page-header">{{$date}}</div>
                           @foreach($activity as $record)
                           <div>
                               @include("profiles.activities.{$record->event_type}")
                           </div>
                           @endforeach
                        @empty
                            <p>No Activity Yet!</p>
                       @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
