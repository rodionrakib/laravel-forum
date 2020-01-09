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
                    <div class="card-header">Threads</div>

                    <div class="card-body">
                       @forelse($threads as $thread)
                           <h3> <a href="{{$thread->path()}}">{{$thread->title}}</a> </h3>
                           <div>
                               {{$thread->body}}
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
