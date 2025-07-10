<?php

namespace App\Http\Controllers;

use App\Models\PatientRecord;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-patient-records'); // Middleware untuk otorisasi
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patientRecords = PatientRecord::where('psychologist_id', Auth::id())
                                        ->latest()
                                        ->paginate(10);
        return view('patient-records.index', compact('patientRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $confirmedAppointments = Appointment::where('psychologist_id', Auth::id())
                                            ->where('status', 'confirmed')
                                            ->with('user') // Load the patient (user) relationship
                                            ->orderBy('appointment_time', 'desc')
                                            ->get();

        return view('patient-records.create', compact('confirmedAppointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'record_date' => 'required|date',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $appointment = Appointment::find($request->appointment_id);

        PatientRecord::create([
            'patient_id' => $appointment->user_id,
            'psychologist_id' => Auth::id(),
            'record_date' => $request->record_date,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('patient-records.index')
                         ->with('success', 'Catatan medis berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientRecord $patientRecord)
    {
        if ($patientRecord->psychologist_id !== Auth::id()) {
            abort(403);
        }
        return view('patient-records.show', compact('patientRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientRecord $patientRecord)
    {
        if ($patientRecord->psychologist_id !== Auth::id()) {
            abort(403);
        }
        $patients = User::where('role', 'user')->get();
        return view('patient-records.edit', compact('patientRecord', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatientRecord $patientRecord)
    {
        if ($patientRecord->psychologist_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'record_date' => 'required|date',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $patientRecord->update($request->all());

        return redirect()->route('patient-records.index')
                         ->with('success', 'Catatan medis berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatientRecord $patientRecord)
    {
        if ($patientRecord->psychologist_id !== Auth::id()) {
            abort(403);
        }

        $patientRecord->delete();

        return redirect()->route('patient-records.index')
                         ->with('success', 'Catatan medis berhasil dihapus.');
    }
}