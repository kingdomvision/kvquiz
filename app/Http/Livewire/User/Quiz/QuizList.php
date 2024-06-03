<?php

namespace App\Http\Livewire\User\Quiz;

use App\Models\Quiz;
use Livewire\Component;

class QuizList extends Component
{
    protected int $paginate = 10;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $quizzes = Quiz::published()
            ->withCount('questions')
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.user.quiz.quiz-list',
            [
                'quizzes' => $quizzes,
                'i' => (request()->input('page', 1) - 1) * $this->paginate,
                'user_completed_quizzes' => auth()->user()->tests()->pluck('quiz_id')->toArray()
            ]);
    }
}
