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

    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $data = $this->gifsService->search($search, 0) ?? [];
        return Inertia::render('Gifs/Index', [
            'initialSearch' => $search,
            'initialData' => $data,
        ]);
    }

    public function search(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|min:1|max:255',
            'offset' => 'nullable|integer|min:0|max:4999',
        ]);
        return $this->gifsService->search($validated['name'], $validated['offset'] ?? 0);
    }

    public function history()
    {
        $recents = $this->gifsService->getRecents();
        return Inertia::render('Gifs/History', [
            'recents' => $recents,
        ]);
    }

    public function removeBySearch(string $search)
    {
        $this->gifsService->removeBySearch($search);
    }
}
