@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Threads</div>

                    <div class="card-body">
                        @forelse($threads as $thread)
                            <article>
                                <h2> <a href="{{$thread->path()}}">{{$thread->title}}</a></h2>
                                <div> {{$thread->body}} </div>
                            </article>
                        @empty
                            <p>Dont have any threads to visit</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
