<x-app-layout>
    <div>
        <form action="{{ route('workouts.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" />
            </div>
            <div>
                <label for="description">Description</label>
                <textarea type="text" id="description" name="description"></textarea>
            </div>
            <div>
                <label for="date">Date</label>
                <input type="date" id="date" name="date" />
            </div>
            <div>
                <label for="time">Time</label>
                <input type="time" id="time" name="time" />
            </div>
            <div>
                <label for="place_city">Place City</label>
                <input type="text" id="place_city" name="place_city" />
            </div>
            <div>
                <label for="place_address">Place Address</label>
                <input type="text" id="place_address" name="place_address" />
            </div>
            <div>
                <label for="buffer_time">Buffer time</label>
                <input type="number" id="buffer_time" name="buffer_time" />
            </div>
            <div>
                <label for="distance">Distance</label>
                <input type="number" id="distance" name="distance" />
            </div>
            <div>
                <label for="pace_m">Pace</label>
                <input type="number" id="pace_m" name="pace_m" value="" min="0" max="59" /> m
                <input type="number" id="pace_s" name="pace_s" value="" min="0" max="59" /> s
            </div>
            <div>
                <button type="submit">Add Workout</button>
            </div>
        </form>
    </div>

    <ul>
        <li><a href="{{ route('workouts.index') }}">All Workouts</a></li>
    </ul>
</x-app-layout>