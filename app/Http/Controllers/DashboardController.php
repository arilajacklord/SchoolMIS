<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        // Count users by type
        $students = User::where('type', 'student')->count();
        $teachers = User::where('type', 'teacher')->count();

        // Count subjects and courses
        $subjects = Subject::count();
        $courses  = Course::count();

        // Recent subjects: order by subject_id descending
        $recentSubjects = Subject::orderBy('subject_id', 'desc')->take(4)->get();

        // Enrollment chart data
        $chartData = Enrollment::selectRaw('courses.course_name as name, COUNT(*) as total')
            ->join('subjects', 'subjects.subject_id', '=', 'enrollments.subject_id')
            ->join('courses', 'courses.course_id', '=', 'subjects.course_id')
            ->groupBy('courses.course_name')
            ->pluck('total', 'name');

        return view('dashboard', [
            'students'       => $students,
            'teachers'       => $teachers,
            'subjects'       => $subjects,
            'courses'        => $courses,
            'recentSubjects' => $recentSubjects,
            'chartLabels'    => $chartData->keys(),
            'chartValues'    => $chartData->values(),
        ]);
    }
}
