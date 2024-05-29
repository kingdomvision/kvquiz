<?php

use App\Http\Controllers\{HomeController, ProfileController, ResultController};
use App\Http\Livewire\Admin\{AdminForm, AdminList, Tests\MyTestList, Tests\TestList};
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Front\{Leaderboard, Results\ResultList};
use App\Http\Livewire\Question\{QuestionForm, QuestionList};
use App\Http\Livewire\Quiz\{QuizForm, QuizList};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect('login');
    }

    $route = redirect('my-results');
    if(Auth::user()->is_admin) {
        $route = redirect('leaderboard');
    }
    return $route;
})->name('home');

Route::get('results/{test}', [ResultController::class, 'show'])->name('results.show');

// protected routes
Route::middleware('auth')->group(function () {
    Route::get('my-results', ResultList::class)->name('my-results');
    Route::get('my-quiz-list', MyTestList::class)->name('my-quiz-list');
    Route::middleware('throttle:10,1')->group(function () {
        Route::get('quiz/{quiz}', [HomeController::class, 'show'])->name('quiz.show');
    });

    Route::controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });

    // Admin routes
    Route::middleware('isAdmin')->group(function () {
        Route::get('leaderboard', Leaderboard::class)->name('leaderboard');
        Route::get('questions', QuestionList::class)->name('questions');
        Route::get('questions/create', QuestionForm::class)->name('question.create');
        Route::get('questions/{question}', QuestionForm::class)->name('question.edit');

        Route::get('quizzes', QuizList::class)->name('quizzes');
        Route::get('quizzes/create', QuizForm::class)->name('quiz.create');
        Route::get('quizzes/{quiz}/edit', QuizForm::class)->name('quiz.edit');

        Route::get('admins', AdminList::class)->name('admins');
        Route::get('admins/create', AdminForm::class)->name('admin.create');

        Route::get('tests', TestList::class)->name('tests');
    });
});

require __DIR__ . '/auth.php';
