<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Dokumentationssystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">DokSys</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="#" role="button" data-bs-toggle="dropdown">
                            🔔
                            @if(auth()->user()->unreadNotifications->count())
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            @forelse(auth()->user()->unreadNotifications as $note)
                                <li class="dropdown-item">
                                    {{ $note->data['message'] }}
                                    <form method="POST" action="/notifications/read/{{ $note->id }}">
                                        @csrf
                                        <button class="btn btn-sm btn-link">Markera som läst</button>
                                    </form>
                                </li>
                            @empty
                                <li class="dropdown-item">Inga notifieringar</li>
                            @endforelse
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
