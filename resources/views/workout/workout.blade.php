<x-app-layout>

    <div class="mb-8">
        <h2 class="text-3xl font-bold">{{ $workout->name }}</h2>
        <p class="mb-8">{{ $workout->description }}</p>
        <p>Date: {{ $workout->date_time->format('d/m/Y') }}</p>
        <p>Hour: {{ $workout->date_time->format('H:i') }}</p>
        <p>Buffer time: {{ $workout->buffer_time }} min</p>
        <p>Place: {{ $workout->place_city }} - {{ $workout->place_address }}</p>
        <p>Distance: {{ $workout->distance }} km</p>
        <p>Pace:
            {{
            sprintf('%02d' ,($workout->pace - $workout->pace % 60) / 60 )}}:{{ sprintf('%02d' ,$workout->pace % 60)
            }} min/km
        </p>
    </div>

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
</x-app-layout>