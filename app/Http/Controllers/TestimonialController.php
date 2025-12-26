<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;

class TestimonialController extends Controller
{
    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'content' => $validated['content'],
            'rating' => $validated['rating'],
            'photo_path' => $photoPath,
        ]);

        return redirect()
            ->route('welcome')
            ->with('testimonial_status', 'Terima kasih! Testimoni kamu sudah terkirim.');
    }
}
