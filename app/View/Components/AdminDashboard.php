<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class AdminDashboard extends Component
{
    public $userCounts;

    public function __construct()
    {
        $this->userCounts = User::query()
            ->select('role')
            ->selectRaw('count(*) as count')
            ->groupBy('role')
            ->get()
            ->pluck('count', 'role');
    }

    public function render()
    {
        return view('components.admin-dashboard');
    }
}
