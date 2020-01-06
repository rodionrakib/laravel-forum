@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="card-header">{{$thread->title}}</h3>
                    <div class="card-body">
                        <article>
                            <p> Posted By {{$thread->owner->name}} {{$thread->created_at->diffForHumans()}} </p>
                            <div> {{$thread->body}} </div>
                        </article>
                    </div>
                    <div class="card">
                        <div class="card-header"> Replies</div>
                        <div class="card-body">
                           @forelse($thread->replies as $reply)
                                <section>
                                    <p> {{$reply->creator->name}} said at {{$reply->created_at->diffForHumans()}} </p>
                                    <div>
                                        {{$reply->body}}
                                    </div>
                                </section><hr>
                               @empty
                               Be the First one to comment
                           @endforelse
                        </div>
                    </div>
                    @if(auth()->check())

                    <div class="card">
                        <div class="card-header"> Add Reply</div>
                        <div class="card-body">
                           <form method="post" action="{{$thread->path()}}/replies">
                               @csrf
                               <textarea name="body" class="form-control" placeholder="Leave you reply" rows="5">

                               </textarea>
                               <button type="submit">Reply</button>
                           </form>
                        </div>
                    </div>
                        @else
                        <p> <a href="{{route('login')}}">Please log in </a> to add reply</p>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"> Meta Data</div>
                    <div class="card-body">
                       <p>This thread is posted at {{$thread->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </div>

    </div>
@endsection
