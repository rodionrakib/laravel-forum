@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="card-header">{{$thread->title}}</h3>
                    <div class="card-body">
                        <article>
                            <p> Posted By <a href="/profiles/{{$thread->owner->name}}">{{$thread->owner->name}} </a>{{$thread->created_at->diffForHumans()}} </p>
                            @can('delete',$thread)
                            <form method="POST" action="{{$thread->path()}}">
                                @csrf
                                @method('DELETE')
                                <button  type="submit"> Delete </button>
                            </form>

                            @endcan
                            <div> {{$thread->body}} </div>
                        </article>
                    </div>
                    <div class="card">
                        <div class="card-header"> Replies</div>
                        <div class="card-body">
                           @forelse( $replies as $reply)
                                <p> <a href="/profiles/{{$reply->creator->name}}"> {{$reply->creator->name}} </a> said at {{$reply->created_at->diffForHumans()}} </p>
                                    @if(auth()->check())
                                    <form method="post" action="/replies/{{$reply->id}}/favourites">
                                        @csrf
                                        <button class="btn btn-primary" type="submit" >
                                            {{\Illuminate\Support\Str::plural('Favourite',$reply->favourites_count)}}
                                        </button>
                                    </form>
                                    @endif
                                    <div>
                                        {{$reply->body}}
                                    </div>
                                    @can('delete',$reply)
                                    <form method="POST" action="/replies/{{$reply->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button  type="submit"> Delete </button>
                                    </form>
                                    <form method="POST" action="/replies/{{$reply->id}}">
                                        @csrf
                                        @method('PATCH')
                                        <textarea name="body"> {{$reply->body}} </textarea>
                                        <button  type="submit"> Update </button>
                                    </form>
                                    @endcan

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
