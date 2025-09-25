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
            <title>Admin | CBBS | Student Management</title>


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
                                        <h4 class="mb-sm-0 font-size-18">Student</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Student</a>
                                                </li>
                                                <li class="breadcrumb-item active">Student Management</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            {{-- <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target="#customerAddModal">Add Student</button>


                                </div>

                            </div> --}}

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

                            {{-- Filters --}}
                            <form method="GET" action="{{ url()->current() }}" class="row g-2 mb-3 align-items-end">
                                <div class="col-md-2">
                                    <label class="form-label">Course</label>
                                    <select name="course_id" class="form-select">
                                        <option value="">All</option>
                                        @foreach ($course as $c)
                                            <option value="{{ $c->course_id }}"
                                                {{ ($filters['course_id'] ?? '') == $c->course_id ? 'selected' : '' }}>
                                                {{ $c->course_name ?? $c->course_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Branch</label>
                                    <select name="branch_id" class="form-select">
                                        <option value="">All</option>
                                        @foreach ($branch as $b)
                                            <option value="{{ $b->branch_id }}"
                                                {{ ($filters['branch_id'] ?? '') == $b->branch_id ? 'selected' : '' }}>
                                                {{ $b->branch_name ?? $b->branch_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">z
                                    <label class="form-label">Batch</label>
                                    <select name="batch_id" class="form-select">
                                        <option value="">All</option>
                                        @foreach ($batch as $b)
                                            <option value="{{ $b->batch_id }}"
                                                {{ ($filters['batch_id'] ?? '') == $b->batch_id ? 'selected' : '' }}>
                                                {{ $b->batch_name ?? $b->batch_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Track</label>
                                    <select name="track" class="form-select">
                                        <option value="">All</option>
                                        <option value="Normal"
                                            {{ ($filters['track'] ?? '') === 'Normal' ? 'selected' : '' }}>Normal
                                        </option>
                                        <option value="Fast"
                                            {{ ($filters['track'] ?? '') === 'Fast' ? 'selected' : '' }}>Fast
                                        </option>
                                    </select>
                                </div>

                                {{-- <div class="col-md-3">
                                    <label class="form-label">Student (ID/Name/NIC/Phone/Email)</label>
                                    <input type="text" name="student" class="form-control"
                                        value="{{ $filters['student'] ?? '' }}" placeholder="Search…">
                                </div> --}}

                                <div class="col-md-2">
                                    <label class="form-label">Shared By</label>
                                    <select name="shared_by" class="form-select"
                                        {{ auth()->user()->role === 'Sales' ? 'disabled' : '' }}>
                                        <option value="">All</option>
                                        @foreach ($sharedByOptions as $u)
                                            <option value="{{ $u->id }}"
                                                {{ ($filters['shared_by'] ?? '') == $u->id ? 'selected' : '' }}>
                                                {{ $u->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if (auth()->user()->role === 'Sales')
                                        {{-- Sales are locked to themselves; keep a hidden value so it stays applied --}}
                                        <input type="hidden" name="shared_by" value="{{ auth()->id() }}">
                                    @endif
                                </div>

                                <div class="col-md-1 d-grid">
                                    <button class="btn btn-primary">Apply</button>
                                </div>

                                <div class="col-md-1 d-grid">
                                    <a href="{{ url()->current() }}" class="btn btn-link p-0">Clear filters</a>
                                </div>
                            </form>


                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="scrollme">
                                                <table id="datatable-buttons"
                                                    class="table table-bordered dt-responsive  nowrap w-100">

                                                    <thead>
                                                        <tr>
                                                            <th>Student ID</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>NIC</th>
                                                            <th>Email</th>
                                                            <th>Gender</th>
                                                            <th>Mobile</th>
                                                            <th>Whatsapp</th>
                                                            <th>Contact Address</th>
                                                            <th>Batch ID</th>
                                                            <th>Course</th>
                                                            <th>Branch</th>
                                                            <th>Track</th>
                                                            <th>Shared By</th>
                                                            {{-- <th>Is Fast Track</th> --}}
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($data as $row)
                                                        {{-- !empty($row->public_student_id) && --}}
                                                            @if ( !empty($row->batch_no))
                                                                <tr>
                                                                    {{-- you selected s.student_id as public_student_id --}}
                                                                    <td>{{ $row->public_student_id }}</td>

                                                                    <td>{{ $row->first_name }}</td>
                                                                    <td>{{ $row->last_name }}</td>
                                                                    <td>{{ $row->nic_number }}</td>
                                                                    <td>{{ $row->email }}</td>
                                                                    <td>{{ $row->gender }}</td>
                                                                    <td>{{ $row->mobile }}</td>
                                                                    <td>{{ $row->whatsapp }}</td>
                                                                    <td>{{ $row->contact_address }}</td>

                                                                    {{-- you selected ba.batch_no --}}
                                                                    <td>{{ $row->batch_no ?? '-' }}</td>
                                                                    <td>{{ $row->course_label }}</td>
                                                                    {{-- from COALESCE(c.course_name, enrollments.course_id) as course_label --}}
                                                                    <td>{{ $row->branch_name ?? '-' }}</td>
                                                                    <td>{{ $row->track ?? ($row->is_fast_track ? 'Fast' : 'Normal') }}
                                                                    </td>
                                                                    <td>{{ $row->shared_by_name ?? '-' }}</td>


                                                                    <td>
                                                                        <button
                                                                            class="btn btn-outline-info btn-sm waves-effect waves-light"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#studentEditModal"
                                                                            {{-- pass values into the modal --}}
                                                                            data-studentid="{{ $row->public_student_id }}"
                                                                            data-firstname="{{ $row->first_name }}"
                                                                            data-lastname="{{ $row->last_name }}"
                                                                            data-nic="{{ $row->nic_number }}"
                                                                            data-email="{{ $row->email }}"
                                                                            data-gender="{{ $row->gender }}"
                                                                            data-contactnumber="{{ $row->mobile }}"
                                                                            data-whatsappnumber="{{ $row->whatsapp }}"
                                                                            data-address="{{ $row->contact_address }}"
                                                                            data-batchid="{{ $row->batch_id }}">
                                                                            Edit
                                                                        </button>

                                                                        {{-- use the primary key alias you selected: student_pk --}}
                                                                        <a href="{{ url('/deleteStudent/' . $row->student_pk) }}"
                                                                            class="btn btn-outline-danger btn-sm waves-effect waves-light"
                                                                            onclick="return confirm('Are you sure you want to delete this student?')">
                                                                            Delete
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @empty
                                                            <tr>
                                                                <td colspan="10" class="text-center">No records
                                                                    found.
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
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




        </body>

        </html>
    @else
        @include('Layout.notValidateUser')
    @endif
@else
    @include('Layout.noUser')
@endif
