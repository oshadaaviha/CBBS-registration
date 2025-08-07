<!doctype html>
<html lang="en">
<head>
{{-- <style>
    .certificate-container {
        position: relative;
        width: 100%;
        text-align: center;
        page-break-before: always;
        /* Ensures each certificate is printed on a new page */
    }

    .food-certificate-image {
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
        color: #843e2d;
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
            top: -250px;
            right: -138px;
            color: black;
        }

        .student-id {
            font-size: 32px;
            position: absolute;
            top: -5px;
            right: -135px;
        }

        .course-duration {
            font-size: 32px;
            position: absolute;
            top: 50px;
            right: -135px;
        }

        .tvec-code {
            font-size: 33px;
            position: absolute;
            top: 465px;
            right: -130px;
        }

        .food-certificate-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 10ch;
            border-color: #be924b;
            /* This ensures the image fills the entire container */
        }

        .food-certificate-image {
            width: 100%;
            height: auto;
            border: 2px solid;
            border-color: #be924b;
        }

        .certificate-container {

            top: 0;
            left: 0;
            width: 99vw;
            height: 100vh;
        }


        @page {
            size: A4 landscape;
            margin: 15px 10px 0px 0px;
        }




    }
</style> --}}

</head>
<body data-sidebar="dark">


<button onclick="printFoodCertificate()" class="btn btn-success">Print Certificate</button>

<ul>


</ul>

<div class="food-page-content">

@foreach ($students as $student)
    @php
        $qrUrl = url('/student-details/' . $student->encoded_id);
    @endphp

    <div class="certificate-container">
        <div class="certificate">
            <!-- Certificate Background Image -->
            <img src="{{ $student->food_certificate }}" class="food-certificate-image">

            <div class="food-qrcode">
                {!! QrCode::size(100)->generate($qrUrl) !!}

            </div>

            <!-- Student Details Overlaid -->
            <div class="certificate-details">
                <p class="food-student-name"><strong>{{ $student->name }}</strong></p>
                {{-- <p class="student-id"><strong> Student No:
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

                <p class="course-duration">
                    <strong> Course duration: {{ $months }}
                        {{ $monthText }}</strong>
                    ({{ $startDate->format('F Y') }} - {{ $endDate->format('F Y') }})
                </p> --}}
                @if ($student->isFastTrack == 0)
                <p class="food-tvec-code"><strong>{{ $student->tvec_code }}</strong></p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>


</div>
<script>
    function printFoodCertificate() {
        var foodContents = document.querySelector('.food-page-content').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = foodContents;
        window.print();
        location.reload(); // Reload to restore original content
    }
</script>

</body>
</html>
