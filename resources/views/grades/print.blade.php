<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Grade Slip - Print</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    /* Page and print settings */
    @page { size: A4 landscape; margin: 15mm 10mm; }
    @media print {
        body { margin: 0; }
        .no-print { display: none !important; }
    }

    body {
        font-family: "Times New Roman", Times, serif;
        background: #fff;
        color: #000;
    }

    .container-slip {
        width: 100%;
        max-width: 1100px;
        margin: 10px auto;
        border: 1px solid #000;
        padding: 18px 22px;
        box-sizing: border-box;
    }

    /* Header */
    .slip-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .logo {
        width: 90px;
        height: 90px;
    }

    .header-center {
        flex: 1;
        text-align: center;
    }
    .header-center h2 {
        font-size: 20px;
        margin: 0;
        letter-spacing: 1px;
    }
    .header-center .subtitle {
        font-size: 14px;
        margin-top: 6px;
    }

    .info-box {
        width: 320px;
        border: 1px solid #000;
        font-size: 13px;
    }
    .info-box table { width: 100%; border-collapse: collapse; }
    .info-box td { padding: 4px 8px; border-right: 1px solid #000; }
    .info-box td:last-child { border-right: none; }

    /* Student info row */
    .student-row {
        margin-top: 12px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        align-items: center;
    }
    .student-left, .student-right {
        border: 1px solid #000;
        padding: 8px;
        font-size: 13px;
    }
    .student-right { text-align: center; }

    /* Grade table */
    .courses-table {
        margin-top: 16px;
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .courses-table th, .courses-table td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: top;
    }
    .courses-table th {
        background: #fff;
        font-weight: 700;
        text-align: center;
    }

    .footer-row {
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: center;
    }
    .footer-left, .footer-right {
        border: 1px solid #000;
        padding: 8px;
        width: 48%;
        font-size: 13px;
    }
</style>
</head>
<body>

<div class="container-slip">

    <!-- Header -->
    <div class="slip-header">
        <!-- Logo -->
        <div style="flex: 0 0 120px;">
            <img src="{{ asset('assets/images/cmek.png') }}" alt="School Logo" class="logo" style="object-fit: contain;">

        </div>

        <!-- School name and term -->
        <div class="header-center">
            <h2>CEBU MARY IMMACULATE COLLEGE INC.</h2>
            <div class="subtitle">
                <strong>{{ $enrollment->schoolyear->schoolyear ?? '—' }} - {{ $enrollment->schoolyear->semester ?? '' }}</strong>
                <div style="margin-top:6px; font-weight:700; font-size:14px;">
                    {{ $enrollment->registration->student_name }}
                </div>
            </div>
        </div>

        <!-- ID Box -->
        <div class="info-box">
            <table>
                <tr>
                    <td style="border-bottom:1px solid #000; font-weight:700; background:#fff; text-align:left; padding:6px;">I.D NO.</td>
                </tr>
                <tr>
                    <td style="padding:10px; font-size:14px; text-align:center;"><strong>{{ $enrollment->registration->student_id ?? '—' }}</strong></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Department / Year row -->
    <div style="margin-top:6px; border:1px solid #000; display:flex;">
        <div style="flex:1; border-right:1px solid #000; padding:6px; font-size:13px;">
            <strong>Department</strong><br>
            {{ $enrollment->registration->department ?? '—' }}
        </div>
        <div style="flex:2; border-right:1px solid #000; padding:6px; font-size:13px; text-align:center;">
            <strong>{{ $enrollment->registration->student_name }}</strong>
        </div>
        <div style="flex:0.7; padding:6px; font-size:13px; text-align:center;">
            <strong>{{ $enrollment->registration->yearlevel ?? '—' }}</strong>
        </div>
    </div>

    <!-- Grade Table -->
    <table class="courses-table">
        <thead>
            <tr>
                <th>Prelim</th>
                <th>Midterm</th>
                <th>Semifinal</th>
                <th>Final</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $enrollment->grade->prelim ?? '-' }}</td>
                <td>{{ $enrollment->grade->midterm ?? '-' }}</td>
                <td>{{ $enrollment->grade->semifinal ?? '-' }}</td>
                <td>{{ $enrollment->grade->final ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer-row">
        <div class="footer-left">
            <strong>Subject:</strong><br>
            {{ $enrollment->subject->course_code }} - {{ $enrollment->subject->descriptive_title }}
        </div>
        <div class="footer-right text-end">
            <strong>Prepared by:</strong><br>
            <span style="font-weight:700;">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</span>
        </div>
    </div>

    <!-- Print Button -->
    <div class="text-center mt-3 no-print">
        <button class="btn btn-primary" onclick="window.print()">🖨 Print Grade Slip</button>
    </div>

</div>

</body>
</html>
