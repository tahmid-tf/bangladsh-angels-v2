<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AngelAcademyNetworkApplication;
use Illuminate\View\View;

class AngelAcademyNetworkApplicationController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $applications = AngelAcademyNetworkApplication::query()
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('admin.angel-academy-applications.index', compact('applications'));
    }

    public function show(AngelAcademyNetworkApplication $angelAcademyNetworkApplication): View
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $angelAcademyNetworkApplication->load('user');

        return view('admin.angel-academy-applications.show', [
            'application' => $angelAcademyNetworkApplication,
        ]);
    }
}
