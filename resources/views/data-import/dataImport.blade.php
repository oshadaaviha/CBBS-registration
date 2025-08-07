@php
    $id = session('id');
    $role = session('role');
@endphp

@if (!empty($id))

    @if (\Illuminate\Support\Facades\Auth::id() == $id)
        <!doctype html>
        <html lang="en">

        <head>

            @include('Layout.appStyles')
            <title>Admin | CBBS | Data Import</title>

            <style>
                .custom-select {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    background-color: #fff;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.custom-select:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-control-file {
    width: 100%;
    padding: 5px;
    font-size: 14px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    background-color: #f8f9fa;
    margin-top: 10px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
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
                                        <h4 class="mb-sm-0 font-size-18">Data Import</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Data Import</a>
                                                </li>
                                                <li class="breadcrumb-item active">Data Import Management</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                             

                            <br>
                            @if (session()->has('message'))
                                <div class="col-md-4">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session()->get('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="col-md-4">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session()->get('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            @foreach ($errors->all() as $error)
                                <div class="col-md-4">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endforeach

                            <br>

                           
                            <div class="container mt-4">
                                <form action="{{ url('importData')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="course_id" class="form-label">Course Name</label>
                                        <select id="course_id" name="course_id" class="form-control custom-select" required>
                                            <option value="" disabled selected>-- Select Course --</option>
                                            @if (!empty($course))
                                                @foreach ($course as $item)
                                                    <option value="{{ $item->course_id }}">{{ $item->course_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="branch_id" class="form-label">Branch</label>
                                        <select id="branch_id" name="branch_id" class="form-control custom-select" required>
                                            <option value="" disabled selected>-- Select Branch --</option>
                                            @if (!empty($branch))
                                                @foreach ($branch as $item)
                                                    <option value="{{ $item->branch_id }}">{{ $item->branch_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="batch_id" class="form-label">Batch</label>
                                        <select id="batch_id" name="batch_id" class="form-control custom-select" required>
                                            <option value="" disabled selected>-- Select Batch --</option>
                                            @if (!empty($batch))
                                                @foreach ($batch as $item)
                                                    <option value="{{ $item->batch_id }}">{{ $item->batch_no }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="csv_file" class="form-label">Upload CSV File</label>
                                        <input type="file" id="csv_file" name="csv_file" class="form-control-file" accept=".csv" required>
                                    </div>
                                    
                            
                                    <button type="submit" class="btn btn-primary">Import Data</button>
                                </form>
                            </div>
                            
                            

                    {{--        Footer --}}
                    @include('Layout.footer')
                    {{--        End Footer --}}
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

          



        </body>

        </html>
    @else
        @include('Layout.notValidateUser')
    @endif
@else
    @include('Layout.noUser')
@endif
