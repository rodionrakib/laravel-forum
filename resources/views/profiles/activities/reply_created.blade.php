@component('profiles.activities.activily')
    @slot('heading')
        <div class="card-header">{{$profile_user->name}} Replied To <a href="{{$record->subject->thread->path()}}"> {{$record->subject->thread->title}} </a></div>
    @endslot

    @slot('body')

        <div class="card-body">
            <p> {{$record->subject->body}}</p>
        </div>
    @endslot
@endcomponent

