@php
    $id = session('id');
    $role = session('role');
@endphp

@if (!empty($id))

    @if (\Illuminate\Support\Facades\Auth::id() == $id && $role == 'Admin')

        <!doctype html>
        <html lang="en">

        <head>

            @include('Layout.appStyles')
            <title>Admin | CBBS | User Management</title>


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

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <form method="POST"
                                                action="{{ route('userAccessManagement.update', $user->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    @foreach ($branches as $branch)
                                                        <label class="me-2">
                                                            <input type="checkbox" name="permissions[]"
                                                                value="{{ $branch->branch_id }}"
                                                                {{ $user->permissions->pluck('permission')->contains($branch->branch_id) ? 'checked' : '' }}>
                                                            {{ $branch->branch_name }}
                                                        </label>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm">Update</button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- End Page-content -->

                            {{--    Footer --}}
                            @include('Layout.footer')
                            {{--    End Footer --}}

                        </div>
                        <!-- end main content-->

                    </div>
                </div>
            </div>
            <!-- END layout-wrapper -->
        </body>
        <!-- Right Sidebar -->
        @include('Layout.rightSidebar')
        <!-- /Right-bar -->

        <!-- JAVASCRIPT -->
        @include('Layout.appJs')


        </html>
    @else
        @include('Layout.notValidateUser')
    @endif
@else
    @include('Layout.notValidateUser')
@endif
