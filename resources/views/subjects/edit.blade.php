<x-app-layout>

<div class="card mt-5">
  <h2 class="card-header">Edit Subject</h2>
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('subjects.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Subject ID (readonly) --}}
        <div class="mb-3">
            <label for="subject_id" class="form-label"><strong>Subject ID:</strong></label>
            <input
                type="text"
                name="subject_id"
                class="form-control @error('subject_id') is-invalid @enderror"
                id="subject_id"
                value="{{ old('subject_id', $subject->subject_id) }}"
                readonly>
            @error('subject_id')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Course Code Dropdown --}}
        <div class="mb-3">
            <label for="course_code" class="form-label"><strong>Course Code:</strong></label>
            <select name="course_code" id="course_code" class="form-select @error('course_code') is-invalid @enderror">
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->code }}" {{ old('course_code', $subject->course_code) == $course->code ? 'selected' : '' }}>
                        {{ $course->code }} - {{ $course->name }}
                    </option>
                @endforeach
            </select>
            @error('course_code')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descriptive Title --}}
        <div class="mb-3">
            <label for="descriptive_title" class="form-label"><strong>Descriptive Title:</strong></label>
            <input
                type="text"
                name="descriptive_title"
                class="form-control @error('descriptive_title') is-invalid @enderror"
                id="descriptive_title"
                value="{{ old('descriptive_title', $subject->descriptive_title) }}"
                placeholder="Enter Descriptive Title">
            @error('descriptive_title')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Lecture Units --}}
        <div class="mb-3">
            <label for="led_units" class="form-label"><strong>Lecture Units:</strong></label>
            <input
                type="number"
                step="0.01"
                name="led_units"
                class="form-control @error('led_units') is-invalid @enderror"
                id="led_units"
                value="{{ old('led_units', $subject->led_units) }}"
                placeholder="Enter Lecture Units">
            @error('led_units')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Lab Units --}}
        <div class="mb-3">
            <label for="lab_units" class="form-label"><strong>Lab Units:</strong></label>
            <input
                type="number"
                step="0.01"
                name="lab_units"
                class="form-control @error('lab_units') is-invalid @enderror"
                id="lab_units"
                value="{{ old('lab_units', $subject->lab_units) }}"
                placeholder="Enter Lab Units">
            @error('lab_units')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Total Units --}}
        <div class="mb-3">
            <label for="total_units" class="form-label"><strong>Total Units:</strong></label>
            <input
                type="number"
                step="0.01"
                name="total_units"
                class="form-control @error('total_units') is-invalid @enderror"
                id="total_units"
                value="{{ old('total_units', $subject->total_units) }}"
                placeholder="Enter Total Units">
            @error('total_units')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Co-Requisite Dropdown --}}
        <div class="mb-3">
            <label for="co_requisite" class="form-label"><strong>Co-Requisite:</strong></label>
            <select name="co_requisite" id="co_requisite" class="form-select @error('co_requisite') is-invalid @enderror">
                <option value="">-- Select Co-Requisite --</option>
                @foreach($subjects as $subj)
                    @if($subj->id != $subject->id)
                        <option value="{{ $subj->subject_id }}" {{ old('co_requisite', $subject->co_requisite) == $subj->subject_id ? 'selected' : '' }}>
                            {{ $subj->subject_id }} - {{ $subj->descriptive_title }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('co_requisite')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Pre-Requisite Dropdown --}}
        <div class="mb-3">
            <label for="pre_requisite" class="form-label"><strong>Pre-Requisite:</strong></label>
            <select name="pre_requisite" id="pre_requisite" class="form-select @error('pre_requisite') is-invalid @enderror">
                <option value="">-- Select Pre-Requisite --</option>
                @foreach($subjects as $subj)
                    @if($subj->id != $subject->id)
                        <option value="{{ $subj->subject_id }}" {{ old('pre_requisite', $subject->pre_requisite) == $subj->subject_id ? 'selected' : '' }}>
                            {{ $subj->subject_id }} - {{ $subj->descriptive_title }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('pre_requisite')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </form>

  </div>
</div>

</x-app-layout>
