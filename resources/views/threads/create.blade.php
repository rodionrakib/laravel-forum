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
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" class="form-control" rows="8"></textarea>
                            </div>
                            <button type="submit" class="btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
