@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Thread</div>

                    <div class="card-body">
                        <form method="post" action="{{route('threads.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Channel</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="channel_id">
                                    @foreach(\App\Channel::all() as $channel)
                                        <option value="{{$channel->id}}">{{$channel->name}}
                                        {{old('channel_id') == $channel->id ? 'selected' : ''}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control"  value="{{old('title')}}" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" class="form-control" rows="8" >{{old('body')}}</textarea>
                            </div>
                            <button type="submit" class="btn-primary">Submit</button>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
