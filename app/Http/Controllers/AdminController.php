<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function listPsychologists()
    {
        $psychologists = User::where('role', 'psychologist')->get();
        return view('admin.psychologists.index', compact('psychologists'));
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_verified' => true]);
        return redirect()->route('admin.psychologists.index')->with('success', __('Psychologist verified successfully.'));
    }

    public function contentIndex()
    {
        return view('admin.content_management_dashboard');
    }
}
