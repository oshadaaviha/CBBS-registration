<!doctype html>
<html lang="en">

<head>
    @include('Layout.appStyles')
    <title>Search Student Details | CBBS</title>
    <style>
        /* Your existing styles */
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            /* Center all text */
            margin: 0 auto;
            /* Center the header */
            padding: 20px;
            /* Padding for space */
        }

        .logo {
            max-height: 100px;
            /* Set max height for logo */
            margin-bottom: 10px;
            /* Space below the logo */
        }

        .contact-info {
            display: table;
            /* Use table display for layout */
            margin: 0 auto;
            /* Center the contact info */
        }

        .contact-row {
            display: table-row;
            /* Each row acts like a table row */
            text-align: left;
            /* Align text to the left */
            margin: 5px 0;
            /* Space between rows */
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
            display: flex;
            gap: 10px;
        }

        .separator {
            margin: 0 10px 0 10px;
            /* Space around separator */
            display: table-cell;
            /* Display as table cell for alignment */
        }

        .separator-line {
            border: none;
            /* Remove default border */
            height: 1px;
            /* Height of the line */
            background-color: #000;
            /* Line color */
            margin: 10px auto;
            /* Center the line */
            width: 60%;
            /* Width of the line, adjust as needed */
        }

        /* Mobile responsiveness */
        @media (max-width: 540px) {
            .header h1 {
                font-size: 20px;
                /* Adjust font size for the title */
            }

            .contact-info {
                display: block;
                /* Change from table to block for mobile */
                text-align: center;
                /* Center align text */
            }

            .contact-row {
                margin: 5px 0;
                /* Adjust spacing for mobile */
                font-size: 14px;
                /* Smaller font size for mobile */
                flex-direction: row;
                justify-content: center;
                flex-wrap: wrap;
                display: flex;
            }

            .separator {
                display: none;
                /* Hide separator in mobile view */
            }
        }


        /* Print styles */
        @media print {
            .header {
                text-align: center;
                /* Center text in print */
            }

            .separator {
                display: inline;
                /* Ensure separators are visible in print */
            }
        }


        .student-details-container {
            display: flex;
            justify-content: center;
            margin: 0 auto;
            max-width: 700px;
        }

        .student-details {
            background-color: #292e55;
            color: white;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #ddd;
            width: 100%;
            position: relative;
        }

        .student-details h4 {
            color: #fff;
            margin-bottom: 10px;
        }

        .student-details p {
            margin: 5px 0;
            color: #fff;
            display: flex;
            justify-content: flex-start;
            margin-bottom: 25px;
        }

        .student-details .details-grid {
            display: grid;
            grid-template-columns: 1fr 0.5fr 2fr;
            gap: 10px;
            margin-bottom: 20px;
            margin-left: 70px;
            /* Ensure margin for desktop view */
        }

        .student-details .details-grid div {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            font-size: 15px;
        }

        .student-details .details-grid strong {
            color: #fff;
            width: 100%;
            margin-bottom: 5px;
        }

        .student-details .details-grid .detail-value {
            color: #fff;
        }

        .student-details .details-grid .detail-separator {
            display: block;
            /* Show in desktop view */
        }

        .student-details strong {
            color: #fff;
        }

        .btn-print {
            background-color: #f15a29;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .btn-print:hover {
            background-color: #ffffff;
            color: #f15a29;
            border: #f15a29 1px solid;
        }

        .alert {
            border-radius: 5px;
        }

        @media print {
            .no-print {
                display: none;
            }

            @page {
                size: portrait;
                margin: 20mm;
            }

            /* Ensure exact colors for print */
            body {
                color: #333;
                background-color: #fff;
            }

            .header img {
                height: 80px;
            }

            .header h1,
            .header p {
                color: #333;
            }

            .student-details {
                background-color: #292e55;
                color: white;
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 8px;
            }

            .student-details h4,
            .student-details p,
            .student-details .details-grid div {
                color: #fff;
            }

            .btn-print {
                background-color: #f15a29;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }

            .btn-print:hover {
                background-color: #ffffff;
                color: #f15a29;
                border: #f15a29 1px solid;
            }

            /* Additional styles for print */
            tr.vendorListHeading {
                background-color: #292e55 !important;
                color: white !important;
                print-color-adjust: exact;
                /* Ensure exact color */
            }

            .vendorListHeading th {
                color: white !important;
            }
        }

        .certified-bar-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .certified-bar {
            background-color: #27c360;
            width: 700px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .certified-badge img {
            width: 100px;
            /* Adjust size as needed */
            height: auto;
            border-radius: 5px;
        }

        .certified-message {
            font-size: 16px;
            color: #ffffff;
        }

        /* Mobile responsiveness */
        @media (max-width: 540px) {
            .student-details .details-grid {
                grid-template-columns: 1fr 1fr;
                gap: 0;
                margin-left: 0;
                /* Reset margin for mobile view */

            }

            .student-details .details-grid div {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
                font-size: 14px;
                /* Adjust font size for smaller screens */
            }

            .student-details .details-grid .detail-separator {
                display: none;
                /* Hide in mobile view */
            }

            .student-details .details-grid strong {
                width: 100%;
                margin-bottom: 5px;
            }
        }

        @media (max-width: 440px) {
            .student-details .details-grid {
                grid-template-columns: 1fr;
                gap: 0;
                margin-left: 0;
                /* Reset margin for mobile view */

            }

            .student-details .details-grid div {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
                font-size: 14px;
            }

            .student-details .details-grid .detail-separator {
                display: none;
            }

            .student-details .details-grid>div .detail-value {
                margin-left: 10px;
            }

        }
    </style>
</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="page-content">

            <div class="container-fluid">



                <div class="header">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="School Logo" class="logo">
                    <h1>Colombo Bartender & Barista School</h1>
                    <p> <div class="contact-info">
                       <div class="contact-row">
                            <strong>Alfred Place Branch : 0117999480  </strong><strong class="separator"> | </strong>
                            <strong>Walukarama Branch : 0114558561 </strong><strong class="separator"> | </strong>
                            <strong>Kandy Branch : 0817414444 </strong>

                    </div></p>
                    <hr class="separator-line"> <!-- Unified separator line -->
                </div>


                <div class="row no-print">
                    <div class="col-md-6 mx-auto">
                        <form id="searchForm" action="{{ url('search') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="searchInput" name="search"
                                    placeholder="Search by NIC or Student ID" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Check if search term is provided -->
                @if (request('search'))
                    @if (!empty($data) && count($data) > 0)
                        <div class="certified-bar-container">
                            <div class="certified-bar">
                                <div class="certified-badge">
                                    <img src="{{ asset('assets/images/cert.png') }}" alt="Certified Badge">
                                </div>
                                <div class="certified-message">This student is officially certified.</div>
                            </div>
                        </div>
                        <button onclick="window.print()" class="btn-print no-print"><i class="fas fa-print"></i>
                            Print</button>

                        <!-- Search Results -->
                        <div class="student-details-container">
                            <div class="student-details">
                                @foreach ($data as $student)
                                    <div class="student-details border-bottom">
                                        <h4 class="text-center mb-2">{{ $student->course_name }}</h4>
                                        <h4 class="text-center mb-5">{{ $student->branch_name . '-' . 'Branch' }} </h4>
                                        <div class="details-grid text-start">
                                            <div><strong>Name</strong></div>
                                            <div class="detail-separator">:</div>
                                            <div class="detail-value">{{ $student->name }}</div>

                                            <div><strong>Student ID</strong></div>
                                            <div class="detail-separator">:</div>
                                            <div class="detail-value">{{ $student->student_id }}</div>

                                            <div><strong>Batch No</strong></div>
                                            <div class="detail-separator">:</div>
                                            <div class="detail-value">{{ $student->batch_no }}</div>

                                            <div><strong>Graduation Date</strong></div>
                                            <div class="detail-separator">:</div>
                                            <div class="detail-value">{{ $student->graduation_date }}</div>

                                            {{-- <div><strong>NIC</strong></div>
                                            <div class="detail-separator">:</div>
                                            <div class="detail-value">{{ $student->nic }}</div>

                                            <div><strong>Email</strong></div>
                                            <div class="detail-separator">:</div>
                                            <div class="detail-value">{{ $student->email }}</div> --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="student-details">
                            <p class="text-center">No results found</p>
                        </div>
                    @endif
                @endif

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay no-print"></div>

    @include('Layout.appJs')

</body>

</html>
