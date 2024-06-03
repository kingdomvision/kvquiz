<?php

use App\Http\Controllers\{HomeController, ProfileController, ResultController};
use App\Http\Livewire\Admin\{Tests\MyTestList, Tests\TestList, User\UserForm, User\UserList};
use App\Http\Livewire\User\{Quiz\QuizList as UserQuizList, Result\ResultList};
use App\Http\Livewire\Front\{Leaderboard};
use App\Http\Livewire\Question\{QuestionForm, QuestionList};
use App\Http\Livewire\Quiz\{QuizForm, QuizList};
use Illuminate\Support\Facades\{Auth, Route};

// ***
// Unauthenticated & General Routes
// ***
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect('login');
    }

    $route = redirect()->route('user.results');
    if (Auth::user()->is_admin) {
        $route = redirect()->route('leaderboard');
    }
    return $route;
})->name('home');

// ***
// Authenticated Routes
// ***
Route::middleware('auth')->group(function () {

    // ***
    // Admin Routes
    // ***
    Route::middleware('isAdmin')->prefix('admin')->group(function () {
        Route::get('leaderboard', Leaderboard::class)->name('leaderboard');
        Route::get('questions', QuestionList::class)->name('questions');
        Route::get('questions/create', QuestionForm::class)->name('question.create');
        Route::get('questions/{question}', QuestionForm::class)->name('question.edit');

        Route::get('quizzes', QuizList::class)->name('quizzes');
        Route::get('quizzes/create', QuizForm::class)->name('quiz.create');
        Route::get('quizzes/{quiz}/edit', QuizForm::class)->name('quiz.edit');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', UserList::class)->name('list');
            Route::get('create', UserForm::class)->name('create');
        });

        Route::get('tests', TestList::class)->name('tests');
    });

    // ***
    // User Routes
    // ***
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('results', ResultList::class)->name('results');
        Route::get('quiz-list', UserQuizList::class)->name('quiz-list');
        Route::middleware('throttle:10,1')->group(function () {
            Route::get('quiz/{quiz}', [HomeController::class, 'show'])->name('quiz.show');
        });
    });

    // ***
    // General Routes
    // ***
    Route::prefix(Auth::user()?->is_admin ? 'admin' : 'user')->group(function () {
        Route::get('results/{test}', [ResultController::class, 'show'])->name('results.show');

        Route::controller(ProfileController::class)->name('profile.')->group(function () {
            Route::get('/profile', 'edit')->name('edit');
            Route::patch('/profile', 'update')->name('update');
            Route::delete('/profile', 'destroy')->name('destroy');
        });
    });
});

require __DIR__ . '/auth.php';
