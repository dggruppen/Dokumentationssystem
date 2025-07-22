@extends('layout')

@section('content')
    <h2>Dokument</h2>
    <ul>
        @foreach($documents as $document)
            <li>{{ $document->title }}</li>
        @endforeach
    </ul>
@endsection
