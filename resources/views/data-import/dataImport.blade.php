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
            <title>Admin | CBBS | Student Registration </title>

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

                <div class="mb-3">
                    <a href="{{ route('students.publicForm') }}" target="_blank" class="btn btn-info">
                        Share Registration Form
                    </a>
                </div>


                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">
                    <div class="page-content">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-6">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-2 font-size-18">Student Registration Form</h4>

                                    {{-- <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Student</a>
                                                </li>
                                                <li class="breadcrumb-item active">Student Management</li>
                                            </ol>
                                        </div> --}}

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        {{-- <div class="container-fluid"> --}}

                        <!-- Share Modal -->
                        <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content p-3" style="border-radius: 12px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="modal-title fw-bold" id="shareModalLabel">Share Registration Form
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <hr>

                                    <p class="mb-1">Share this link via</p>
                                    <div class="d-flex gap-3 mb-3">
                                        <a href="#" id="fbShare" class="text-decoration-none fs-4"><i
                                                class="fab fa-facebook"></i></a>
                                        <a href="#" id="twShare" class="text-decoration-none fs-4"><i
                                                class="fab fa-twitter"></i></a>
                                        <a href="#" id="igShare" class="text-decoration-none fs-4"><i
                                                class="fab fa-instagram"></i></a>
                                        <a href="#" id="waShare" class="text-decoration-none fs-4"><i
                                                class="fab fa-whatsapp"></i></a>
                                        <a href="#" id="tgShare" class="text-decoration-none fs-4"><i
                                                class="fab fa-telegram"></i></a>
                                    </div>

                                    <p class="mb-1">Or copy link</p>
                                    <div class="input-group">
                                        @php $shareUrl = route('students.publicForm', ['ref' => Auth::id()]); @endphp
                                        <input type="text" id="shareLink" class="form-control"
                                            value="{{ $shareUrl }}" readonly>
                                        <button class="btn btn-primary" id="copyBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#shareModal">Copy</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                            <a href="{{ route('students.publicForm') }}" target="_blank" class="btn btn-info">
                                Share Registration Form
                            </a>
                        </div> --}}

                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#shareModal">
                            Share Registration Form
                        </button>


                        <div class="container mt-2 mb-5">
                            <div class="card shadow-sm">
                                <div class="card-header"
                                    style="background-color: #1d3557; color: #f1faee; font-family: 'Poppins', sans-serif;">
                                    <h4 class="mb-0" style="font-weight: 600; color: #f1faee;">Student Registration
                                        Form</h4>
                                </div>

                                <div class="card-body">
                                    @if (session('message'))
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif
                                    <form method="POST" action="{{ route('students.store') }}" id="studentForm">
                                        @csrf
                                        {{-- Student info --}}
                                        <div class="section mb-3">
                                            <h6 class="section-title mb-3">Student Information</h6>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label for="student_id" class="form-label">Student ID <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="student_id" id="student_id"
                                                        class="form-control" value="{{ old('student_id') }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" name="first_name" class="form-control"
                                                        value="{{ old('first_name') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control"
                                                        value="{{ old('last_name') }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">Citizenship <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="citizenship" class="form-control"
                                                        value="{{ old('citizenship') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">NIC Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="nic_number" class="form-control"
                                                        value="{{ old('nic_number') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Gender <span
                                                            class="text-danger">*</span></label>
                                                    <select name="gender" class="form-select">
                                                        <option value="" disabled
                                                            {{ old('gender') ? '' : 'selected' }}>-- Select --</option>
                                                        <option {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                                            Female
                                                        </option>
                                                        {{-- <option {{ old('gender') == 'Other' ? 'selected' : '' }}>Other
                                                        </option> --}}
                                                    </select>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label">Name on Certificate <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="certificate_name"
                                                        class="form-control" value="{{ old('certificate_name') }}">
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">Mobile</label>
                                                    <input type="text" name="mobile" class="form-control"
                                                        value="{{ old('mobile') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">WhatsApp</label>
                                                    <input type="text" name="whatsapp" class="form-control"
                                                        value="{{ old('whatsapp') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ old('email') }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Contact Address</label>
                                                    <textarea name="contact_address" rows="2" class="form-control">{{ old('contact_address') }}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Permanent Address</label>
                                                    <textarea name="permanent_address" rows="2" class="form-control">{{ old('permanent_address') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        {{-- Enrollment --}}
                                        <div class="section">
                                            <h6 class="section-title mb-2">Enrollment</h6>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-8">
                                                    <label class="form-label required d-block mb-2">Courses</label>
                                                    <div class="row g-3">
                                                        @foreach ($course ?? [] as $item)
                                                            @php
                                                                $checked =
                                                                    old("courses.$item->course_id.selected") == '1';
                                                                $oldTrack = old("courses.$item->course_id.track");
                                                                $oldBranch = old("courses.$item->course_id.branch_id");
                                                            @endphp

                                                            <div class="col-12 col-sm-6">
                                                                <div class="border rounded p-3 h-100">
                                                                    {{-- Course checkbox --}}
                                                                    <div class="form-check mb-2">
                                                                        <input class="form-check-input course-checkbox"
                                                                            type="checkbox"
                                                                            id="course_{{ $item->course_id }}"
                                                                            name="courses[{{ $item->course_id }}][selected]"
                                                                            value="1"
                                                                            {{ $checked ? 'checked' : '' }}
                                                                            data-target="#wrap_{{ $item->course_id }}">
                                                                        <label class="form-check-label fw-semibold"
                                                                            for="course_{{ $item->course_id }}">
                                                                            {{ $item->course_name }}
                                                                        </label>
                                                                    </div>

                                                                    {{-- Track + Branch (hidden until checked) --}}
                                                                    <div id="wrap_{{ $item->course_id }}"
                                                                        class="ms-4">
                                                                        {{-- Track --}}
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                id="track_normal_{{ $item->course_id }}"
                                                                                name="courses[{{ $item->course_id }}][track]"
                                                                                value="Normal"
                                                                                {{ $oldTrack === 'Normal' ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="track_normal_{{ $item->course_id }}">Normal</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                id="track_fast_{{ $item->course_id }}"
                                                                                name="courses[{{ $item->course_id }}][track]"
                                                                                value="Fast"
                                                                                {{ $oldTrack === 'Fast' ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="track_fast_{{ $item->course_id }}">Fast
                                                                                Track</label>
                                                                        </div>

                                                                        {{-- Branch per course --}}
                                                                        <div class="mt-2">
                                                                            <label for="branch_{{ $item->course_id }}"
                                                                                class="form-label">Branch</label>
                                                                            <select
                                                                                name="courses[{{ $item->course_id }}][branch_id]"
                                                                                id="branch_{{ $item->course_id }}"
                                                                                class="form-select">
                                                                                <option value="" disabled
                                                                                    {{ $oldBranch ? '' : 'selected' }}>
                                                                                    -- Select Branch --</option>
                                                                                @foreach ($branch ?? [] as $b)
                                                                                    <option
                                                                                        value="{{ $b->branch_id }}"
                                                                                        {{ $oldBranch == $b->branch_id ? 'selected' : '' }}>
                                                                                        {{ $b->branch_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        {{-- (Optional) Per-course batch right here (leave commented if not needed) --}}
                                                                        <div class="mt-2">
                                                                            <label class="form-label">Batch</label>
                                                                            <select
                                                                                name="courses[{{ $item->course_id }}][batch_id]"
                                                                                id="batch_{{ $item->course_id }}"
                                                                                class="form-select">
                                                                                <option value="" disabled
                                                                                    selected>-- Select Batch --</option>
                                                                                @foreach ($batch ?? [] as $bt)
                                                                                    <option
                                                                                        value="{{ $bt->batch_id }}">
                                                                                        {{ $bt->batch_no }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <label class="form-label">Preferred class</label>
                                                    <select name="preferred_class" class="form-select">
                                                        <option value="" disabled
                                                            {{ old('preferred_class') ? '' : 'selected' }}>
                                                            -- Select Preferred class --
                                                        </option>
                                                        <option value="weekday class"
                                                            {{ old('preferred_class') == 'weekday class' ? 'selected' : '' }}>
                                                            Weekday class</option>
                                                        <option value="weekend class"
                                                            {{ old('preferred_class') == 'weekend class' ? 'selected' : '' }}>
                                                            Weekend class (Sat/Sun)</option>
                                                        <option value="weekday or weekend class"
                                                            {{ old('preferred_class') == 'weekday or weekend class' ? 'selected' : '' }}>
                                                            Weekday or weekend</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success btn-lg"
                                                id="submitBtn">Submit
                                                Registration</button>
                                        </div>
                                    </form>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">

                        {{-- <table id="students-table" class="table table-bordered dt-responsive nowrap w-100">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $r)
                                    <tr>
                                        <td>{{ $r->public_student_id }}</td>
                                        <td>{{ $r->first_name }}</td>
                                        <td>{{ $r->last_name }}</td>
                                        <td>{{ $r->nic_number }}</td>
                                        <td>{{ $r->email }}</td>
                                        <td>{{ $r->gender }}</td>
                                        <td>{{ $r->mobile }}</td>
                                        <td>{{ $r->whatsapp }}</td>
                                        <td>{{ $r->contact_address }}</td>
                                        <td>{{ $r->batch_no ?? '-' }}</td>
                                        <td>{{ $r->course_label }}</td>
                                        <td>{{ $r->branch_name ?? '-' }}</td>
                                        <td>{{ $r->track ?: ($r->is_fast_track ? 'Fast' : 'Normal') }}</td>
                                        <td class="text-nowrap">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @push('scripts')
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    $('#students-table').DataTable({
                                        dom: 'Bfrtip',
                                        buttons: ['copy', 'excel', 'pdf', 'colvis'],
                                        pageLength: 10,
                                        order: [] // keep your server-side ordering
                                    });
                                });
                            </script>
                        @endpush --}}


                        {{-- </div> --}}
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let shareUrl = document.getElementById("shareLink").value;

        // Social share links
        document.getElementById("fbShare").href =
            `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
        document.getElementById("twShare").href =
            `https://twitter.com/intent/tweet?url=${encodeURIComponent(shareUrl)}`;
        document.getElementById("igShare").href =
            `https://www.instagram.com/?url=${encodeURIComponent(shareUrl)}`;
        document.getElementById("waShare").href = `https://wa.me/?text=${encodeURIComponent(shareUrl)}`;
        document.getElementById("tgShare").href = `https://t.me/share/url?url=${encodeURIComponent(shareUrl)}`;

        // Copy link button
        document.getElementById("copyBtn").addEventListener("click", function() {
            navigator.clipboard.writeText(shareUrl).then(() => {
                alert("Link copied to clipboard!");
            });
        });
    });
</script>
<style>
    #shareModal .modal-content {
        background: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    #shareModal i {
        color: #555;
        transition: color 0.3s;
    }

    #shareModal i:hover {
        color: #007bff;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const shareUrl = @json($shareUrl);
    document.getElementById("fbShare").href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
    document.getElementById("twShare").href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(shareUrl)}`;
    document.getElementById("igShare").href = `https://www.instagram.com/?url=${encodeURIComponent(shareUrl)}`;
    document.getElementById("waShare").href = `https://wa.me/?text=${encodeURIComponent(shareUrl)}`;
    document.getElementById("tgShare").href = `https://t.me/share/url?url=${encodeURIComponent(shareUrl)}`;
    document.getElementById("copyBtn").addEventListener("click", () => navigator.clipboard.writeText(shareUrl).then(() => alert("Link copied to clipboard!")));
});
</script>


<script>
    function hydrateCoursesFromMap(coursesMap) {
        // 1) Clear everything
        document.querySelectorAll('.course-checkbox').forEach(cb => {
            cb.checked = false;
            cb.dispatchEvent(new Event('change')); // will hide & disable radios/selects
        });

        // 2) Apply payload
        if (!coursesMap) return;
        Object.entries(coursesMap).forEach(([courseId, meta]) => {
            const cb = document.getElementById(`course_${courseId}`);
            if (!cb) return;

            // check and reveal group
            cb.checked = true;
            cb.dispatchEvent(new Event('change'));

            // set track radio
            if (meta.track) {
                const rid = meta.track === 'Fast' ? `track_fast_${courseId}` : `track_normal_${courseId}`;
                const r = document.getElementById(rid);
                if (r) r.checked = true;
            }

            // set per-course branch
            if (meta.branch_id) {
                const sel = document.getElementById(`branch_${courseId}`);
                if (sel) sel.value = meta.branch_id;
            }

            // optional per-course batch (if you render one)
            const selBatch = document.getElementById(`batch_${courseId}`);
            if (selBatch && meta.batch_id) selBatch.value = meta.batch_id;
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('studentForm');
        if (!form) return;
        const submitBtn = document.getElementById('submitBtn');
        const defaultAction = form.getAttribute('action'); // students.store

        function setValueByNameOrId(nameOrId, val) {
            let el = document.querySelector(`[name="${nameOrId}"]`);
            if (!el) el = document.getElementById(nameOrId);
            if (!el) return;
            if (el.tagName === 'SELECT') {
                el.value = val ?? '';
                el.dispatchEvent(new Event('change'));
            } else {
                el.value = val ?? '';
            }
        }

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                // Student-level fields (existing)
                setValueByNameOrId('record_id', btn.dataset.student_pk);
                setValueByNameOrId('student_id', btn.dataset.public_student_id);

                setValueByNameOrId('first_name', btn.dataset.first_name);
                setValueByNameOrId('last_name', btn.dataset.last_name);
                setValueByNameOrId('nic_number', btn.dataset.nic_number);
                setValueByNameOrId('email', btn.dataset.email);
                setValueByNameOrId('gender', btn.dataset.gender);
                setValueByNameOrId('mobile', btn.dataset.mobile);
                setValueByNameOrId('whatsapp', btn.dataset.whatsapp);
                setValueByNameOrId('contact_address', btn.dataset.contact_address);
                setValueByNameOrId('branch_id', btn.dataset.branch_id);
                setValueByNameOrId('batch_id', btn.dataset.batch_id);
                setValueByNameOrId('course_id', btn.dataset
                    .course_id); // only if you still keep a single course field

                // NEW: hydrate course checkboxes + per-course fields
                let map = {};
                try {
                    map = btn.dataset.courses ? JSON.parse(btn.dataset.courses) : {};
                } catch (e) {
                    map = {};
                }
                hydrateCoursesFromMap(map);

                // Switch to update route
                form.setAttribute('action', "{{ route('students.updateIds') }}");
                if (submitBtn) submitBtn.textContent = 'Update Student';

                form.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        // Reset helper (unchanged)
        window.resetToCreateMode = function() {
            form.setAttribute('action', defaultAction);
            if (submitBtn) submitBtn.textContent = 'Submit Registration';
            const rid = document.querySelector('[name="record_id"]');
            if (rid) rid.value = '';
        };
    });
</script>
