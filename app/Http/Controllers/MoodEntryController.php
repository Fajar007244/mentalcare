<?php

namespace App\Http\Controllers;

use App\Models\MoodEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moodEntries = Auth::user()->moodEntries()->latest()->get();

        // Prepare data for chart
        $moodDates = $moodEntries->sortBy('entry_date')->pluck('entry_date')->map(fn($date) => $date->format('Y-m-d'))->toArray();
        $moodScores = $moodEntries->sortBy('entry_date')->pluck('mood_score')->toArray();

        return view('mood-entries.index', compact('moodEntries', 'moodDates', 'moodScores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mood-entries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mood_score' => 'required|integer|min:1|max:5',
            'notes' => 'nullable|string|max:1000',
            'entry_date' => 'required|date|unique:mood_entries,entry_date,NULL,id,user_id,' . Auth::id(),
        ]);

        Auth::user()->moodEntries()->create($request->all());

        return redirect()->route('mood-entries.index')
                         ->with('success', 'Mood entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MoodEntry $moodEntry)
    {
        if ($moodEntry->user_id !== Auth::id()) {
            abort(403);
        }
        return view('mood-entries.show', compact('moodEntry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MoodEntry $moodEntry)
    {
        if ($moodEntry->user_id !== Auth::id()) {
            abort(403);
        }
        return view('mood-entries.edit', compact('moodEntry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MoodEntry $moodEntry)
    {
        if ($moodEntry->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'mood_score' => 'required|integer|min:1|max:5',
            'notes' => 'nullable|string|max:1000',
            'entry_date' => 'required|date|unique:mood_entries,entry_date,' . $moodEntry->id . ',id,user_id,' . Auth::id(),
        ]);

        $moodEntry->update($request->all());

        return redirect()->route('mood-entries.index')
                         ->with('success', 'Mood entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MoodEntry $moodEntry)
    {
        if ($moodEntry->user_id !== Auth::id()) {
            abort(403);
        }

        $moodEntry->delete();

        return redirect()->route('mood-entries.index')
                         ->with('success', 'Mood entry deleted successfully.');
    }
}
