@php
    $id = session('id');
    $role = session('role');
    // dd($students)
@endphp

@if (!empty($id))

    @if (\Illuminate\Support\Facades\Auth::id() == $id)
        <!doctype html>
        <html lang="en">

        <head>

            @include('Layout.appStyles')
            <title>Admin | CBBS | Student Deatils Certificates </title>

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
                .bartender-student-name,
                .food-student-name,
                .student-id,
                .course-duration,
                .bartender-student-id,
                .bartender-course-duration,
                .bartender-tvec-code,
                .food-tvec-code,
                .barista-tvec-code,
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

                .bartender-student-name {
                    font-size: 28px;
                    position: absolute;
                    top: 190px;
                    right: -70px;
                    color: #2e75b6;
                }

                .food-student-name {
                    font-size: 28px;
                    position: absolute;
                    top: 232px;
                    right: -75px;
                    color: #000000;
                }


                .qrcode {
                    position: absolute;
                    top: 25px;
                    left: 25px;
                    background-color: white;
                    padding: 5px;
                }

                .bartender-qrcode {
                    position: absolute;
                    top: 25px;
                    left: 45px;
                    background-color: white;
                    padding: 5px;
                }

                .food-qrcode {
                    position: absolute;
                    top: 25px;
                    left: 45px;
                    background-color: white;
                    padding: 5px;
                }

                .student-id {
                    font-size: 22px;
                    position: absolute;
                    top: 375px;
                    right: -97px;
                }

                .bartender-student-id {
                    font-size: 22px;
                    position: absolute;
                    top: 350px;
                    right: -80px;
                }

                .course-duration {
                    font-size: 20px;
                    position: absolute;
                    top: 410px;
                    right: -97px;
                }

                .bartender-course-duration {
                    font-size: 22px;
                    position: absolute;
                    top: 390px;
                    right: -80px;
                }

                .tvec-code {
                    font-size: 22px;
                    position: absolute;
                    top: 695px;
                    right: -80px;
                }

                .barista-tvec-code {
                    font-size: 23px;
                    position: absolute;
                    top: 708px;
                    right: -90px;
                }

                .bartender-tvec-code {
                    font-size: 23px;
                    position: absolute;
                    top: 672px;
                    right: -65px;
                }

                .food-tvec-code {
                    font-size: 21px;
                    position: absolute;
                    top: 677px;
                    right: -63px;
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
                    .bartender-student-name,
                    .food-student-name,
                    .student-id,
                    .bartender-student-id,
                    .course-duration,
                    .bartender-course-duration,
                    .barista-tvec-code,
                    .bartender-tvec-code,
                    .food-tvec-code,
                    .tvec-code {
                        font-family: 'Cambria', serif;
                        font-weight: bold;
                        color: black;
                        text-align: center;
                    }

                    .student-name {
                        font-size: 40px;
                        position: absolute;
                        top: -255px;
                        right: -138px;
                        color: #843e2d;
                    }

                    .food-student-name {
                        font-size: 40px;
                        position: absolute;
                        top: -210px;
                        right: -138px;
                        color: #000000;
                    }

                    .bartender-student-name {
                        font-size: 40px;
                        position: absolute;
                        top: -275px;
                        right: -138px;
                        color: #2e75b6;
                    }

                    .student-id {
                        font-size: 32px;
                        position: absolute;
                        top: -5px;
                        right: -135px;
                    }

                    .bartender-student-id {
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

                    .bartender-course-duration {
                        font-size: 32px;
                        position: absolute;
                        top: 50px;
                        right: -135px;
                    }

                    .tvec-code {
                        font-size: 35px;
                        position: absolute;
                        top: 455px;
                        right: -130px;
                    }

                    .food-tvec-code {
                        font-size: 32px;
                        position: absolute;
                        top: 465px;
                        right: -125px;
                    }

                    .bartender-tvec-code {
                        font-size: 35px;
                        position: absolute;
                        top: 455px;
                        right: -130px;
                    }

                    .barista-tvec-code {
                        font-size: 32px;
                        position: absolute;
                        top: 462px;
                        right: -125px;
                    }

                    .certificate-image {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        border: 10ch;
                        border-color: #843e2d;
                    }

                    .food-certificate-image {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        border: 10ch;
                        border-color: #be924b;
                    }

                    .bartender-certificate-image {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        border: 10ch;
                        border-color: #3177b7;
                    }

                    .certificate-image {
                        width: 100%;
                        height: auto;
                        border: 4px solid;
                        border-color: brown;
                    }

                    .bartender-certificate-image {
                        width: 100%;
                        height: auto;
                        border: 4px solid;
                        border-color: #3177b7;
                    }

                    .food-certificate-image {
                        width: 100%;
                        height: auto;
                        border: 4px solid;
                        border-color: #be924b;
                    }

                    .certificate-container {

                        top: 0;
                        left: 0;
                        width: 100vw;
                        height: 100vh;
                    }


                    @page {
                        size: A4 landscape;
                        margin: 12px 7px -10px 7px;
                    }
                }
            </style>

        </head>

        <body data-sidebar="dark">

            <!-- Begin page -->
            <div id="layout-wrapper">


                {{--    Header --}}
                @include('Layout.header')

                {{--    End Header --}}

                <!-- Left Sidebar Start  -->
                @include('Layout.sidebar')
                <!-- Left Sidebar End -->


                @section('content')
                    <div class="container">
                        {{-- <h2>Certificate Preview</h2> --}}
                        <div class="page-content">




                            <ul class="nav nav-tabs" id="certificateTabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="course-tab" onclick="showTab('course')">Course
                                        Certificate</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="food-tab" onclick="showTab('food')">Food Certificate</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <!-- Course Tab (Initially Visible) -->
                                <div class="tab-pane fade show active" id="course">
                                    @if ($courseName === 'Basic Certificate for Barista')
                                        @include('certificate.components.baristaCertificate')
                                    @elseif($courseName === 'Basic Certificate for Bartender')
                                        @include('certificate.components.bartenderCertificate')
                                    @endif
                                </div>

                                <!-- Food Tab (Initially Hidden) -->
                                <div class="tab-pane fade" id="food" style="display: none;">
                                    @include('certificate.components.foodCertificate')
                                </div>
                            </div>


                            {{--        Footer --}}
                            @include('Layout.footer')
                            {{--        End Footer --}}
                        </div>
                    </div>
                </div>
                <!-- end main content-->

                </div>
                <!-- END layout-wrapper -->

                <!-- Right Sidebar -->
                @include('Layout.rightSideBar')
                <!-- /Right-bar -->

                <!-- Right bar overlay-->
                <div class="rightbar-overlay"></div>

                @include('Layout.appJs')
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        function showTab(tabId) {
                            // Remove 'active' and 'show' classes from all tabs
                            document.querySelectorAll(".tab-pane").forEach(tab => {
                                tab.classList.remove("show", "active");
                                tab.style.display = "none";
                            });

                            document.querySelectorAll(".nav-link").forEach(link => {
                                link.classList.remove("active");
                            });

                            // Add 'active' and 'show' classes to the selected tab
                            const selectedTab = document.getElementById(tabId);
                            if (selectedTab) {
                                selectedTab.classList.add("show", "active");
                                selectedTab.style.display = "block";
                            }

                            // Mark the corresponding nav link as active
                            const activeLink = document.querySelector(`#${tabId}-tab`);
                            if (activeLink) {
                                activeLink.classList.add("active");
                            }
                        }

                        // Add event listeners to each tab link
                        document.querySelectorAll(".nav-link").forEach(link => {
                            link.addEventListener("click", function(event) {
                                event.preventDefault();
                                const tabId = this.getAttribute("onclick").match(/'([^']+)'/)[1];
                                showTab(tabId);
                            });
                        });

                        // Initialize by showing the default active tab
                        showTab("course");
                    });
                </script>


            </body>

            </html>
        @else
            @include('Layout.notValidateUser')
        @endif
    @else
        @include('Layout.noUser')
    @endif
