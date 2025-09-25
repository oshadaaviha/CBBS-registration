@php
    $id = session('id');
@endphp

@if (!empty($id))

    @if (\Illuminate\Support\Facades\Auth::id() == $id)


        <!doctype html>
        <html lang="en">

        <head>

            @include('Layout.appStyles')
            <title>Admin | CBBS | Password Management</title>

        </head>
        @php
            $role = session('role');

        @endphp

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
                                        <h4 class="mb-sm-0 font-size-18">Change Password</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a
                                                        href="{{ url('/editProfileView') . $id }}">Profile</a></li>
                                                <li class="breadcrumb-item active">Change Password</li>
                                            </ol>
                                        </div>


                                    </div>

                                    @if (session()->has('error'))
                                        <div class="col-md-6">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session()->get('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif
                                    @if (session()->has('message'))
                                        <div class="col-md-4">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session()->get('message') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                            </div>
                            <!-- end page title -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="media">
                                                        <div class="me-3">

                                                        </div>
                                                        <div class="media-body align-self-center">
                                                            <div class="text-muted">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 align-self-center">
                                                    <div class="text-lg-center mt-4 mt-lg-0">
                                                        <div class="row">

                                                            <div class="col-9">
                                                                <div class="me-1">
                                                                    <img src="{{ URL::asset('/assets/images/users/user.jpeg') }}"
                                                                        alt="" class="avatar-md rounded-circle "
                                                                        height="100">
                                                                </div>
                                                                <br>
                                                                <div class="media-body align-self-center">
                                                                    <div class="text-muted">

                                                                        <h5 class="font-size-20 text-truncate">
                                                                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                                                        </h5>
                                                                        <p class="text-muted mb-6 text-truncate">
                                                                            {{ \Illuminate\Support\Facades\Auth::user()->role }}
                                                                        </p>
                                                                    </div>
                                                                </div>







                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col md 3">


                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-9">




                                                <form action="{{ url('changePassword') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <div class="container">

                                                        <div class="row">
                                                            <div class="col-md-5">

                                                                <input value="{{ $id }}" name="id"
                                                                    id="id" hidden>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label>Old Password</label>

                                                                    <input type="password" class="form-control"
                                                                        placeholder="Current Password" id="cPwd"
                                                                        name="cPwd" required>

                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <label>New Password</label>

                                                                    <input type="password" class="form-control"
                                                                        placeholder="New Password" id="newPwd"
                                                                        name="newPwd" required>

                                                                </div>
                                                                <br>


                                                                <div class="form-group">



                                                                    <div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary waves-effect waves-light">Update</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>



                                </div>




                            </div>



                        </div>
                        <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->










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
    @include('Layout.notValidateUser')
@endif
