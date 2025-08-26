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

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="scrollme">
                                                <table id="datatable-buttons"
                                                    class="table table-bordered dt-responsive  nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>NIC</th>
                                                            <th>Email</th>
                                                            <th>Gender</th>
                                                            <th>Mobile</th>
                                                            <th>Whatsapp</th>
                                                            <th>Contact Address</th>
                                                            <th>Course</th>
                                                            <th>Branch</th>
                                                            <th>Track</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($pending as $row)
                                                            <tr>
                                                                <td>{{ $row->first_name }}</td>
                                                                <td>{{ $row->last_name }}</td>
                                                                <td>{{ $row->nic_number }}</td>
                                                                <td>{{ $row->email }}</td>
                                                                <td>{{ $row->gender }}</td>
                                                                <td>{{ $row->mobile }}</td>
                                                                <td>{{ $row->whatsapp }}</td>
                                                                <td>{{ $row->contact_address }}</td>
                                                                <td>{{ $row->course_label }}</td>
                                                                <td>{{ $row->branch_name ?? '-' }}</td>
                                                                <td>{{ $row->track ?? ($row->is_fast_track ? 'Fast' : 'Normal') }}
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#assignIdBatchModal"
                                                                        data-enrollment_id="{{ $row->enrollment_id }}"
                                                                        data-student_pk="{{ $row->student_pk }}"
                                                                        data-public_student_id="{{ $row->public_student_id }}"
                                                                        data-first_name="{{ $row->first_name }}"
                                                                        data-last_name="{{ $row->last_name }}"
                                                                        data-course_label="{{ $row->course_label }}"
                                                                        data-branch_name="{{ $row->branch_name ?? '' }}"
                                                                        data-batch_id="{{ $row->batch_id ?? '' }}">
                                                                        Assign ID & Batch
                                                                    </button>





                                                                    {{-- use the primary key alias you selected: student_pk --}}
                                                                    <a href="{{ url('/deleteStudent/' . $row->student_pk) }}"
                                                                        class="btn btn-outline-danger btn-sm waves-effect waves-light"
                                                                        onclick="return confirm('Are you sure you want to delete this student?')">
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="11" class="text-center">No pending
                                                                    students found.</td>
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

            {{-- <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @if (!empty($editStudent))
                        // Fill student-level fields
                        const setVal = (name, val) => {
                            const el = document.querySelector(`[name="${name}"]`) || document.getElementById(name);
                            if (!el) return;
                            el.value = val ?? '';
                            if (el.tagName === 'SELECT') el.dispatchEvent(new Event('change'));
                        };

                        setVal('record_id', '{{ $editStudent->id }}');
                        setVal('student_id', @json($editStudent->student_id));
                        setVal('first_name', @json($editStudent->first_name));
                        setVal('last_name', @json($editStudent->last_name));
                        setVal('nic_number', @json($editStudent->nic_number));
                        setVal('email', @json($editStudent->email));
                        setVal('gender', @json($editStudent->gender));
                        setVal('mobile', @json($editStudent->mobile));
                        setVal('whatsapp', @json($editStudent->whatsapp));
                        setVal('contact_address', @json($editStudent->contact_address));
                        setVal('permanent_address', @json($editStudent->permanent_address));

                        // Hydrate per-course fields
                        hydrateCoursesFromMap(@json($coursesMap));

                        // Switch to update action
                        const form = document.getElementById('studentForm');
                        if (form) {
                            form.setAttribute('action', "{{ route('students.updateIds') }}");
                            const btn = document.getElementById('submitBtn');
                            if (btn) btn.textContent = 'Update Student';
                        }
                        // Optional: scroll to form
                        // form?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    @endif
                });
            </script> --}}

            {{-- <script>
                document.addEventListener('click', function(e) {
                    const btn = e.target.closest('.edit-btn');
                    if (!btn) return;

                    const form = document.getElementById('studentForm');
                    if (!form) {
                        console.warn('No #studentForm on this page.');
                        return;
                    }

                    const setVal = (name, val) => {
                        const el = document.querySelector(`[name="${name}"]`) || document.getElementById(name);
                        if (!el) return;
                        el.value = val ?? '';
                        if (el.tagName === 'SELECT') el.dispatchEvent(new Event('change'));
                    };

                    setVal('record_id', btn.dataset.student_pk);
                    setVal('student_id', btn.dataset.public_student_id);
                    setVal('first_name', btn.dataset.first_name);
                    setVal('last_name', btn.dataset.last_name);
                    setVal('nic_number', btn.dataset.nic_number);
                    setVal('email', btn.dataset.email);
                    setVal('gender', btn.dataset.gender);
                    setVal('mobile', btn.dataset.mobile);
                    setVal('whatsapp', btn.dataset.whatsapp);
                    setVal('contact_address', btn.dataset.contact_address);

                    // hydrate courses
                    let map = {};
                    try {
                        map = btn.dataset.courses ? JSON.parse(btn.dataset.courses) : {};
                    } catch (e) {
                        map = {};
                    }
                    hydrateCoursesFromMap(map);

                    form.setAttribute('action', "{{ route('students.updateIds') }}");
                    const submitBtn = document.getElementById('submitBtn');
                    if (submitBtn) submitBtn.textContent = 'Update Student';

                    form.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            </script> --}}
            <!-- Edit Pending Modal -->
            <div class="modal fade" id="assignIdBatchModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('students.assignBatch') }}">
                            @csrf
                            <input type="hidden" name="enrollment_id" id="assign_enrollment_id">

                            <div class="modal-header" style="background:#1d3557;color:#f1faee">
                                <h5 class="modal-title">Assign Student ID & Batch</h5>
                                <button type="button" class="btn-close btn-close-white"
                                    data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-2 small text-muted">
                                    <div><strong>Student:</strong> <span id="assign_name"></span></div>
                                    <div><strong>Course:</strong> <span id="assign_course"></span></div>
                                    <div><strong>Branch:</strong> <span id="assign_branch"></span></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Student ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="student_id" id="assign_student_id"
                                        placeholder="e.g. CBBS-2025-001">
                                    <div class="form-text">Must be unique.</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Batch <span class="text-danger">*</span></label>
                                    <select class="form-select" name="batch_id" id="assign_batch_id">
                                        <option value="" disabled selected>-- Select Batch --</option>
                                        @foreach ($batch ?? [] as $bat)
                                            <option value="{{ $bat->batch_id }}">{{ $bat->batch_no }}</option>
                                        @endforeach
                                        {{-- @if (!empty($batch))
                                            @foreach ($batch as $item)
                                                <option value="{{ $item->batch_id }}">{{ $item->batch_no }}</option>
                                            @endforeach
                                        @endif --}}
                                    </select>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const m = document.getElementById('assignIdBatchModal');
                    if (!m) return;

                    m.addEventListener('show.bs.modal', function(ev) {
                        const btn = ev.relatedTarget;
                        if (!btn) return;

                        // Fill the modal
                        document.getElementById('assign_enrollment_id').value = btn.dataset.enrollment_id || '';
                        document.getElementById('assign_student_id').value = btn.dataset.public_student_id ||
                            ''; // prefill if exists
                        document.getElementById('assign_name').textContent = (btn.dataset.first_name || '') + ' ' +
                            (btn.dataset.last_name || '');
                        document.getElementById('assign_course').textContent = btn.dataset.course_label || '';
                        document.getElementById('assign_branch').textContent = btn.dataset.branch_name || '';

                        // Preselect current batch if any
                        const sel = document.getElementById('assign_batch_id');
                        if (sel) sel.value = btn.dataset.batch_id || '';
                    });
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
