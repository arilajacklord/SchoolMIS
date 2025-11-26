<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Schoolyear;
use App\Models\Subject;

class ProspectusController extends Controller
{
    /**
     * Show prospectus summary grouped by schoolyear + semester.
     * Only includes subjects that have enrollments.
     */
    public function index(Request $request)
    {
        // eager load subject & schoolyear, only enrollments that have subjects and schoolyears
        $enrollments = Enrollment::with(['subject', 'schoolyear'])
            ->whereHas('subject')
            ->whereHas('schoolyear')
            ->get();

        // group by schoolyear_id and semester for better printing/filtering
        $groups = $enrollments->groupBy(function($e) {
            return $e->schoolyear->schoolyear_id;
        });

        $prospectus = $groups->map(function($group) {
            $schoolyear = $group->first()->schoolyear;
            $subjects = $group->pluck('subject')
                ->unique('subject_id')
                ->sortBy('descriptive_title')
                ->values();

            return [
                'schoolyear_id' => $schoolyear->schoolyear_id,
                'schoolyear' => $schoolyear->schoolyear,
                'semester' => $schoolyear->semester,
                'subjects' => $subjects,
            ];
        })->values();

        $schoolyears = Schoolyear::orderBy('schoolyear')->orderBy('semester')->get();

        return view('prospectus.index', compact('prospectus', 'schoolyears'));
    }

    /**
     * Print prospectus.
     * If $schoolyear is specified, show only that schoolyear's terms.
     */
    public function print(Request $request, $schoolyear = null)
    {
        $query = Enrollment::with(['subject', 'schoolyear'])
            ->whereHas('subject')
            ->whereHas('schoolyear');

        if ($schoolyear) {
            $query->where('schoolyear_id', $schoolyear);
        } elseif ($request->filled('schoolyear_id')) {
            $query->where('schoolyear_id', $request->get('schoolyear_id'));
        }

        $enrollments = $query->get();

        $groups = $enrollments->groupBy('schoolyear_id');

        $prospectus = $groups->map(function($group) {
            $schoolyear = $group->first()->schoolyear;
            $subjects = $group->pluck('subject')
                ->unique('subject_id')
                ->sortBy('descriptive_title')
                ->values();

            return [
                'schoolyear' => $schoolyear->schoolyear,
                'semester' => $schoolyear->semester,
                'subjects' => $subjects,
            ];
        })->values();

        $meta = [
            'course_name' => 'Bachelor of Science in Information Technology',
            'effective_year' => optional($enrollments->first()->schoolyear)->schoolyear ?? '',
            'reference_cmos' => 'CMO references — (from your PDF)',
        ];

        return view('prospectus.print', compact('prospectus', 'meta'));
    }
}
