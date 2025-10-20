<x-app-layout>
<div class="card mt-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Course List</h2>
        <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> Add Subject
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Subject ID</th>
                        <th>Subject Code</th>
                        <th>Title</th>
                        <th>Lecture Units</th>
                        <th>Lab Units</th>
                        <th>Total Units</th>
                        <th>Co-Requisite</th>
                        <th>Pre-Requisite</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $index => $subject)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subject->subject_id }}</td>
                            <td>{{ $subject->course_code }}</td>
                            <td>{{ $subject->descriptive_title }}</td>
                            <td>{{ $subject->led_units }}</td>
                            <td>{{ $subject->lab_units }}</td>
                            <td>{{ $subject->total_units }}</td>
                            <td>{{ $subject->co_requisite }}</td>
                            <td>{{ $subject->pre_requisite }}</td>
                            <td>
                                <a href="{{ route('subjects.edit', $subject->subject_id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('subjects.destroy', $subject->subject_id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this subject?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No subjects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Subject Detail Modal --}}
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subjectModalLabel">Subject Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <tr><th>Subject ID</th><td id="modal-subject-id"></td></tr>
            <tr><th>Subject Code</th><td id="modal-course-code"></td></tr>
            <tr><th>Title</th><td id="modal-title"></td></tr>
            <tr><th>Lecture Units</th><td id="modal-led-units"></td></tr>
            <tr><th>Lab Units</th><td id="modal-lab-units"></td></tr>
            <tr><th>Total Units</th><td id="modal-total-units"></td></tr>
            <tr><th>Co-Requisite</th><td id="modal-co-requisite"></td></tr>
            <tr><th>Pre-Requisite</th><td id="modal-pre-requisite"></td></tr>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- JavaScript to populate modal --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const viewButtons = document.querySelectorAll('.view-btn');

        viewButtons.forEach(button => {
            button.addEventListener('click', () => {
                const subject = JSON.parse(button.getAttribute('data-subject'));

                document.getElementById('modal-subject-id').textContent = subject.subject_id ?? 'N/A';
                document.getElementById('modal-course-code').textContent = subject.course_code ?? 'N/A';
                document.getElementById('modal-title').textContent = subject.descriptive_title ?? 'N/A';
                document.getElementById('modal-led-units').textContent = subject.led_units ?? '0';
                document.getElementById('modal-lab-units').textContent = subject.lab_units ?? '0';
                document.getElementById('modal-total-units').textContent = subject.total_units ?? '0';
                document.getElementById('modal-co-requisite').textContent = subject.co_requisite ?? 'None';
                document.getElementById('modal-pre-requisite').textContent = subject.pre_requisite ?? 'None';
            });
        });
    });
</script>
@endpush

</x-app-layout>
