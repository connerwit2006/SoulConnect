<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Store the uploaded image
    public function store(Request $request)
    {
        // Validate the incoming image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image
        $imagePath = $request->file('image')->store('images', 'public');

        // Create a new gallery entry
        $gallery = new Gallery([
            'user_id' => auth()->id(), // assuming you're using authentication
            'image_path' => $imagePath,
        ]);

        // Save the gallery entry
        $gallery->save();

        return redirect()->back()->with('success', 'Image uploaded successfully!');
    }

    // Delete the image from the gallery
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete the image file from the storage
        Storage::disk('public')->delete($gallery->image_path);

        // Delete the gallery record
        $gallery->delete();

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}
