@php
    $role = session('role');

@endphp
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu" >

            <br>
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">


                <li class="menu-title" key="t-menu">Dashboard</li>
                <li>
                    <a href="{{url('/dashboard')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>

                    </a>
                </li>


                <li class="menu-title" key="t-menu">Branches</li>
                <li>
                    <a href="{{url('/branchManagement')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-buildings"></i>
                        <span key="t-dashboards">Branch Management</span>

                    </a>
                </li>

                <li class="menu-title" key="t-menu">Courses</li>
                <li>
                    <a href="{{url('/courseManagement')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-book"></i>
                        <span key="t-dashboards">Course Management</span>

                    </a>
                </li>

                <li class="menu-title" key="t-menu">Batch</li>
                <li>
                    <a href="{{url('/batchManagement')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-group"></i>
                        <span key="t-dashboards">Batch Management</span>

                    </a>
                </li>

                <li class="menu-title" key="t-menu">Students</li>
                <li>
                    <a href="{{url('/studentManagement')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-id-card"></i>
                        <span key="t-dashboards">Student Management</span>

                    </a>
                </li>



                <li>
                    <a href="{{url('/dataImportPage')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx-download"></i>
                        <span key="t-dashboards">Student Registration Form</span>

                    </a>
                </li>

                {{-- <li>
                    <a href="{{url('/filterStudentDetails')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx bxs-user"></i>
                        <span key="t-dashboards">Registered Students</span>

                    </a>
                </li>

                <li>
                    <a href="{{url('/ongoingStudentDetails')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx bxs-user"></i>
                        <span key="t-dashboards">Ongoing Students</span>

                    </a>
                </li>

                <li>
                    <a href="{{url('/certifiedStudentDetails')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx bxs-user"></i>
                        <span key="t-dashboards">Certifired Students</span>

                    </a> --}}
                </li>






                @if($role == 'Admin')
                <li class="menu-title" key="t-menu">Users</li>

                <li>
                    <a href="{{url('/userManagement')}}" class="waves-effect bx-fade-right-hover">
                        <i class="bx bx bxs-user"></i>
                        <span key="t-dashboards">User Management</span>

                    </a>
                </li>


                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
