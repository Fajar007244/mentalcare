<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Auth::user()->schedules()->latest()->paginate(10);
        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'price' => 'required|numeric|min:0',
        ]);

        Auth::user()->schedules()->create($request->all());

        return redirect()->route('schedules.index')
                         ->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        // Ensure the authenticated user owns this schedule
        if ($schedule->user_id !== Auth::id()) {
            abort(403);
        }
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        // Ensure the authenticated user owns this schedule
        if ($schedule->user_id !== Auth::id()) {
            abort(403);
        }
        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        // Ensure the authenticated user owns this schedule
        if ($schedule->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'price' => 'required|numeric|min:0',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')
                         ->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        // Ensure the authenticated user owns this schedule
        if ($schedule->user_id !== Auth::id()) {
            abort(403);
        }

        $schedule->delete();

        return redirect()->route('schedules.index')
                         ->with('success', 'Schedule deleted successfully.');
    }
}
