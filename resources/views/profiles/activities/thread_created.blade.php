@component('profiles.activities.activily')
    @slot('heading')
        <div class="card-header">{{$profile_user->name}} Published A Thread</div>
    @endslot

    @slot('body')
        <p> <a href="{{$record->subject->path()}}"> {{$record->subject->title}}</a></p>

    @endslot
@endcomponent

