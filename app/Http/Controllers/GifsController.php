<?php

namespace App\Http\Controllers;

use App\Services\GifsService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GifsController extends Controller
{
    public function __construct(
        private GifsService $gifsService
    ) {
    }

    public function index()
    {
        return Inertia::render('Gifs/Index');
    }

    public function search(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'offset' => 'nullable|integer|min:0|max:4999',
        ]);
        return $this->gifsService->search($validated['name'], $validated['offset'] ?? 0);
    }
}
