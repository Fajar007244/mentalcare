<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\AppointmentConfirmed;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'psychologist' || $user->role === 'admin') {
            $appointments = Appointment::where('psychologist_id', $user->id)->latest()->paginate(10);
        } else {
            $appointments = Appointment::where('user_id', $user->id)->latest()->paginate(10);
        }
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $psychologists = User::where('role', 'psychologist')->get();

        $query = Schedule::where('is_booked', false);

        if ($request->has('psychologist_id') && $request->psychologist_id != '') {
            $query->where('user_id', $request->psychologist_id);
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('start_time', $request->date);
        }

        $availableSchedules = $query->with('user')->orderBy('start_time')->get();

        return view('appointments.create', compact('availableSchedules', 'psychologists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        $schedule = Schedule::find($request->schedule_id);

        if ($schedule->is_booked) {
            return redirect()->back()->withErrors(['schedule_id' => 'Jadwal ini sudah dipesan.']);
        }

        // Create the appointment with 'unpaid' status
        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'psychologist_id' => $schedule->user_id,
            'schedule_id' => $schedule->id,
            'appointment_time' => $schedule->start_time,
            'status' => 'unpaid', // New status
        ]);

        // Create a pending payment record
        $payment = Payment::create([
            'user_id' => Auth::id(),
            'appointment_id' => $appointment->id,
            'amount' => $schedule->price,
            'status' => 'pending',
        ]);

        // Mark the schedule as booked so no one else can take it
        $schedule->update(['is_booked' => true]);

        // Redirect user to the payment page
        return redirect()->route('payments.show', $payment)
                         ->with('success', 'Janji temu berhasil dibuat. Silakan selesaikan pembayaran.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id() && $appointment->psychologist_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id() && $appointment->psychologist_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }
        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id() && $appointment->psychologist_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $rules = [
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'meeting_link' => 'nullable|url',
            'notes' => 'nullable|string',
        ];

        // Only psychologist or admin can update notes and meeting link
        if (Auth::user()->role === 'psychologist' || Auth::user()->role === 'admin') {
            // No additional rules needed, already covered
        } else {
            // Regular user can only update status to cancelled
            $rules = [
                'status' => 'required|in:cancelled',
            ];
        }

        $request->validate($rules);

        $originalStatus = $appointment->getOriginal('status');
        $appointment->update($request->all());

        // If appointment is cancelled, make the schedule available again
        if ($appointment->status === 'cancelled' && $originalStatus !== 'cancelled') {
            $appointment->schedule->update(['is_booked' => false]);
            
            // Optionally, handle refund logic here or mark payment as needing refund
            if ($appointment->payment) {
                $appointment->payment->update(['status' => 'failed']); // Or a new 'refunded' status
            }
        }

        return redirect()->route('appointments.index')
                         ->with('success', 'Janji temu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id() && $appointment->psychologist_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $appointment->schedule->update(['is_booked' => false]);
        $appointment->delete();

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment deleted successfully.');
    }

    public function showAppointmentsSchedules()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $appointments = Appointment::where('psychologist_id', $user->id)->latest()->paginate(10);
        $schedules = $user->schedules()->latest()->paginate(10);

        return view('psychologist.dashboard-unified', compact('appointments', 'schedules'));
    }
}
