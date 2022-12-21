@extends('examples.m4_7d_layout')

@section('main')
    <table>
        <thead>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Erfasst am</th>
            <th>Interne Preise</th>
            <th>Externe Preise</th>
        </thead>
        <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{$d['name']}}</td>
                    <td>{{$d['beschreibung']}}</td>
                    <td>{{$d['erfasst_am']}}</td>
                    <td>{{$d['preis_intern']}}</td>
                    <td>{{$d['preis_extern']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection