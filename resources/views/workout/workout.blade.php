<ul>

    <li>{{ $workout->name }}</li>
    <li>{{ $workout->date_time->format('d/m/Y') }}</li>
    <li>{{ $workout->date_time->format('H:i') }}</li>
    <li>{{ sprintf('%02d' ,($workout->pace - $workout->pace % 60) / 60 )}}:{{ sprintf('%02d' ,$workout->pace % 60) }}
    </li>

</ul>

<ul>
    <li><a href="{{ route('workouts.edit', $workout) }}">Edit this Workout</a></li>
    <li>
        <form action="{{ route('workouts.destroy', $workout) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete this Workout</button>
        </form>
    </li>
    <li><a href="{{ route('workouts.create') }}">Add Workout</a></li>
</ul>