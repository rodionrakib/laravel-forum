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
                           @forelse( $replies as $reply)
                                <section>
                                    <p> {{$reply->creator->name}} said at {{$reply->created_at->diffForHumans()}} </p>
                                    @if(auth()->check())
                                    <form method="post" action="/replies/{{$reply->id}}/favourites"
                                    style="float: right"
                                    >
                                        @csrf
                                        <input class="btn btn-primary" type="submit" value="Favourite"
                                        {{ $reply->isAlreadyFavorated() ? 'disabled':''  }}
                                        >
                                    </form>
                                    @endif
                                    <div>
                                        {{$reply->body}}
                                    </div>

                                </section><hr>
                               @empty
                               Be the First one to comment
                           @endforelse
                            {{$replies->links()}}
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
                        <p>Total  {{$thread->replies_count}} {{\Illuminate\Support\Str::plural('reply',$thread->replies_count)}}</p>
                    </div>
                </div>
            </div>

    </div>
@endsection
