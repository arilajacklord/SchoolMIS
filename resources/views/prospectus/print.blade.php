<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body { font-family: "Times New Roman", serif; font-size:13px; margin:20px; color: #222; }
        .center { text-align:center; }
        h2, h3 { margin:0; padding:0; }
        .meta { margin-top:8px; margin-bottom:18px; font-size:14px; }
        table { width:100%; border-collapse: collapse; margin-top:8px; }
        th, td { border:1px solid #555; padding:6px; vertical-align:top; }
        th { background:#d9edf7; color: #31708f; font-weight:600; }
        tbody tr:nth-child(even) { background:#f9f9f9; }
        .term-title { background:#31708f; color:#fff; padding:8px; margin-top:16px; font-weight:700; }
        .signature td { border:none; padding-top:40px; }
        .logo { max-height:80px; margin-bottom:10px; }

        /* Print-specific styles */
        @media print {
            .no-print { display:none; }
            body { margin: 0; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; }
            @page { size: A4 portrait; margin: 20mm; }
        }

        .print-btn {
            margin: 20px auto;
            display: block;
            padding: 8px 20px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>

   

    <div class="center">
        <img src="{{ asset('assets/images/cmek.png') }}" alt="Logo" class="logo">

        <h2>{{ $meta['course_name'] ?? 'Course' }}</h2>
        <div class="meta">
            <strong>Effective Academic Year:</strong> {{ $meta['effective_year'] ?? '' }}<br>
        </div>
    </div>

    @foreach ($prospectus as $term)
        <div class="term-title">{{ strtoupper($term['schoolyear']) }} — {{ strtoupper($term['semester']) }}</div>

        <table>
            <thead>
                <tr>
                    <th style="width:12%;">Course Code</th>
                    <th>Descriptive Title</th>
                    <th style="width:7%;">Lec</th>
                    <th style="width:7%;">Lab</th>
                    <th style="width:7%;">Total</th>
                    <th style="width:16%;">Co-Requisite</th>
                    <th style="width:16%;">Pre-Requisite</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($term['subjects'] as $sub)
                    <tr>
                        <td>{{ $sub->course_code }}</td>
                        <td>{{ $sub->descriptive_title }}</td>
                        <td class="text-center">{{ $sub->led_units ?? $sub->lec_units ?? '' }}</td>
                        <td class="text-center">{{ $sub->lab_units ?? '' }}</td>
                        <td class="text-center">{{ $sub->total_units ?? '' }}</td>
                        <td>{{ $sub->co_requisite ?? $sub->co_reqs ?? 'None' }}</td>
                        <td>{{ $sub->pre_requisite ?? $sub->prereq ?? 'None' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">No subjects for this term.</td></tr>
                @endforelse
            </tbody>
        </table>
    @endforeach

    <div style="margin-top:50px;">
        <table class="signature" style="width:100%;">
            <tr>
                <td style="width:50%;">
                    Prepared by: <br><br>
                    _______________________________<br>
                    Chair, Department
                </td>
                <td>
                    Verified by: <br><br>
                    _______________________________<br>
                    Dean
                </td>
            </tr>
        </table>
    </div>

    <!-- AUTO PRINT -->
    <script>
        window.onload = function () {
            window.print();
        };
    </script>

</body>
</html>
