<ul>

    <li>{{ $workout->name }}</li>
    <li>{{ $workout->date_time->format('d/m/Y') }}</li>
    <li>{{ $workout->date_time->format('H:i') }}</li>
    <li>{{ ($workout->pace - $workout->pace % 60) / 60 }}:{{ $workout->pace % 60 }}</li>

</ul>
{{-- @dd($workout->pace) --}}