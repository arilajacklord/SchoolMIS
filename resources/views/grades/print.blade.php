<x-app-layout>
<div class="container mt-4">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-success text-white text-center">
            <h4>Grade Report</h4>
        </div>
        <div class="card-body">
            <p><b>Student:</b> {{ $enrollment->registration->student_name }}</p>
            <p><b>Subject:</b> {{ $enrollment->subject->descriptive_title }}</p>
            <p><b>Course Code:</b> {{ $enrollment->subject->course_code }}</p>
            <p><b>School Year:</b> {{ $enrollment->schoolyear->schoolyear }} - {{ ucfirst($enrollment->schoolyear->semester) }}</p>

            <hr>
            <table class="table table-bordered text-center align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Prelim</th>
                        <th>Midterm</th>
                        <th>Semifinal</th>
                        <th>Final</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $enrollment->grade->prelim ?? 'N/A' }}</td>
                        <td>{{ $enrollment->grade->midterm ?? 'N/A' }}</td>
                        <td>{{ $enrollment->grade->semifinal ?? 'N/A' }}</td>
                        <td>{{ $enrollment->grade->final ?? 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
window.print();
</script>
</x-app-layout>
