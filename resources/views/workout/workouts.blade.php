<x-app-layout>
    <ul>
        <li class="p-4 border-b-1">
            <div class="grid grid-cols-[auto_1fr_8.333%_8.333%_8.333%] gap-4">
                <div></div>
                <div>Workout</div>
                <div>User</div>
                <div>km</div>
                <div>min/km</div>
            </div>
        </li>
        @foreach ($workouts as $workout)

        <li class="p-4 border-b-1">
            <a class="grid grid-cols-[auto_1fr_8.333%_8.333%_8.333%] gap-4"
                href="{{ route('workouts.show', $workout) }}">
                <div>{{ $workout->id }}</div>
                <div>{{ $workout->name }}</div>
                <div>{{ $workout->user->name}}</div>
                <div>{{ $workout->distance }}</div>
                <div>{{ $workout->pace }}</div>
            </a>
        </li>



        @endforeach
    </ul>

    <ul>
        <li><a href="{{ route('workouts.create') }}">Add Workout</a></li>
    </ul>
</x-app-layout>