<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Registration — CBBS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-blue: #1e3357;
            /* navy */
            --brand-blue-2: #29476f;
            /* lighter navy */
            --brand-red: #bf2135;
            /* solid logo red */
            --brand-red-2: #d4464f;
            /* lighter red */
            --pane-text: #e7eef6;
            --footer-top: #13283a;
            --footer-bot: #102232;
        }

        html,
        body {
            height: 100%
        }

        body {
            background: #f6f8fb;
            overflow-x: hidden;
        }

        /* ===== Desktop LEFT info pane ===== */
        .left-pane {
            position: relative;
            background: linear-gradient(135deg, var(--brand-blue) 0%, var(--brand-blue-2) 45%, var(--brand-red-2) 80%, var(--brand-red) 100%);
            color: var(--pane-text);
            padding: 2rem 1.5rem;
            border-top-right-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
            box-shadow: 4px 0 24px rgba(0, 0, 0, .12);
        }

        @media (min-width: 992px) {
            .pane-sticky {
                position: sticky;
                top: 0;
                height: 100vh;
                overflow: hidden;
            }
        }

        .pane-watermark {
            position: absolute;
            inset: 0;
            background: no-repeat center/60% url('{{ asset('assets/images/logo.png') }}');
            opacity: .06;
            filter: saturate(0.9) contrast(1.05);
            pointer-events: none;
        }

        .logo-badge {
            width: 160px;
            height: 160px;
            margin: 0 auto .9rem;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .45);
            box-shadow: 0 12px 28px rgba(0, 0, 0, .22), inset 0 0 0 10px rgba(255, 255, 255, .08);
            backdrop-filter: blur(6px);
        }

        .logo-badge img {
            width: 120px;
            height: 120px;
            object-fit: contain
        }

        .pane-title {
            font-weight: 800;
            letter-spacing: .2px;
            margin: 0
        }

        .pane-sub {
            opacity: .9;
            margin-top: .15rem
        }

        .pane-hr {
            border-color: rgba(255, 255, 255, .25);
            opacity: 1
        }

        .pane-link {
            color: #fff;
            text-decoration: none
        }

        .pane-link:hover {
            color: #fff;
            text-decoration: underline
        }

        .visit-btn {
            background: #ffffff;
            border: 0;
            color: #1e3357;
            font-weight: 700
        }

        .visit-btn:hover {
            background: #f3f6fb;
            color: #12233d
        }

        /* ===== Mobile brand header (top) ===== */
        .mobile-hero {
            background: linear-gradient(110deg, var(--brand-blue) 0%, var(--brand-blue-2) 45%, var(--brand-red-2) 80%, var(--brand-red) 100%);
            color: #fff;
            text-align: center;
            padding: 1.25rem .75rem 1.5rem;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
            box-shadow: 0 6px 22px rgba(0, 0, 0, .12);
        }

        .mobile-badge {
            width: 110px;
            height: 110px;
            margin: 0 auto .5rem;
            display: grid;
            place-items: center;
            border-radius: 999px;
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .45);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .2), inset 0 0 0 8px rgba(255, 255, 255, .08);
            backdrop-filter: blur(5px);
        }

        .mobile-badge img {
            width: 84px;
            height: 84px;
            object-fit: contain
        }

        /* ===== Right Form ===== */
        .form-wrap {
            max-width: 1000px;
        }

        .card-modern {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 12px 30px rgba(16, 24, 40, .08)
        }

        .card-modern .card-header {
            background: var(--brand-red);
            /* solid red, no gradient */
            color: #fff;
            border-radius: 1rem 1rem 0 0;
        }

        .section {
            padding: 1.25rem;
            background: #fff;
            border: 1px solid #eef1f5;
            border-radius: .75rem;
            margin-bottom: 1rem
        }

        .section-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin: 0 0 .75rem;
            color: #23344a
        }

        .required::after {
            content: " *";
            color: #dc3545
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3f6da5;
            box-shadow: 0 0 0 .2rem rgba(63, 109, 165, .25)
        }

        @media (max-width:576px) {
            .btn-lg {
                padding: .75rem 1.1rem;
                font-size: 1rem
            }
        }

        /* ===== Mobile footer (bottom) ===== */
        .mobile-footer {
            background: var(--footer-top);
            color: #e6eef5;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .mobile-footer a {
            color: #d6e2ea;
            text-decoration: none
        }

        .mobile-footer a:hover {
            color: #fff
        }

        .footer-bottom {
            background: var(--footer-bot);
            padding: .6rem 0;
        }

        .footer-logo {
            height: 38px
        }
    </style>
