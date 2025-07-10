<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;

class QuizController extends Controller
{
    /**
     * Menampilkan daftar semua kuis yang tersedia untuk pengguna.
     */
    public function userIndex()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    /**
     * Display a listing of the quizzes for admin.
     */
    public function index()
    {
        $quizzes = Quiz::latest()->paginate(10);
        return view('quizzes.admin_index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new quiz.
     */
    public function create()
    {
        return view('quizzes.admin_create');
    }

    /**
     * Store a newly created quiz in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $quiz = Quiz::create($request->all());

        return redirect()->route('admin.quizzes.index')
                         ->with('success', 'Quiz created successfully. Now add questions.');
    }

    /**
     * Display the specified quiz (for admin to manage questions).
     */
    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers'); // Eager load questions and their answers
        return view('quizzes.admin_show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified quiz.
     */
    public function edit(Quiz $quiz)
    {
        return view('quizzes.admin_edit', compact('quiz'));
    }

    /**
     * Update the specified quiz in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $quiz->update($request->all());

        return redirect()->route('admin.quizzes.index')
                         ->with('success', 'Quiz updated successfully.');
    }

    /**
     * Remove the specified quiz from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete(); // This should also delete related questions and answers via cascade delete in migration

        return redirect()->route('admin.quizzes.index')
                         ->with('success', 'Quiz deleted successfully.');
    }

    /**
     * Menampilkan halaman untuk memulai sebuah kuis.
     */
    public function start(Quiz $quiz)
    {
        $quiz->load('questions'); // Eager load questions
        return view('quizzes.start', compact('quiz'));
    }

    /**
     * Menyimpan hasil percobaan kuis ke database.
     */
    public function storeAttempt(Request $request, Quiz $quiz)
    {
        $answers = $request->input('answers');
        $totalScore = 0;

        foreach ($quiz->questions as $question) {
            if (isset($answers[$question->id])) {
                $totalScore += (int)$answers[$question->id];
            }
        }

        $summary = $this->getPhq9Summary($totalScore);

        $attempt = QuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'score' => $totalScore,
            'result_summary' => $summary,
            'answers' => $answers,
        ]);

        return redirect()->route('quizzes.result', ['quiz' => $quiz->id, 'attempt' => $attempt->id]);
    }

    /**
     * Menampilkan halaman hasil dari sebuah percobaan kuis.
     */
    public function result(Quiz $quiz, QuizAttempt $attempt)
    {
        // Pastikan pengguna hanya bisa melihat hasilnya sendiri
        if ($attempt->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('quizzes.result', compact('quiz', 'attempt'));
    }

    /**
     * Memberikan ringkasan berdasarkan skor PHQ-9.
     */
    private function getPhq9Summary(int $score): string
    {
        if ($score <= 4) {
            return 'Gejala depresi minimal atau tidak ada. Anda kemungkinan besar tidak memerlukan bantuan profesional saat ini, tetapi tetap pantau suasana hati Anda.';
        } elseif ($score <= 9) {
            return 'Gejala depresi ringan. Mungkin ada baiknya untuk memantau suasana hati Anda dan mempertimbangkan untuk berbicara dengan seorang teman atau konselor.';
        } elseif ($score <= 14) {
            return 'Gejala depresi sedang. Disarankan untuk berkonsultasi dengan dokter atau profesional kesehatan mental untuk evaluasi lebih lanjut.';
        } elseif ($score <= 19) {
            return 'Gejala depresi sedang hingga berat. Sangat disarankan untuk mencari bantuan profesional dari dokter atau terapis secepatnya.';
        } else {
            return 'Gejala depresi berat. Sangat penting bagi Anda untuk segera mencari bantuan profesional. Jangan ragu untuk menghubungi layanan darurat jika Anda merasa sangat tertekan.';
        }
    }

    // Methods for Question and Answer Management (Admin)
    public function createQuestion(Quiz $quiz)
    {
        return view('quizzes.admin_questions_create', compact('quiz'));
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2',
            'answers.*.answer_text' => 'required|string',
            'answers.*.score' => 'required|integer',
        ]);

        $question = $quiz->questions()->create([
            'question_text' => $request->question_text,
        ]);

        foreach ($request->answers as $answerData) {
            $question->answers()->create($answerData);
        }

        return redirect()->route('admin.quizzes.show', $quiz)
                         ->with('success', 'Question and answers added successfully.');
    }

    public function editQuestion(Quiz $quiz, Question $question)
    {
        $question->load('answers');
        return view('quizzes.admin_questions_edit', compact('quiz', 'question'));
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2',
            'answers.*.id' => 'nullable|exists:answers,id', // For existing answers
            'answers.*.answer_text' => 'required|string',
            'answers.*.score' => 'required|integer',
        ]);

        $question->update(['question_text' => $request->question_text]);

        // Update existing answers and create new ones
        $existingAnswerIds = [];
        foreach ($request->answers as $answerData) {
            if (isset($answerData['id'])) {
                $answer = Answer::find($answerData['id']);
                if ($answer && $answer->question_id === $question->id) {
                    $answer->update($answerData);
                    $existingAnswerIds[] = $answer->id;
                }
            } else {
                $newAnswer = $question->answers()->create($answerData);
                $existingAnswerIds[] = $newAnswer->id;
            }
        }

        // Delete answers that were removed from the form
        $question->answers()->whereNotIn('id', $existingAnswerIds)->delete();

        return redirect()->route('admin.quizzes.show', $quiz)
                         ->with('success', 'Question and answers updated successfully.');
    }

    public function destroyQuestion(Quiz $quiz, Question $question)
    {
        $question->delete(); // This should also delete related answers via cascade delete

        return redirect()->route('admin.quizzes.show', $quiz)
                         ->with('success', 'Question deleted successfully.');
    }
}