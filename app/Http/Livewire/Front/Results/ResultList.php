<?php

namespace App\Http\Livewire\Front\Results;

use App\Models\Test;
use Livewire\Component;

class ResultList extends Component
{
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $tests = Test::select('id', 'result', 'time_spent', 'user_id', 'quiz_id', 'created_at')
            ->where('user_id', auth()->id())
            ->with(['quiz' => function ($query) {
                $query->select('id', 'title', 'description');
                $query->withCount('questions');
            }])
            ->paginate();

        return view('livewire.front.results.result-list', [
            'tests' => $tests
        ]);
    }
}
