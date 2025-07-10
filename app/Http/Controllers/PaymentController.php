<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Events\AppointmentConfirmed;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $query = Payment::query();

        if ($user->role === 'psychologist') {
            // Psychologist sees payments for their completed appointments
            $query->whereHas('appointment', function ($q) use ($user) {
                $q->where('psychologist_id', $user->id);
            });
        } else {
            // User sees their own payments
            $query->where('user_id', $user->id);
        }

        $payments = $query->with(['user', 'appointment.psychologist'])->latest()->paginate(10);

        return view('payments.index', compact('payments'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);
        return view('payments.show', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $this->authorize('update', $payment);

        if ($request->action === 'confirm_payment' && $payment->status === 'pending') {
            // Update payment status
            $payment->update(['status' => 'completed']);

            // Update appointment status and generate Jitsi link
            $appointment = $payment->appointment;
            $roomName = 'mentalcare-' . Str::uuid();
            $jitsiLink = 'https://meet.jit.si/' . $roomName;
            
            $appointment->update([
                'status' => 'confirmed',
                'meeting_link' => $jitsiLink,
            ]);

            // Broadcast event for real-time notification
            event(new AppointmentConfirmed($appointment));

            return redirect()->route('appointments.show', $appointment)
                             ->with('success', 'Pembayaran berhasil. Janji temu Anda telah dikonfirmasi.');
        }

        return redirect()->back()->with('error', 'Aksi tidak valid.');
    }
}