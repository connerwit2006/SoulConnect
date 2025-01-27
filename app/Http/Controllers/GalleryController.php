<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Slaat image op in de gallerij
    public function store(Request $request)
    {
        // Afbeelding Validatie
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // stopt afbeelding in de storage
        $imagePath = $request->file('image')->store('images', 'public');

        // nieuwe gallerij entry
        $gallery = new Gallery([
            'user_id' => auth()->id(), // assuming you're using authentication
            'image_path' => $imagePath,
        ]);

        // Save the gallery entry
        $gallery->save();

        return redirect()->back()->with('success', 'Image uploaded successfully!');
    }

    // Functie die images verwijderd in de gallerij
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Verwijder de image van de storage
        Storage::disk('public')->delete($gallery->image_path);

        // Verwijder gallerij afbeelding
        $gallery->delete();

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}
