<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auto toevoegen</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container centered-layout">
    <div style="width: 100%; max-width: 550px;">
        <a href="{{ route('home') }}" class="back-link">← Terug naar overzicht</a>
        <h1>Auto toevoegen</h1>

        <div class="form-card">
            @if($errors->any())
                <div class="errors">
                    <strong>Oeps! Fouten gevonden:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="model">Modelnaam *</label>
                    <input id="model" name="model" value="{{ old('model') }}" required placeholder="Bijv. Tesla Model 3">
                </div>

                <div class="form-group">
                    <label for="year">Bouwjaar *</label>
                    <input type="number" id="year" name="year" value="{{ old('year') }}" required min="1901" max="{{ date('Y') + 1 }}">
                </div>

                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea id="description" name="description" rows="4" 
                            placeholder="Vertel iets over de staat van de auto...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Foto van de auto *</label>
                    <input type="file" id="image" name="image" accept="image/*" required style="border: none; padding: 0;">
                </div>

                <button class="btn" type="submit" style="width: 100%;">Auto Opslaan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>