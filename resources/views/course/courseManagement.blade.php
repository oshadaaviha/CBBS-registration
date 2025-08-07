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
            <title>Admin | CBBS | Course Management</title>


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
                                        <h4 class="mb-sm-0 font-size-18">Course</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Course</a>
                                                </li>
                                                <li class="breadcrumb-item active">Course Management</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                                <div class="row">
                                    <div class="col-md-3">
                                        <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#customerAddModal">Add Course</button>


                                    </div>

                                </div>

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
                                                    class="table table-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>

                                                            <th>Course Name</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if (!empty($data))
                                                            @foreach ($data as $item)
                                                                <tr>
                                                                    <td>{{ $item->course_name }}</td>


                                                                    <td>


                                                                            <button
                                                                                class="btn btn-outline-info  btn-sm waves-effect waves-light"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#courseEditModal"
                                                                                data-courseid="{{ $item->course_id }}"
                                                                                data-course_name="{{ $item->course_name }}"
                                                                               >Edit</button>

                                                                            <a href="{{ url('/deleteCourse') . $item->course_id }}"
                                                                                class="btn btn-outline-danger btn-sm waves-effect waves-light">Delete</a>

                                                                    </td>


                                                                </tr>
                                                            @endforeach
                                                        @endif
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

                    <!-- Start course add model -->
                    <div id="customerAddModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Add Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('addCourse') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}



                                        <div class="mb-3">
                                            <label for="" class="form-label">Course Name</label>
                                            <input type="text" class="form-control" id="course_name"
                                                name="course_name" required>
                                        </div>



                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Save
                                            </button>
                                            <button type="button"
                                                class="btn btn-outline-danger waves-effect waves-light"
                                                data-bs-dismiss="modal">Close</button>

                                        </div>

                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                    {{--        End course add model --}}

                    {{--        Start course edit model --}}
                    <div id="courseEditModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="courseEditModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('editCourse') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="course_id" name="course_id"
                                            hidden>





                                        <div class="mb-3">
                                            <label for="" class="form-label">Course Name</label>
                                            <input type="text" class="form-control" id="course_name"
                                                name="course_name" required>
                                        </div>







                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Save
                                            </button>
                                            <button type="button"
                                                class="btn btn-outline-danger waves-effect waves-light"
                                                data-bs-dismiss="modal">Close</button>

                                        </div>


                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                    {{-- End course edit model --}}

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

            <script>
                $('#courseEditModal').on('show.bs.modal', function(event) {


                    let button = $(event.relatedTarget)
                    let course_id = button.data('courseid')
                    let course_name = button.data('course_name')

                    let modal = $(this)
                    modal.find('.modal-body #course_id').val(course_id);
                    modal.find('.modal-body #course_name').val(course_name);

                })
            </script>



        </body>

        </html>
    @else
        @include('Layout.notValidateUser')
    @endif
@else
    @include('Layout.noUser')
@endif
