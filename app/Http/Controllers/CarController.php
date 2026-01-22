<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::query()->latest()->get();

        return view('cars.index', [
            'cars' => $cars,
        ]);
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'model' => ['required', 'string', 'max:255'],
            'year'  => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'description' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('cars', 'public');

        Car::create([
            'model' => $validated['model'],
            'year' => $validated['year'],
            'description' => $validated['description'],
            'image_path' => $path,
        ]);

        return redirect()->route('home')->with('success', 'Auto toegevoegd!');
    }

    public function destroy(Car $car)
    {
        if ($car->image_path) {
            Storage::disk('public')->delete($car->image_path);
        }

        $car->delete();

        return redirect()->route('home')->with('success', 'Auto succesvol verwijderd!');
    }

    public function edit(Car $car)
{
    return view('cars.edit', compact('car'));
}

public function update(Request $request, Car $car)
{
    $validated = $request->validate([
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:1901',
        'description' => 'nullable|string|max:1000',
        'image' => 'nullable|image|max:4096', // Foto is optioneel bij bewerken
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('cars', 'public');
        $car->image_path = $path;
    }

    $car->update([
        'model' => $validated['model'],
        'year' => $validated['year'],
        'description' => $validated['description'],
    ]);

    return redirect()->route('home')->with('success', 'Auto succesvol bijgewerkt!');
}
}