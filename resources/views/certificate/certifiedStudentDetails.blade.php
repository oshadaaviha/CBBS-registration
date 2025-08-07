@php
    $id = session('id');
    $role = session('role');
    // dd($data)
@endphp

@if (!empty($id))

    @if (\Illuminate\Support\Facades\Auth::id() == $id)
        <!doctype html>
        <html lang="en">

        <head>

            @include('Layout.appStyles')
            <title>Admin | CBBS | Certified Student Deatils </title>


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
                                        <h4 class="mb-sm-0 font-size-18">Certificate Download</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="#">Student Details</a>
                                                </li>
                                                <li class="breadcrumb-item active">Student Details</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->



                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Filter by Branch</label>
                                    <select id="branchFilter" class="form-control">
                                        <option value="">All Branches</option>
                                        @foreach ($branch as $item)
                                            <option value="{{ $item->branch_id }}">{{ $item->branch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Filter by Course</label>
                                    <select id="courseFilter" class="form-control">
                                        <option value="">All Courses</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->course_id }}">{{ $item->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Filter by Batch</label>
                                    <select id="batchFilter" class="form-control">
                                        <option value="">All Batches</option>
                                        @foreach ($batch as $item)
                                            <option value="{{ $item->batch_id }}">{{ $item->batch_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Filter by FastTrack</label>
                                    <select id="fasttrackFilter" class="form-control">
                                        <option value="">All Student</option>
                                        <option value="1">FastTrack</option>
                                        <option value="0">TVEC</option>
                                    </select>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="scrollme">
                                                <table id="datatable-buttons"
                                                    class="table table-bordered dt-responsive  nowrap w-100">

                                                    <thead>

                                                        <tr>
                                                            <th>
                                                                <input type="checkbox" id="selectAll">
                                                                <!-- Master Checkbox -->
                                                            </th>

                                                            <th>Student Id</th>
                                                            <th>Student Name</th>
                                                            <th>NIC</th>
                                                            <th>Email</th>
                                                            <th>Gender</th>
                                                            <th>Contact Number</th>
                                                            <th>Whatsapp Number</th>
                                                            <th>Address</th>
                                                            <th>Branch</th>
                                                            <th>Course</th>
                                                            <th>Batch</th>
                                                            <th>isFastTrack</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if (!empty($data))
                                                            @php
                                                                // Remove duplicates based on Student ID
                                                                $filteredData = collect($data)->unique('student_id');
                                                                // ->where('status', 'certified') // Filter only certified students
                                                                // ->unique('student_id');
                                                            @endphp
                                                            @foreach ($filteredData as $item)
                                                                <tr>
                                                                    <td>
                                                                        <input type="checkbox" class="studentCheckbox"
                                                                            value="{{ $item->student_id }}">
                                                                    </td>
                                                                    <td>{{ $item->student_id }}</td>
                                                                    <td>{{ $item->name }}</td>
                                                                    <td>{{ $item->nic }}</td>
                                                                    <td>{{ $item->email }}</td>
                                                                    <td>{{ $item->gender }}</td>
                                                                    <td>{{ $item->contact_number }}</td>
                                                                    <td>{{ $item->whatsapp_number }}</td>
                                                                    <td>{{ $item->address }}</td>
                                                                    <td>{{ $item->branch_name }}</td>
                                                                    <td>{{ $item->course_name }}</td>
                                                                    <td>{{ $item->batch_no }}</td>
                                                                    <td>{{ $item->isFastTrack }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- end col -->

                                <div class="row">
                                    <div class="col-md-12 d-flex text-left">
                                        <button id="markbackongoing"
                                            class="btn btn-warning waves-effect waves-dark">Back to Ongoing</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->






                    {{--        End Modals --}}

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
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                $(document).ready(function() {
                    // Initialize DataTable
                    let table = $("#datatable-buttons").DataTable({
                        destroy: true,
                        processing: true,
                        serverSide: false,
                        paging: true,
                        searching: true,
                        info: true
                    });

                    function fetchFilteredData() {
                        let branch_id = $("#branchFilter").val();
                        let course_id = $("#courseFilter").val();
                        let batch_id = $("#batchFilter").val();
                        let isFastTrack = $("#fasttrackFilter").val();

                        $.ajax({
                            url: "{{ route('certifiedFilterStudents') }}",
                            type: "POST",
                            data: {
                                branch_id: branch_id,
                                course_id: course_id,
                                batch_id: batch_id,
                                isFastTrack: isFastTrack,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                table.clear().draw(); // Clear table but keep structure

                                if (response.length > 0) {
                                    $.each(response, function(index, item) {
                                        table.row.add([
                                            `<input type="checkbox" class="studentCheckbox" value="${item.student_id}">`,
                                            item.student_id,
                                            item.name,
                                            item.nic,
                                            item.email,
                                            item.gender,
                                            item.contact_number,
                                            item.whatsapp_number,
                                            item.address,
                                            item.branch_name,
                                            item.course_name,
                                            item.batch_no,
                                            item.isFastTrack
                                        ]);
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'No Students Found!',
                                        text: 'No students match the selected filters.',
                                        confirmButtonColor: '#3085d6'
                                    });
                                }

                                table.draw(); // Recalculate pagination & display

                                attachCheckboxHandlers(); // Fix checkbox issue
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error:", error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong! Please check the console for details.',
                                    confirmButtonColor: '#d33'
                                });
                            }
                        });
                    }

                    // Select All functionality
                    $("#selectAll").on("change", function() {
                        $(".studentCheckbox").prop("checked", $(this).prop("checked"));
                    });

                    $(document).on("change", ".studentCheckbox", function() {
                        $("#selectAll").prop("checked", $(".studentCheckbox:checked").length === $(
                            ".studentCheckbox").length);
                    });

                    // Function to handle checkbox selection (called after table reload)
                    function attachCheckboxHandlers() {
                        $("#selectAll").off("change").on("change", function() {
                            $(".studentCheckbox").prop("checked", $(this).prop("checked"));
                        });

                        $(document).on("change", ".studentCheckbox", function() {
                            $("#selectAll").prop("checked", $(".studentCheckbox:checked").length === $(
                                ".studentCheckbox").length);
                        });
                    }

                    attachCheckboxHandlers(); // Attach checkbox events initially

                    // Move students back to "Ongoing" status
                    $("#markbackongoing").click(function() {
                        let selectedStudents = $(".studentCheckbox:checked").map(function() {
                            return $(this).val();
                        }).get();

                        if (selectedStudents.length === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'No Students Selected',
                                text: 'Please select at least one student to move back to Ongoing.',
                                confirmButtonColor: '#3085d6'
                            });
                            return;
                        }

                        // Send AJAX request
                        $.ajax({
                            url: "{{ route('students.updateStatusongoing') }}",
                            type: "POST",
                            data: {
                                student_ids: selectedStudents,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Selected students have been moved back to Ongoing.',
                                        confirmButtonColor: '#28a745'
                                    }).then(() => {
                                        window.location.href =
                                            "{{ url('/certifiedStudentDetails') }}";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Could not update students. Please try again.',
                                        confirmButtonColor: '#d33'
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error:", error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong! Please check the console for details.',
                                    confirmButtonColor: '#d33'
                                });
                            }
                        });
                    });

                    // Move students back to "Registered" status
                    $("#markbackregistered").click(function() {
                        let selectedStudents = $(".studentCheckbox:checked").map(function() {
                            return $(this).val();
                        }).get();

                        if (selectedStudents.length === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'No Students Selected',
                                text: 'Please select at least one student to move back to Registered.',
                                confirmButtonColor: '#3085d6'
                            });
                            return;
                        }

                        // Send AJAX request
                        $.ajax({
                            url: "{{ route('students.updateStatusbackregistered') }}",
                            type: "POST",
                            data: {
                                student_ids: selectedStudents,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Selected students have been moved back to Registered.',
                                        confirmButtonColor: '#28a745'
                                    }).then(() => {
                                        window.location.href =
                                            "{{ url('/certifiedStudentDetails') }}";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Could not update students. Please try again.',
                                        confirmButtonColor: '#d33'
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error:", error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong! Please check the console for details.',
                                    confirmButtonColor: '#d33'
                                });
                            }
                        });
                    });

                    // Trigger fetch when filters change
                    $("#branchFilter, #courseFilter, #batchFilter, #fasttrackFilter").change(fetchFilteredData);
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
