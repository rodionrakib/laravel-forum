@component('profiles.activities.activily')
    @slot('heading')
        <div class="card-header">{{$profile_user->name}} Favorated A reply : <p>{{ $record->subject->favorited->body}} </p></div>
    @endslot

    @slot('body')
{{--        <p> <a href="{{$record->subject->path()}}"> {{$record->subject->title}}</a></p>--}}

    @endslot
@endcomponent

