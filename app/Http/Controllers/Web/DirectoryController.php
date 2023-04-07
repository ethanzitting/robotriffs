<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class DirectoryController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Directory', [
            'users' => User::all(),
        ]);
    }
}
