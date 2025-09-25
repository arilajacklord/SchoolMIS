<x-app-layout>

<div class="card mt-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Subject Details</h2>
        <a href="{{ route('subjects.index') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Subject ID</dt>
            <dd class="col-sm-9">{{ $subject->subject_id }}</dd>

            <dt class="col-sm-3">Course Code</dt>
            <dd class="col-sm-9">{{ $subject->course_code }}</dd>

            <dt class="col-sm-3">Descriptive Title</dt>
            <dd class="col-sm-9">{{ $subject->descriptive_title }}</dd>

            <dt class="col-sm-3">Lecture Units</dt>
            <dd class="col-sm-9">{{ $subject->led_units }}</dd>

            <dt class="col-sm-3">Lab Units</dt>
            <dd class="col-sm-9">{{ $subject->lab_units }}</dd>

            <dt class="col-sm-3">Total Units</dt>
            <dd class="col-sm-9">{{ $subject->total_units }}</dd>

            <dt class="col-sm-3">Co-Requisite</dt>
            <dd class="col-sm-9">
                {{ $subject->co_requisite ?: 'None' }}
            </dd>

            <dt class="col-sm-3">Pre-Requisite</dt>
            <dd class="col-sm-9">
                {{ $subject->pre_requisite ?: 'None' }}
            </dd>
        </dl>

        <div class="mt-4">
            <a href="{{ route('subjects.edit', $subject->subject_id) }}" class="btn btn-warning btn-sm">
                <i class="fa fa-edit"></i> Edit
            </a>

            <form action="{{ route('subjects.destroy', $subject->subject_id) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Are you sure you want to delete this subject?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>

</x-app-layout>
