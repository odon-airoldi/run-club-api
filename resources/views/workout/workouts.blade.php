<ul>
    @foreach ($workouts as $workout)

    <li>
        <a href="{{ route('workouts.show', $workout) }}">{{ $workout->name }}</a>
    </li>

    @endforeach
</ul>

<ul>
    <li><a href="{{ route('workouts.create') }}">Add Workout</a></li>
</ul>