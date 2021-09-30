<?php

namespace App\Http\Controllers;

use App\Models\Lesson;

class LessonController extends Controller
{
    public function show(Lesson $lesson)
    {
        return view('lesson.show', compact('lesson',));
    }
}