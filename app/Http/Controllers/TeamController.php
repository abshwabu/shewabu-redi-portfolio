<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        return view('team.index', [
            'members' => TeamMember::query()->published()->ordered()->get(),
        ]);
    }

    public function show(TeamMember $teamMember): View
    {
        abort_unless($teamMember->status === \App\Enums\ContentStatus::Published, 404);

        return view('team.show', [
            'member' => $teamMember,
        ]);
    }
}
