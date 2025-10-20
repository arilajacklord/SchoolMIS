<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\SubjectStoreRequest;
use App\Http\Requests\SubjectUpdateRequest;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_code' => 'required|string|max:255',
            'descriptive_title' => 'required|string|max:255',
            'led_units' => 'required|integer|min:0',
            'lab_units' => 'required|integer|min:0',
            'total_units' => 'required|integer|min:0',
            'pre_requisite' => 'nullable|string|max:255',
            'co_requisite' => 'nullable|string|max:255',
        ]);

        if ($request->subject_id) {
            $subject = Subject::findOrFail($request->subject_id);
            $subject->update($data);
            return redirect()->route('subjects.index')->with('success', 'Subject updated!');
        } else {
            Subject::create($data);
            return redirect()->route('subjects.index')->with('success', 'Subject added!');
        }
    }

    /**
     * Fix: Laravel expects an update method for PUT/PATCH.
     * Delegate update call to existing store() method.
     */
    public function update(Request $request, $id)
    {
        // Inject the subject_id into the request so store() knows it's an update
        $request->merge(['subject_id' => $id]);

        // Call the store method which handles both create & update
        return $this->store($request);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted!');
    }

    public function apiEdit($id)
    {
        return Subject::findOrFail($id);
    }

    public function apiShow($id)
    {
        return Subject::findOrFail($id);
    }
}
