<!doctype html>
<html lang="en">
<head>
    @include('Layout.appStyles')

<style>
    .certificate-container {
        position: relative;
        width: 100%;
        text-align: center;
        page-break-before: always;
        /* Ensures each certificate is printed on a new page */
    }

    .certificate-image {
        width: 100%;
        height: auto;
    }

    .certificate-details {
        position: absolute;
        top: 0%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        text-align: center;
    }

    .student-name,
    .student-id,
    .course-duration,
    .tvec-code {
        font-family: 'Cambria';
        font-weight: bold;
        color: black;
        text-align: right;
    }

    .student-name {
        font-size: 28px;
        position: absolute;
        top: 205px;
        right: -97px;
        color: #3177b7;
    }

    .qrcode {
        position: absolute;
        top: 25px;
        left: 25px;
        background-color: white;
        padding: 5px;
    }

    .student-id {
        font-size: 22px;
        position: absolute;
        top: 375px;
        right: -97px;
    }

    .course-duration {
        font-size: 20px;
        position: absolute;
        top: 410px;
        right: -97px;
    }

    .tvec-code {
        font-size: 22px;
        position: absolute;
        top: 695px;
        right: -10%;
    }

    /* PRINT STYLES */
    @media print {
        body * {
            visibility: hidden;
        }

        .certificate-container,
        .certificate-container * {
            visibility: visible;
        }

        .certificate-container {
            position: relative;
            width: 100%;
            height: auto;
            page-break-before: always;
        }

        .certificate-details {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            text-align: center;
        }

        .student-name,
        .student-id,
        .course-duration,
        .tvec-code {
            font-family: 'Cambria', serif;
            font-weight: bold;
            color: black;
            text-align: center;
        }

        .student-name {
            font-size: 40px;
            position: absolute;
            top: -260px;
            right: -138px;
            color: #3177b7;
        }

        .student-id {
            font-size: 32px;
            position: absolute;
            top: -7px;
            right: -135px;
        }

        .course-duration {
            font-size: 32px;
            position: absolute;
            top: 48px;
            right: -135px;
        }

        .tvec-code {
            font-size: 35px;
            position: absolute;
            top: 459px;
            right: -125px;
        }

        .certificate-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 10ch;
            border-color: #2e75b6;
            /* This ensures the image fills the entire container */
        }

        .certificate-image {
            width: 100%;
            height: auto;
            border: 4px solid;
            border-color: #2e75b6;
        }

        .certificate-container {

            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
        }


        @page {
            size: A4 landscape;
            margin: 15px 10px 0px 10px;
        }
    }
</style>
</head>
<body data-sidebar="dark">
    <button onclick="printBartenderCertificate()" class="btn btn-success">Print Certificate</button>

<ul>


</ul>

<div class="bartender-page-content">
@foreach ($students as $student)
    @php
        $qrUrl = url('/student-details/' . $student->encoded_id);
    @endphp

        <div class="certificate-container">
        <div class="certificate">
            <!-- Certificate Background Image -->
            <img src="{{ $student->bartender_certificate }}" class="bartender-certificate-image">

            <div class="bartender-qrcode">
                {!! QrCode::size(100)->generate($qrUrl) !!}
            </div>

            <!-- Student Details Overlaid -->
            <div class="certificate-details">
                <p class="bartender-student-name"><strong>{{ $student->name }}</strong></p>
                <p class="bartender-student-id"><strong> Student No:
                        {{ $student->student_id }}</strong></p>

                @php
                    $startDate = \Carbon\Carbon::parse($student->year_month);
                    $endDate = \Carbon\Carbon::parse($student->graduation_date);

                    $months = $startDate->diffInMonths($endDate);
                    $days = $startDate->diffInDays($endDate) % 30;

                    if ($days > 0) {
                        $months += 1;
                    }
                    $monthText = $months == 1 ? 'Month' : 'Months';
                @endphp

                <p class="bartender-course-duration">
                    <strong> Course duration: {{ $months }}
                        {{ $monthText }}</strong>
                    ({{ $startDate->format('F Y') }} - {{ $endDate->format('F Y') }})
                </p>
                @if ($student->isFastTrack == 0)
                <p class="bartender-tvec-code"><strong>{{ $student->tvec_code }}</strong></p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>


</div>
<script>
    function printBartenderCertificate() {
        var bartenderContents = document.querySelector('.bartender-page-content').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = bartenderContents;
        window.print();
        location.reload(); // Reload to restore original content
    }
</script>
</body>
</html>
