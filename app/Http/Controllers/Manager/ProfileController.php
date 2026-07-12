<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $manager = auth()->user();

        return view(
            'manager.profile.index',
            compact('manager')
        );
    }
}
