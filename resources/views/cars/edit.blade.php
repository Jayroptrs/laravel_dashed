<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auto aanpassen</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container centered-layout">
    <div class="form-wrapper">
        <a href="{{ route('home') }}" class="back-link">← Terug naar overzicht</a>
        <h1>Auto aanpassen</h1>

        <div class="form-card">
            <form method="POST" action="{{ route('cars.update', $car->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="model">Modelnaam *</label>
                    <input id="model" name="model" value="{{ old('model', $car->model) }}" required>
                </div>

                <div class="form-group">
                    <label for="year">Bouwjaar *</label>
                    <input type="number" id="year" name="year" value="{{ old('year', $car->year) }}" required min="1901">
                </div>

                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea id="description" name="description">{{ old('description', $car->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Nieuwe foto (optioneel)</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <button class="btn btn-full" type="submit">Wijzigingen Opslaan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>