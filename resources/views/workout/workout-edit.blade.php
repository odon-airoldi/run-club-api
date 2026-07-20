<div>
    <form action="{{ route('workouts.update', $workout) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $workout->name }}" />
        </div>
        <div>
            <label for="description">Description</label>
            <textarea type="text" id="description" name="description">{{ $workout->description }}</textarea>
        </div>
        <div>
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="{{ $workout->date_time->format('Y-m-d') }}" />
        </div>
        <div>
            <label for="time">Time</label>
            <input type="time" id="time" name="time" value="{{ $workout->date_time->format('H:i') }}" />
        </div>
        <div>
            <label for="place_city">Place City</label>
            <input type="text" id="place_city" name="place_city" value="{{ $workout->place_city }}" />
        </div>
        <div>
            <label for="place_address">Place Address</label>
            <input type="text" id="place_address" name="place_address" value="{{ $workout->place_address }}" />
        </div>
        <div>
            <label for="buffer_time">Buffer time</label>
            <input type="number" id="buffer_time" name="buffer_time" value="{{ $workout->buffer_time }}" />
        </div>
        <div>
            <label for="distance">Distance</label>
            <input type="number" id="distance" name="distance" value="{{ $workout->distance }}" />
        </div>
        <div>
            <label for="pace">Pace</label>
            <input type="number" id="pace_m" name="pace_m" value="{{ ($workout->pace - $workout->pace % 60) / 60 }}"
                min="0" max="59" /> m
            <input type="number" id="pace_s" name="pace_s" value="{{ $workout->pace % 60 }}" min="0" max="59" /> s
        </div>
        <div>
            <button type="submit">Update Workout</button>
        </div>
    </form>
</div>

<ul>
    <li><a href="{{ route('workouts.show', $workout) }}">View Workout</a></li>
    <li>
        <form action="{{ route('workouts.destroy', $workout) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete this Workout</button>
        </form>
    </li>
    <li><a href="{{ route('workouts.index') }}">All Workouts</a></li>
</ul>