<x-app-layout>
<div class="container-xxl flex-grow-1 container-p-y mt-4">
    <div class="row">
        <div class="col-lg-12">

            {{-- Alerts --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Header + Print All --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-primary">Prospectus</h3>

                <!-- PRINT BUTTON -->
                <a href="{{ route('prospectus.print') }}" 
                   target="_blank" 
                   class="btn btn-secondary">
                    <i class="fa fa-print"></i> Print All
                </a>
            </div>

            {{-- Single Table for All Terms --}}
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="prospectusTable" class="table table-striped table-hover table-bordered align-middle text-center">
                            <thead class="table-info">
                                <tr>
                                    <th>#</th>
                                    <th>School Year</th>
                                    <th>Semester</th>
                                    <th>Course Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Lec</th>
                                    <th>Lab</th>
                                    <th>Total</th>
                                    <th>Co-Req</th>
                                    <th>Pre-Req</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($prospectus as $term)
                                    @foreach ($term['subjects'] as $sub)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $term['schoolyear'] }}</td>
                                            <td>{{ ucfirst($term['semester']) }}</td>
                                            <td class="fw-semibold">{{ $sub->course_code }}</td>
                                            <td>{{ $sub->descriptive_title }}</td>
                                            <td>{{ $sub->led_units ?? $sub->lec_units ?? '-' }}</td>
                                            <td>{{ $sub->lab_units ?? '-' }}</td>
                                            <td>{{ $sub->total_units ?? '-' }}</td>
                                            <td>{{ $sub->co_requisite ?? $sub->co_reqs ?? 'None' }}</td>
                                            <td>{{ $sub->pre_requisite ?? $sub->prereq ?? 'None' }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#prospectusTable').DataTable({
        pageLength: 10,
        order: [[1, 'asc'], [2, 'asc'], [3, 'asc']]
    });
});
</script>
</x-app-layout>
