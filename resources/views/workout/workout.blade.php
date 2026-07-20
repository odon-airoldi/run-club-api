<ul>

    <li>{{ $workout->name }}</li>
    <li>{{ $workout->date_time->format('d/m/Y') }}</li>
    <li>{{ $workout->date_time->format('H:i') }}</li>
    <li>{{ sprintf('%02d' ,($workout->pace - $workout->pace % 60) / 60 )}}:{{ sprintf('%02d' ,$workout->pace % 60) }}
    </li>

</ul>