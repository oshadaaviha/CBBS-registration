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
                                        <input type="text" id="shareLink" class="form-control"
                                            value="{{ route('students.publicForm') }}" readonly>
                                        <button class="btn btn-primary" id="copyBtn">Copy</button>
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
                                        <input type="hidden" name="record_id" id="record_id">
                                        <div class="section">
                                            <h5 class="mb-3">Student Information</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="student_id" class="form-label">Student ID <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="student_id" class="form-control"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="first_name" class="form-label">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="first_name" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="last_name" class="form-label">Last Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="last_name" class="form-control" required>
                                                </div>

                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="citizenship" class="form-label">Citizenship <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="citizenship" class="form-control"
                                                        required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nic_number" class="form-label">NIC Number <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="nic_number" class="form-control"
                                                        required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="certificate_name" class="form-label">Name on
                                                        Certificate
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" name="certificate_name"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label for="gender" class="form-label">Gender <span
                                                            class="text-danger">*</span></label>
                                                    <select name="gender" class="form-select" required>
                                                        <option value="" disabled selected>-- Select --</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                        <option>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="mobile" class="form-label">Mobile Number</label>
                                                    <input type="text" name="mobile" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="whatsapp" class="form-label">WhatsApp Number</label>
                                                    <input type="text" name="whatsapp" class="form-control">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" name="email" class="form-control">
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="contact_address" class="form-label">Contact
                                                        Address</label>
                                                    <textarea name="contact_address" rows="2" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="permanent_address" class="form-label">Permanent
                                                        Address</label>
                                                    <textarea name="permanent_address" rows="2" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <div class="section">
                                            <h4 class="section-title">Enrollment</h4>
                                            <div class="row g-2">
                                                <div class="col-12 col-md-4">
                                                    <label class="form-label required d-block mb-2">Courses</label>
                                                    <div class="row g-2">
                                                        @foreach ($course ?? [] as $item)
                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="course_id[]"
                                                                        id="course_{{ $item->course_id }}"
                                                                        value="{{ $item->course_id }}"
                                                                        {{ is_array(old('course_id')) && in_array($item->course_id, old('course_id')) ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="course_{{ $item->course_id }}">
                                                                        {{ $item->course_name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>


                                                <div class="col-12 col-md-4">
                                                    <label for="branch_id" class="form-label required">Branch</label>
                                                    <select name="branch_id" id="branch_id" class="form-select"
                                                        required>
                                                        <option value="" disabled
                                                            {{ old('branch_id') ? '' : 'selected' }}>
                                                            -- Select Branch --
                                                        </option>
                                                        @foreach ($branch ?? [] as $item)
                                                            <option value="{{ $item->branch_id }}"
                                                                {{ old('branch_id') == $item->branch_id ? 'selected' : '' }}>
                                                                {{ $item->branch_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="batch_id" class="form-label required">Batch</label>
                                                    <select name="batch_id" id="batch_id" class="form-select"
                                                        required>
                                                        <option value="" disabled
                                                            {{ old('batch_id') ? '' : 'selected' }}>-- Select Batch --
                                                        </option>
                                                        @foreach ($batch ?? [] as $item)
                                                            <option value="{{ $item->batch_id }}"
                                                                {{ old('batch_id') == $item->batch_id ? 'selected' : '' }}>
                                                                {{ $item->batch_no }}
                                                            </option>
                                                        @endforeach
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
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($data as $item)
                                                        <tr>
                                                            <td>{{ $item->student_id }}</td>
                                                            <td>{{ $item->first_name }}</td>
                                                            <td>{{ $item->last_name }}</td>
                                                            <td>{{ $item->nic_number }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ $item->gender }}</td>
                                                            <td>{{ $item->mobile }}</td>
                                                            <td>{{ $item->whatsapp }}</td>
                                                            <td>{{ $item->contact_address }}</td>
                                                            <td>{{ $item->batch_no }}</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-outline-info btn-sm edit-btn"
                                                                    data-id="{{ $item->id }}"
                                                                    data-student_id="{{ $item->student_id }}"
                                                                    data-first_name="{{ $item->first_name }}"
                                                                    data-last_name="{{ $item->last_name }}"
                                                                    data-nic_number="{{ $item->nic_number }}"
                                                                    data-email="{{ $item->email }}"
                                                                    data-gender="{{ $item->gender }}"
                                                                    data-mobile="{{ $item->mobile }}"
                                                                    data-whatsapp="{{ $item->whatsapp }}"
                                                                    data-contact_address="{{ $item->contact_address }}"
                                                                    data-branch_id="{{ $item->branch_id }}"
                                                                    data-batch_id="{{ $item->batch_id }}"
                                                                    data-course_id="{{ $item->course_id }}">
                                                                    Edit
                                                                </button>

                                                                <a href="{{ url('/deleteStudent/' . $item->id) }}"
                                                                    class="btn btn-outline-danger btn-sm"
                                                                    onclick="return confirm('Are you sure?')">
                                                                    Delete
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="11" class="text-center">No records found
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
document.addEventListener('DOMContentLoaded', function () {
  const form         = document.getElementById('studentForm');
  const submitBtn    = document.getElementById('submitBtn');
  const defaultAction= form.getAttribute('action'); // students.store

  function setValue(id, val) {
    const el = document.querySelector(`[name="${id}"]`) || document.getElementById(id);
    if (!el) return;
    if (el.tagName === 'SELECT') {
      el.value = val ?? '';
      el.dispatchEvent(new Event('change'));
    } else {
      el.value = val ?? '';
    }
  }

  // When clicking "Edit", populate form and switch action to updateIds
  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      // Fill fields
      setValue('record_id',      btn.dataset.id);
      setValue('student_id',     btn.dataset.student_id);
      setValue('first_name',     btn.dataset.first_name);
      setValue('last_name',      btn.dataset.last_name);
      setValue('nic_number',     btn.dataset.nic_number);
      setValue('email',          btn.dataset.email);
      setValue('gender',         btn.dataset.gender);
      setValue('mobile',         btn.dataset.mobile);
      setValue('whatsapp',       btn.dataset.whatsapp);
      setValue('contact_address',btn.dataset.contact_address);
      setValue('branch_id',      btn.dataset.branch_id);
      setValue('batch_id',       btn.dataset.batch_id);
      setValue('course_id',      btn.dataset.course_id); // if single course

      // Switch to update route
      form.setAttribute('action', "{{ route('students.updateIds') }}");
      submitBtn.textContent = 'Update Student';

      // Scroll to the form
      form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });

  // Optional: when you manually clear record_id, switch back to create mode
  window.resetToCreateMode = function() {
    document.getElementById('record_id').value = '';
    form.setAttribute('action', defaultAction);
    submitBtn.textContent = 'Submit Registration';
  };
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success') || session('message') || session('error'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const msg  = @json(session('success') ?? session('message') ?? session('error'));
    const icon = {!! session('error') ? "'error'" : "'success'" !!};

    Swal.fire({
      title: icon === 'success' ? 'Success' : 'Error',
      text: msg,
      icon: icon,
      confirmButtonText: 'OK',
      allowOutsideClick: false,
      allowEscapeKey: false
    }).then(() => {
      // Refresh the page after the user clicks OK
      // Use location.replace to avoid re-post prompts and keep a clean URL
      location.replace(window.location.pathname + window.location.search);
      // Or simply: window.location.reload();
    });
  });
</script>
@endif
<script>
  // Copy mobile -> WhatsApp (unchanged)
  document.getElementById('copyMobile')?.addEventListener('click', function(e){
    e.preventDefault();
    const m = document.getElementById('mobile');
    const w = document.getElementById('whatsapp');
    if (m && w) w.value = m.value;
  });

  // Build hidden 'name' from first/last on SUBMIT (works with Enter key too)
  const form = document.querySelector('form[action="{{ route('students.store') }}"]');
  form?.addEventListener('submit', function () {
    const first  = (document.getElementById('first_name')?.value || '').trim();
    const last   = (document.getElementById('last_name')?.value  || '').trim();
    const hidden = document.getElementById('nameHidden');
    if (hidden) hidden.value = (first + ' ' + last).trim();
  });
</script>

