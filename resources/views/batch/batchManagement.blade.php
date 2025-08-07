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
            <title>Admin | CBBS | Batch Management</title>


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
                                        <h4 class="mb-sm-0 font-size-18">Batch</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Batch</a>
                                                </li>
                                                <li class="breadcrumb-item active">Batch Management</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                                <div class="row">
                                    <div class="col-md-3">
                                        <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                            data-bs-target="#customerAddModal">Add Batch</button>


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

                                                            <th>Batch No</th>
                                                            <th>Batch Name</th>
                                                            <th>Started Date</th>
                                                            <th>Graduation Date</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if (!empty($data))
                                                            @foreach ($data as $item)
                                                                <tr>
                                                                    <td>{{ $item->batch_no }}</td>
                                                                    <td>{{ $item->batch_name }}</td>
                                                                    <td>{{ $item->year_month }}</td>
                                                                    <td>{{ $item->graduation_date }}</td>


                                                                    <td>


                                                                            <button
                                                                                class="btn btn-outline-info  btn-sm waves-effect waves-light"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#batchEditModal"
                                                                                data-batchid="{{ $item->batch_id }}"
                                                                                data-batchno="{{ $item->batch_no }}"
                                                                                data-batch_name="{{ $item->batch_name }}"
                                                                                data-yearmonth="{{ $item->year_month }}"
                                                                                data-graduationdate="{{ $item->graduation_date }}"
                                                                               >Edit</button>

                                                                            <a href="{{ url('/deleteBatch') . $item->batch_id }}"
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

                    <!-- Start batch add model -->
                    <div id="customerAddModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Add Batch</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('addBatch') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}


                                        <div class="mb-3">
                                            <label for="" class="form-label">Batch NO</label>
                                            <input type="text" class="form-control" id="batch_no"
                                                name="batch_no" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Batch Name</label>
                                            <input type="text" class="form-control" id="batch_name"
                                                name="batch_name" required>
                                        </div>

                                       
                                        <div class="mb-3">
                                            <label for="year_month" class="form-label">Select Started Date</label>
                                            <input type="date" class="form-control" id="year_month" name="year_month">
                                        </div>

                                        <div class="mb-3">
                                            <label for="graduation_date" class="form-label">Select Graduation Date</label>
                                            <input type="date" class="form-control" id="graduation_date" name="graduation_date">
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
                    {{--        End batch add model --}}

                    {{--        Start batch edit model --}}
                    <div id="batchEditModal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="batchEditModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Batch</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('editBatch') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="text" class="form-control" id="batch_id" name="batch_id"
                                            hidden>


                                            <div class="mb-3">
                                                <label for="" class="form-label">Batch NO</label>
                                                <input type="text" class="form-control" id="batch_no"
                                                    name="batch_no" required>
                                            </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Batch Name</label>
                                            <input type="text" class="form-control" id="batch_name"
                                                name="batch_name" required>
                                        </div>


                                        <div class="mb-3">
                                            <label for="year_month" class="form-label">Select Started Date</label>
                                            <input type="date" class="form-control" id="year_month" name="year_month">
                                        </div>

                                        <div class="mb-3">
                                            <label for="graduation_date" class="form-label">Select Graduation Date</label>
                                            <input type="date" class="form-control" id="graduation_date" name="graduation_date">
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
                    {{-- End batch edit model --}}

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
                $('#batchEditModal').on('show.bs.modal', function(event) {


                    let button = $(event.relatedTarget)
                    let batch_id = button.data('batchid')
                    let batch_no = button.data('batchno')
                    let batch_name = button.data('batch_name')
                    let year_month = button.data('yearmonth')
                    let graduation_date = button.data('graduationdate')

                    let modal = $(this)
                    modal.find('.modal-body #batch_id').val(batch_id);
                    modal.find('.modal-body #batch_no').val(batch_no);
                    modal.find('.modal-body #batch_name').val(batch_name);
                    modal.find('.modal-body #year_month').val(year_month);
                    modal.find('.modal-body #graduation_date').val(graduation_date);

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
