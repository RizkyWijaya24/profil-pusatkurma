<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Pesan Anda berhasil terkirim! Kami akan segera menghubungi Anda.');
    }
}
