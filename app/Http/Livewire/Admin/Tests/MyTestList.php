<?php

namespace App\Http\Livewire\Admin\Tests;

use App\Models\Quiz;
use App\Models\Test;
use Livewire\Component;

class MyTestList extends Component
{
    protected int $paginate = 10;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $quizzes = Quiz::published()
            ->withCount('questions')
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.admin.tests.my-test-list', [
            'quizzes' => $quizzes,
            'i' => (request()->input('page', 1) - 1) * $this->paginate
        ]);
    }
}
