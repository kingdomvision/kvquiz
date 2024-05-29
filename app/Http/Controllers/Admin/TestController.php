<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;

class TestController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $tests = Test::with(['user', 'quiz'])
                        ->withCount('questions')
                        ->latest()
                        ->paginate();

        return view('admin.tests', compact('tests'));
    }
}
