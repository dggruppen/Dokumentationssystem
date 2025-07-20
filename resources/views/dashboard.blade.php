@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Välkommen, {{ Auth::user()->name }}!</h2>

    <div class="card mt-4">
        <div class="card-header">🔔 Notifieringar</div>
        <div class="card-body">
            <ul>
                @forelse ($notifications as $notification)
                    <li>
                        {{ $notification->data['message'] }}
                        <small class="text-muted">({{ $notification->created_at->diffForHumans() }})</small>
                    </li>
                @empty
                    <li>Inga notifieringar att visa.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