</head>

<body>

    <div class="container-fluid px-0">
        <div class="row g-0">
            {{-- ===== MOBILE HEADER (only < lg) ===== --}}
            <div class="col-12 d-lg-none">
                <div class="mobile-hero">
                    <div class="mobile-badge">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="CBBS">
                    </div>
                    <h1 class="h5 mb-1">Colombo Bartender &amp; Barista School</h1>
                    <div class="small opacity-75 mb-2">Admissions &amp; Registration</div>
                    <a href="{{ $companyWebsite ?? 'https://example.com' }}" target="_blank" rel="noopener"
                        class="btn btn-light fw-bold rounded-pill px-3 py-2">
                        Visit Website
                    </a>
                </div>
            </div>

            {{-- ===== DESKTOP LEFT PANEL (hidden on mobile) ===== --}}
            <aside class="col-lg-5 d-none d-lg-block">
                <div class="left-pane pane-sticky d-flex flex-column">
                    <div class="pane-watermark"></div>

                    <div class="text-center mb-3">
                        <div class="logo-badge">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="CBBS">
                        </div>
                        <h1 class="h4 pane-title">Colombo Bartender &amp; Barista School</h1>
                        <div class="pane-sub mb-3">Admissions &amp; Registration</div>

                        <a href="{{ $companyWebsite ?? 'https://barbaristaschool.com/' }}" target="_blank"
                            rel="noopener" class="btn visit-btn btn-lg px-4 rounded-pill shadow-sm">
                            Visit Website
                        </a>
                    </div>

                    <div class="mt-auto">
                        <hr class="pane-hr">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h6 class="fw-bold text-white-50 mb-2">Locations</h6>
                                <div class="small mb-3">No. 15B 1/2, Alfred Place, Colombo 03.<br>077 202 8750</div>
                                <div class="small mb-3">No. 67, Walukarama Road, Colombo 03.<br>077 718 0275</div>
                                <div class="small mb-3">No: 446/5, Peradeniya Road, Kandy.<br>074 394 2648</div>
                                <div class="small mb-3">No. 61A, Rajapihilla Mawatha, Kurunegala.<br>076 663 0721</div>

                            </div>
                            <div class="col-12 col-md-6">
                                <h6 class="fw-bold text-white-50 mb-2">Contact</h6>
                                <div class="small mb-2"><strong>Alfred Place</strong><br>Office : +94 11 799
                                    9480<br>HotLine : +94 077 202 8750</div>
                                <div class="small mb-2"><strong>Walukarama Road</strong><br>Office : +94 11 237
                                    2824<br>HotLine : +94 77 718 0275</div>
                                <div class="small mb-2"><strong>Kandy</strong><br>HotLine : +94 74 394 2648</div>
                                <div class="small mb-3"><strong>Kurunegala</strong><br>HotLine : +94 76 663 0721</div>
                                <div class="small">Email : <a class="pane-link"
                                        href="mailto:hi@barbistaschool.com">hi@barbistaschool.com</a></div>
                            </div>
                        </div>
                        <hr class="pane-hr mt-3">
                        <div class="text-center small">© {{ date('Y') }} CBBS — All Rights Reserved</div>
                    </div>
                </div>
            </aside>

            {{-- ===== RIGHT FORM ===== --}}
            <section class="col-12 col-lg-7 d-flex align-items-start justify-content-center">
                <div class="container py-4 py-lg-5 form-wrap">
                    <div class="card card-modern">
                        <div class="card-header"
                            style="background:linear-gradient(110deg,#1b2b44 0%,#2d5373 55%,#4e86a6 100%);
                        color:#fff;border-top-left-radius:1rem;border-top-right-radius:1rem;">
                            <h4 class="mb-1">Student Registration Form</h4>
                            <div class="small opacity-75">Please complete all required fields</div>
                        </div>

                        <div class="card-body">
                            @if (session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif

                            <form method="POST" action="{{ route('students.store') }}" class="needs-validation"
                                novalidate>
                                @csrf
                                {{-- <input type="hidden" name="name" id="nameHidden" value=""> --}}

                                {{-- Personal Details --}}
                                <div class="section">
                                    <h6 class="section-title">Personal Details</h6>
                                    <div class="row g-3">
                                        {{-- <div class="col-12 col-md-4">
                      <label for="student_id" class="form-label required">Student ID</label>
                      <input type="text" name="student_id" id="student_id" class="form-control" required value="{{ old('student_id') }}">
                    </div> --}}
                                        <div class="col-12 col-md-6">
                                            <label for="first_name" class="form-label required">First Name</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control"
                                                required value="{{ old('first_name') }}">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="last_name" class="form-label required">Last Name</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                required value="{{ old('last_name') }}">
                                        </div>


                                        <div class="col-12 col-md-6">
                                            <label for="citizenship" class="form-label required">Citizenship</label>
                                            <input type="text" name="citizenship" id="citizenship"
                                                class="form-control" required value="{{ old('citizenship') }}">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="nic_number" class="form-label required">NIC Number</label>
                                            <input type="text" name="nic_number" id="nic_number" class="form-control"
                                                required placeholder="199012345678 or 901234567V"
                                                pattern="^(\d{9}[VvXx]|\d{12})$" value="{{ old('nic_number') }}">
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="certificate_name" class="form-label required">Name on
                                                Certificate</label>
                                            <input type="text" name="certificate_name" id="certificate_name"
                                                class="form-control" required value="{{ old('certificate_name') }}">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="gender" class="form-label required">Gender</label>
                                            <select name="gender" id="gender" class="form-select" required>
                                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>
                                                    -- Select --</option>
                                                <option {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                                <option {{ old('gender') === 'Female' ? 'selected' : '' }}>Female
                                                </option>
                                                <option {{ old('gender') === 'Other' ? 'selected' : '' }}>Other
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Contact --}}
                                <div class="section">
                                    <h6 class="section-title">Contact</h6>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-4">
                                            <label for="mobile" class="form-label required">Mobile Number</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control"
                                                required placeholder="+9471XXXXXXX or 071XXXXXXX"
                                                pattern="^(?:\+94|0)?7\d{8}$" value="{{ old('mobile') }}">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="whatsapp" class="form-label required">WhatsApp Number</label>
                                            <input type="text" name="whatsapp" id="whatsapp"
                                                class="form-control"required pattern="^(?:\+94|0)?7\d{8}$"
                                                value="{{ old('whatsapp') }}">
                                            <div class="form-text"><a href="#" id="copyMobile">Same as
                                                    mobile</a></div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="name@example.com">
                                        </div>
                                        {{-- </div>
                                </div> --}}

                                        {{-- Addresses --}}
                                        {{-- <div class="section">
                                    <h6 class="section-title">Addresses</h6>
                                    <div class="row g-3"> --}}
                                        <div class="col-12 col-lg-6">
                                            <label for="contact_address" class="form-label">Contact Address</label>
                                            <textarea name="contact_address" id="contact_address" rows="2" class="form-control">{{ old('contact_address') }}</textarea>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="permanent_address" class="form-label">Permanent
                                                Address</label>
                                            <textarea name="permanent_address" id="permanent_address" rows="2" class="form-control">{{ old('permanent_address') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="section">
                                    <h6 class="section-title">Occupation</h6>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label for="education_level" class="form-label required">Education
                                                Level</label>
                                            <select name="education_level" id="education_level" class="form-control"
                                                required>
                                                <option value="" disabled
                                                    {{ old('education_level') ? '' : 'selected' }}>
                                                    -- Select Education Level --</option>
                                                <option value="O/L"
                                                    {{ old('education_level') == 'O/L' ? 'selected' : '' }}>O/L
                                                </option>
                                                <option value="A/L"
                                                    {{ old('education_level') == 'A/L' ? 'selected' : '' }}>A/L
                                                </option>
                                                <option value="Undergraduate"
                                                    {{ old('education_level') == 'Undergraduate' ? 'selected' : '' }}>
                                                    Undergraduate</option>
                                                <option value="BSc/BA/HND"
                                                    {{ old('education_level') == 'BSc/BA/HND' ? 'selected' : '' }}>
                                                    BSc/BA/HND</option>
                                                <option value="Hotel school graduate"
                                                    {{ old('education_level') == 'Hotel school graduate' ? 'selected' : '' }}>
                                                    Hotel school graduate</option>
                                                <option value="Current hotel school student"
                                                    {{ old('education_level') == 'Current hotel school student' ? 'selected' : '' }}>
                                                    Current hotel school student</option>
                                                <option value="MBA/MSc"
                                                    {{ old('education_level') == 'MBA/MSc' ? 'selected' : '' }}>MBA/MSc
                                                </option>
                                                <option value="PhD"
                                                    {{ old('education_level') == 'PhD' ? 'selected' : '' }}>PhD
                                                </option>
                                                <option value="Other"
                                                    {{ old('education_level') == 'Other' ? 'selected' : '' }}>Other
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="occupation" class="form-label required">Occupation and
                                                Employer</label>
                                            <input type="text" name="occupation" id="occupation"
                                                class="form-control" value="{{ old('occupation') }}"
                                                placeholder="if there is no employer, say 'no'" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- Enrollment --}}
                                <div class="section">
                                    <h6 class="section-title">Enrollment</h6>
                                    <div class="row g-2">
                                        <div class="col-12 col-md-8">
                                            <label class="form-label required d-block mb-2">Courses</label>

                                            <div class="row g-3">
                                                @foreach ($course ?? [] as $item)
                                                    @php
                                                        $checked = old("courses.$item->course_id.selected") == '1';
                                                        $oldTrack = old("courses.$item->course_id.track");
                                                    @endphp

                                                    <div class="col-12 col-sm-6">
                                                        <div class="border rounded p-3 h-100">
                                                            {{-- Course include checkbox --}}
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input course-checkbox"
                                                                    type="checkbox"
                                                                    id="course_{{ $item->course_id }}"
                                                                    name="courses[{{ $item->course_id }}][selected]"
                                                                    value="1" {{ $checked ? 'checked' : '' }}
                                                                    data-target="#trackWrap_{{ $item->course_id }}">
                                                                <label class="form-check-label fw-semibold"
                                                                    for="course_{{ $item->course_id }}">
                                                                    {{ $item->course_name }}
                                                                </label>
                                                            </div>

                                                            {{-- Track radios for this course --}}
                                                            <div id="trackWrap_{{ $item->course_id }}"
                                                                class="ms-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        id="track_normal_{{ $item->course_id }}"
                                                                        name="courses[{{ $item->course_id }}][track]"
                                                                        value="Normal"
                                                                        {{ $oldTrack === 'Normal' ? 'checked' : '' }}
                                                                        {{ $checked ? '' : 'disabled' }}
                                                                        {{ $checked ? 'required' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="track_normal_{{ $item->course_id }}">Normal
                                                                        </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        id="track_fast_{{ $item->course_id }}"
                                                                        name="courses[{{ $item->course_id }}][track]"
                                                                        value="Fast"
                                                                        {{ $oldTrack === 'Fast' ? 'checked' : '' }}
                                                                        {{ $checked ? '' : 'disabled' }}
                                                                        {{ $checked ? 'required' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="track_fast_{{ $item->course_id }}">Fast
                                                                        Track</label>
                                                                </div>

                                                                {{-- per-course track validation error (optional) --}}
                                                                @error("courses.$item->course_id.track")
                                                                    <div class="text-danger small mt-1">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Tiny JS: enable/disable track radios based on checkbox --}}
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                function toggleTrackGroup(checkbox) {
                                                    const targetSel = checkbox.getAttribute('data-target');
                                                    const wrap = document.querySelector(targetSel);
                                                    if (!wrap) return;

                                                    const radios = wrap.querySelectorAll('input[type="radio"]');
                                                    if (checkbox.checked) {
                                                        radios.forEach(r => {
                                                            r.disabled = false;
                                                            r.required = true;
                                                        });
                                                    } else {
                                                        radios.forEach(r => {
                                                            r.checked = false;
                                                            r.disabled = true;
                                                            r.required = false;
                                                        });
                                                    }
                                                }

                                                document.querySelectorAll('.course-checkbox').forEach(cb => {
                                                    // init on load
                                                    toggleTrackGroup(cb);
                                                    // toggle on change
                                                    cb.addEventListener('change', () => toggleTrackGroup(cb));
                                                });
                                            });
                                        </script>





                                        <div class="col-12 col-md-4">
                                            <label for="branch_id" class="form-label required">Branch</label>
                                            <select name="branch_id" id="branch_id" class="form-select" required>
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

                                        <div class="col-12 col-md-6">
                                            <label for="preferred_class" class="form-label required">Preferred
                                                class</label>
                                            <select name="preferred_class" id="preferred_class" class="form-control"
                                                required>
                                                <option value="" disabled
                                                    {{ old('preferred_class') ? '' : 'selected' }}>
                                                    -- Select Preferred class --</option>
                                                <option value="a weekday class"
                                                    {{ old('preferred_class') == 'a weekday class' ? 'selected' : '' }}>
                                                    A weekday class</option>
                                                <option value="weekend class"
                                                    {{ old('preferred_class') == 'weekend class' ? 'selected' : '' }}>
                                                    Weekend class (Saturday / Sunday)</option>
                                                <option value="weekday or weekend class"
                                                    {{ old('preferred_class') == 'weekday or weekend class' ? 'selected' : '' }}>
                                                    Weekday or weekend class</option>
                                            </select>
                                        </div>


                                        {{-- <div class="col-12 col-md-4">
                      <label for="batch_id" class="form-label required">Batch</label>
                      <select name="batch_id" id="batch_id" class="form-select" required>
                        <option value="" disabled {{ old('batch_id') ? '' : 'selected' }}>-- Select Batch --</option>
                        @foreach ($batch ?? [] as $item)
                          <option value="{{ $item->batch_id }}" {{ old('batch_id') == $item->batch_id ? 'selected' : '' }}>
                            {{ $item->batch_no }}
                          </option>
                        @endforeach
                      </select>
                    </div> --}}
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" id="submitBtn">Submit
                                        Registration</button>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ===== MOBILE FOOTER (only < lg) ===== --}}
            <div class="col-12 d-lg-none mt-3">
                <div class="mobile-footer pt-3">
                    <div class="container">
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <h6 class="fw-bold text-white mb-2">Locations</h6>
                                <div class="small mb-3">No. 15B 1/2, Alfred Place, Colombo 03.<br>077 202 8750</div>
                                <div class="small mb-3">No. 67, Walukarama Road, Colombo 03.<br>077 718 0275</div>
                                <div class="small mb-3">No: 446/5, Peradeniya Road, Kandy.<br>074 394 2648</div>
                                <div class="small">No. 61A, Rajapihilla Mawatha, Kurunegala.<br>076 663 0721</div>
                            </div>
                            <div class="col-12 col-md-6">
                                <h6 class="fw-bold text-white mb-2">Contact</h6>
                                <div class="small mb-2"><strong>Alfred Place</strong><br>Office : +94 11 799
                                    9480<br>HotLine : +94 077 202 8750</div>
                                <div class="small mb-2"><strong>Walukarama Road</strong><br>Office : +94 11 237
                                    2824<br>HotLine : +94 77 718 0275</div>
                                <div class="small mb-2"><strong>Kandy</strong><br>HotLine : +94 74 394 2648</div>
                                <div class="small mb-3"><strong>Kurunegala</strong><br>HotLine : +94 76 663 0721</div>
                                <div class="small">Email : <a
                                        href="mailto:hi@barbistaschool.com">hi@barbistaschool.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-bottom">
                        <div class="container d-flex flex-column align-items-center gap-2">
                            <img src="{{ asset('assets/images/logo.png') }}" class="footer-logo" alt="CBBS">
                            <div class="small text-center">Colombo Bartender &amp; Barista School ©
                                {{ date('Y') }} / All Rights Reserved</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Copy mobile -> WhatsApp
        document.getElementById('copyMobile')?.addEventListener('click', function(e) {
            e.preventDefault();
            const m = document.getElementById('mobile');
            const w = document.getElementById('whatsapp');
            if (m && w) w.value = m.value;
        });
        // Build hidden 'name' from first/last (backend unchanged)
        document.getElementById('submitBtn')?.addEventListener('click', function() {
            const first = (document.getElementById('first_name')?.value || '').trim();
            const last = (document.getElementById('last_name')?.value || '').trim();
            const hidden = document.getElementById('nameHidden');
            if (hidden) hidden.value = (first + ' ' + last).trim();
        });
    </script>
    @if (session('success') || session('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success',
                    text: @json(session('success') ?? session('message')),
                    icon: 'success',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(() => {
                    // Refresh the page after the user clicks OK
                    window.location.href = window.location.pathname + window.location.search;
                });
            });
        </script>
    @endif

    <style>
        .form-check-input:checked {
            background-color: var(--brand-red);
            border-color: var(--brand-red);
        }
    </style>


</body>

</html>
