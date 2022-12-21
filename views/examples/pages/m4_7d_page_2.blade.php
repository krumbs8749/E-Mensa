@extends('examples.m4_7d_layout')

@section('main')
    <table>
        <thead>
        <th>Name</th>
        </thead>
        <tbody>
        @foreach($data as $d)
            <tr>
                <td>{{$d['name']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection