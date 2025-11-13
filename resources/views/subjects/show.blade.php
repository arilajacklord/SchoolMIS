<x-app-layout>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Subject Details</h2>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Subject ID</th>
                    <td>{{ $subject->subject_id }}</td>
                </tr>
                <tr>
                    <th>Course Code</th>
                    <td>{{ $subject->course_code }}</td>
                </tr>
                <tr>
                    <th>Descriptive Title</th>
                    <td>{{ $subject->descriptive_title }}</td>
                </tr>
                <tr>
                    <th>Lecture Units</th>
                    <td>{{ $subject->lec_units }}</td>
                </tr>
                <tr>
                    <th>Lab Units</th>
                    <td>{{ $subject->lab_units }}</td>
                </tr>
                <tr>
                    <th>Total Units</th>
                    <td>{{ $subject->total_units }}</td>
                </tr>
                <tr>
                    <th>Co-Requisite</th>
                    <td>{{ $subject->co_requisite ?? 'None' }}</td>
                </tr>
                <tr>
                    <th>Pre-Requisite</th>
                    <td>{{ $subject->pre_requisite ?? 'None' }}</td>
                </tr>
            </table>
        </div>
     </div>
</x-app-layout>
