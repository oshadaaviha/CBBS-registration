
<button onclick="printBaristaCertificate()" class="btn btn-success">Print Certificate</button>

<ul>


</ul>

<div class="barista-page-content">
@foreach ($students as $student)
    @php
        $qrUrl = url('/student-details/' . $student->encoded_id);
    @endphp

        <div class="certificate-container">
        <div class="certificate">
            <!-- Certificate Background Image -->
            <img src="{{ $student->barista_certificate }}" class="certificate-image">

            <div class="qrcode">
                {!! QrCode::size(100)->generate($qrUrl) !!}

            </div>

            <!-- Student Details Overlaid -->
            <div class="certificate-details">
                <p class="student-name"><strong>{{ $student->name }}</strong></p>
                <p class="student-id"><strong> Student No:
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
                </p>
                @if ($student->isFastTrack == 0)
                <p class="barista-tvec-code"><strong>{{ $student->tvec_code }}</strong></p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>


</div>
<script>
    function printBaristaCertificate() {
        var baristaContents = document.querySelector('.barista-page-content').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = baristaContents;
        window.print();
        location.reload(); // Reload to restore original content
    }
</script>
