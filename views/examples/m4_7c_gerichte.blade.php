@extends("layout")

@section("content")
    <h5>Kategorien sortiert nach Namen (ASC)</h5>
    <ol>
        @forelse($data as $d)
                <li>Name : {{$d['name']}}, Preis Intern: {{number_format($d['preis_intern'], 2, ',')}}</li>
        @empty
            <p>Es sind keine Gerichte vorhanden</p>
        @endforelse
    </ol>
@endsection