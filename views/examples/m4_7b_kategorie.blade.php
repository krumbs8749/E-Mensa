@extends("layout")

@section("content")
    <h5>Kategorien sortiert nach Namen (ASC)</h5>
    <ol>
        @foreach($data as $d)
            @if($loop->even)
                <li>{{$d['name']}}</li>
            @else
                <li><b>{{$d['name']}}</b></li>
            @endif
        @endforeach
    </ol>
@endsection