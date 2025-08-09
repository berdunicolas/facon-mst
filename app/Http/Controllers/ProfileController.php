<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public User $authUser;

    public function show(): View
    {
        $this->authUser = auth()->user();

        return view('profile.show', ['user' => $this->authUser]);
    }
}
