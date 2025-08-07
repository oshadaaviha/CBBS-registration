@php
    $id = session('id');
@endphp



<header id="page-topbar">

    <div class="navbar-header">

        <div class="d-flex">
            <!-- LOGO -->





<div class="navbar-brand-box p-0">

                <a href="" class="logo logo-dark ">
                                <span class="logo-sm">
                                    <img src="assets/images/logo.png" alt="" height="40" style="margin-top: 20px">
                                </span>
                    <span class="logo-lg">
                                    <img src="assets/images/logo.png" alt="" height="80" style="margin-top: 20px">
                                </span>
                </a>

                <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo.png" alt="" height="40" style="margin-top: 20px">
                                </span>
                    <span class="logo-lg">
                                    <img src="assets/images/logo.png" alt="" height="80" style="margin-top: 20px">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>


        <div class="d-flex">


            {{-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell bx-tada"></i>
                    <span class="badge bg-danger rounded-pill">5</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications"> Notifications </h6>
                            </div>

                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">

                    </div>
                    <div class="p-2 border-top d-grid">

                    </div>
                </div>
            </div> --}}

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="assets/images/users/user.jpeg"
                         alt="Header Avatar">
                         {{-- <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{\Illuminate\Support\Facades\Auth::user()->name}}</span> --}}
{{--                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>--}}
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->


                    <a class="dropdown-item" href="{{url('/editProfileView').$id}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>



                    <a class="dropdown-item d-block" href="{{url('/changePasswordView').$id}}"  ><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Change Password</span></a>




                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{url('logout')}}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-palette bx-spin"></i>
                </button>
            </div>

        </div>
    </div>
</header>


<div class="modal fade change-password" tabindex="-1" role="dialog"
aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form action="{{url('changePassword')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row mb-4">
                        <input type="text" class="form-control" id="id" name="id" hidden>
                        <label  class="col-sm-3 col-form-label">Old Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="oldpassword" name="oldpassword" >
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label  class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="newpassword" name="newpassword">
                        </div>
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-sm-9">


                            <div>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>








            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

