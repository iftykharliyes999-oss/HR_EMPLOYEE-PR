<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $employee = auth()->user();

        return view(
            'employee.profile.index',
            compact('employee')
        );
    }
}
