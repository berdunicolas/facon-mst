<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class TeamController extends Controller
{
    public User $authUser;

    public function index(): View
    {
        $this->authUser = auth()->user();

        $teams = $this->authUser->allTeams();

        return view('teams.index', ['teams' => $teams]);
    }

    public function show(): View
    {
        $this->authUser = auth()->user();

        return view('teams.show');
    }
}
