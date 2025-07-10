<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data kuis dan pertanyaan yang ada untuk menghindari duplikasi
        DB::table('questions')->delete();
        DB::table('quizzes')->delete();

        $quiz = Quiz::create([
            'title' => 'Tes Depresi PHQ-9',
            'description' => 'Selama 2 minggu terakhir, seberapa sering Anda terganggu oleh masalah-masalah berikut? Kuis ini adalah alat untuk membantu menyaring depresi, bukan diagnosis. Silakan berkonsultasi dengan seorang profesional untuk diagnosis.'
        ]);

        $options = json_encode([
            ['text' => 'Tidak sama sekali', 'score' => 0],
            ['text' => 'Beberapa hari', 'score' => 1],
            ['text' => 'Lebih dari separuh hari', 'score' => 2],
            ['text' => 'Hampir setiap hari', 'score' => 3],
        ]);

        $questions = [
            ['question_text' => 'Kurang minat atau kesenangan dalam melakukan sesuatu', 'order' => 1],
            ['question_text' => 'Merasa sedih, tertekan, atau putus asa', 'order' => 2],
            ['question_text' => 'Sulit tidur atau tetap tidur, atau tidur terlalu banyak', 'order' => 3],
            ['question_text' => 'Merasa lelah atau kurang berenergi', 'order' => 4],
            ['question_text' => 'Nafsu makan buruk atau makan berlebihan', 'order' => 5],
            ['question_text' => 'Merasa buruk tentang diri sendiri - atau bahwa Anda adalah seorang yang gagal atau telah mengecewakan diri sendiri atau keluarga Anda', 'order' => 6],
            ['question_text' => 'Sulit berkonsentrasi pada sesuatu, seperti membaca koran atau menonton televisi', 'order' => 7],
            ['question_text' => 'Bergerak atau berbicara sangat lambat sehingga orang lain bisa memperhatikan. Atau sebaliknya - menjadi sangat gelisah atau resah sehingga Anda lebih sering bergerak dari biasanya', 'order' => 8],
            ['question_text' => 'Pikiran bahwa Anda lebih baik mati, atau ingin menyakiti diri sendiri', 'order' => 9],
        ];

        foreach ($questions as $questionData) {
            $quiz->questions()->create([
                'question_text' => $questionData['question_text'],
                'options' => $options,
                'order' => $questionData['order'],
            ]);
        }
    }
}
