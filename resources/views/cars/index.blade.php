<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home • Auto's</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container">
    <div class="top">
        <div>
            <h1>Alle auto's</h1>
            @if(session('success'))
                <div class="notice">{{ session('success') }}</div>
            @endif
        </div>
        <a class="btn" href="{{ route('cars.create') }}">+ Toevoegen</a>
    </div>

    <div class="grid">
        @forelse($cars as $car)
            <a href="#car-{{ $car->id }}" class="card">
                <div class="media">
                    <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->model }}">
                </div>
                <div class="body">
                    <div class="title">{{ $car->model }}</div>
                    <div class="card-text">Bouwjaar: {{ $car->year }}</div>
                </div>
            </a>

            <div id="car-{{ $car->id }}" class="modal-overlay">
                <div class="modal-content">
                    <a href="#" class="close-modal">&times;</a>
                    <div class="media">
                        <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->model }}">
                    </div>

                    <div class="modal-info">
                        <h2>{{ $car->model }}</h2>
                        <p><strong>Bouwjaar:</strong> {{ $car->year }}</p>
                        <p class="text-muted">{{ $car->description ?? 'Geen beschrijving beschikbaar.' }}</p>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-full">Auto Bewerken</a>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze auto wilt verwijderen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Verwijder Auto</button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>Er staan momenteel geen auto's in de database.</p>
                <a href="{{ route('cars.create') }}" style="color: var(--primary); text-decoration: underline;">Voeg je eerste auto toe</a>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>