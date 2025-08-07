<!doctype html>
<html lang="en">

<head>
    @include('Layout.appStyles')
    <title>Admin | CBBS | Dashboard</title>

    <style>
        .dashboard-count-card {
            background-color: #e3f2fd; /* Light blue color */
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            color: #0277bd; /* Darker blue for text */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .dashboard-count-card h5 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .dashboard-count-card p {
            font-size: 36px;
            font-weight: bold;
        }
        
        /* Dark mode styles */
        .dark-mode .dashboard-count-card {
            background-color: #0277bd; /* Dark background color */
            color: #f1f1f1; /* Light color for text */
        }
        
        .dark-mode .dashboard-count-card h5 {
            color: #ffffff; /* Black color for h5 in dark mode */
        }
    </style>
</head>

<body data-sidebar="dark" class="dark-mode"> <!-- Added class for dark mode -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        {{-- Header --}}
        @include('Layout.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('Layout.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Dashboard Counts -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-count-card">
                                <h5>Students</h5>
                                <p>{{ $studentCount }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dashboard-count-card">
                                <h5>Batches</h5>
                                <p>{{ $batchCount }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dashboard-count-card">
                                <h5>Branches</h5>
                                <p>{{ $branchCount }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dashboard-count-card">
                                <h5>Courses</h5>
                                <p>{{ $courseCount }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('Layout.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('Layout.rightSideBar')

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    @include('Layout.appJs')
</body>

</html>
