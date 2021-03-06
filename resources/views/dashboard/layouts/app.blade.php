{{-- @php
    use App\Models\Auth\Module;
    use App\Models\Auth\Permission;
@endphp --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('images\favicon.png')}}" type="image/x-icon">


    <title>
        @yield('title')
    </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.1/dist/simple-notify.min.css" />

    @stack('css')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css?v=1') }}">

</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="{{route('dashboard')}}">eMedical System</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        {{-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control form-control-sm" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form> --}}
        <!-- Navbar-->
        <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <form hidden id="logout-form" method="post" action="{{route('logout')}}">
                            @csrf</form>
                                <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{route('logout')}}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="{{route('dashboard')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        @can ('superuser.index')
                        {{-- <div class="sb-sidenav-menu-heading">User Management</div> --}}
                        {{-- Users --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#superuser" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                            Super Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='superuser.index' || Route::currentRouteName()=='superuser.create') ? 'show' :''}}" id="superuser" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('superuser.index')}}">All Users</a>
                                @can('superuser.create')
                                <a class="nav-link" href="{{route('superuser.create')}}">Add User</a>
                                @endcan
                                @can('superuser.index')
                                <a class="nav-link" href="{{route('company.index')}}">Company Setup</a>
                                @endcan

                            </nav>
                        </div>
                        @endcan


                        @can('users.index')
                        {{-- Roles --}}
                        @can('role.index')
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#roles" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-unlock-alt"></i></div>
                            Roles Management
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='role.index' || Route::currentRouteName()=='role.create') ? 'show' :''}}" id="roles" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('role.index')}}">All Roles</a>
                                @can('role.create')
                                <a class="nav-link" href="{{route('role.create')}}">Add Role</a>
                                @endcan
                            </nav>
                        </div>
                        @endcan

                        {{-- <div class="sb-sidenav-menu-heading">User Management</div> --}}
                        {{-- Users --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                            Users Management
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='users.index' || Route::currentRouteName()=='users.create') ? 'show' :''}}" id="users" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('users.index')}}">All Users</a>
                                @can('users.create')
                                <a class="nav-link" href="{{route('users.create')}}">Add User</a>
                                @endcan

                            </nav>
                        </div>

                        @endcan



                        {{-- {{(Route::currentRouteName()=='room.edit') ? 'show' :''}} --}}

                        @can('room.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rooms" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-flask"></i></div>
                            Room Management
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='room.index' || Route::currentRouteName()=='room.create') ? 'show' :''}}" id="rooms" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                @can ('room.index')
                                <a class="nav-link" href="{{route('room.index')}}">All Rooms</a>
                                @endcan

                                @can ('room.all_booking')
                                <a class="nav-link" href="{{route('room.all_booking')}}">All Booking</a>
                                @endcan

                                @can ('room.booking')
                                <a class="nav-link" href="{{route('room.booking')}}">Add Booking</a>
                                @endcan

                                @can ('room.create')
                                <a class="nav-link" href="{{route('room.create')}}">Add Room</a>
                                @endcan
                            </nav>
                        </div>
                        @endcan

                        @can('blood.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bloods" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-tint" aria-hidden="true"></i></div>
                            Blood Management
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='blood.index' || Route::currentRouteName()=='blood.create') ? 'show' :''}}" id="bloods" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('blood.index')}}">All Bloods</a>
                                <a class="nav-link" href="{{route('blood.create')}}">Add Blood</a>
                            </nav>
                        </div>
                        @endcan

                        @can('patient.index')
                        {{-- <div class="sb-sidenav-menu-heading">Patients Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#patients" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="nav-icon fas fa-procedures"></i></div>
                            Patients
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='patient.index' || Route::currentRouteName()=='patient.create') ? 'show' :''}}" id="patients" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('patient.index')}}">All Patients</a>
                                <a class="nav-link" href="{{route('patient.create')}}">Add Patient</a>
                            </nav>
                        </div>
                        @endcan


                        @can('appointment.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#appointments" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            Appointment
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='appointment.index' || Route::currentRouteName()=='appointment.create') ? 'show' :''}}" id="appointments" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('appointment.index')}}">All Appointment</a>
                                <a class="nav-link" href="{{route('appointment.create')}}">Add Appointment</a>
                            </nav>
                        </div>
                        @endcan


                        @can('testreport.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#testreports" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            Test & Report
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='testreport.index' || Route::currentRouteName()=='testreport.create') ? 'show' :''}}" id="testreports" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('testreport.index')}}">All Test List</a>
                                <a class="nav-link" href="{{route('testreport.index')}}">All Test & Reports</a>
                                <a class="nav-link" href="{{route('testreport.create')}}">Add Test & Report</a>
                            </nav>
                        </div>
                        @endcan



                        {{-- @can('appointment.index') --}}
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#prescriptions" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            Prescription
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="prescriptions" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('appointment.index')}}">All Prescription</a>
                                <a class="nav-link" href="{{route('appointment.create')}}">incomplete</a>
                            </nav>
                        </div>
                        {{-- @endcan --}}


                        @can('emergency.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#emergency" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            Emergency
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='emergency.index' || Route::currentRouteName()=='emergency.create') ? 'show' :''}}" id="emergency" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('product.index')}}">All Emergency</a>
                                <a class="nav-link" href="{{route('product.create')}}">Add Emergency</a>
                            </nav>
                        </div>
                        @endcan

                        @can('reception.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#receptions" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-heartbeat"></i></div>
                            Reception
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='reception.index' || Route::currentRouteName()=='reception.create') ? 'reception' :''}}" id="receptions" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('product.index')}}">Loading...</a>
                                <a class="nav-link" href="{{route('product.create')}}">Loading...</a>
                            </nav>
                        </div>
                        @endcan

                        @can('report.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reports" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Reports
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='report.index' || Route::currentRouteName()=='report.create') ? 'show' :''}}" id="reports" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('product.index')}}">All Reports</a>
                                <a class="nav-link" href="{{route('product.create')}}">Pending Report</a>
                            </nav>
                        </div>
                        @endcan

                        @can('billing.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#billings" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-credit-card"></i></div>
                            Billings
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='billing.index' || Route::currentRouteName()=='billing.create') ? 'show' :''}}" id="billings" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('product.index')}}">All Billing</a>
                                <a class="nav-link" href="{{route('product.create')}}">Loading...</a>
                                <a class="nav-link" href="{{route('product.create')}}">Loading...</a>
                                <a class="nav-link" href="{{route('product.create')}}">Loading...</a>
                            </nav>
                        </div>
                        @endcan


                        @can('laboratory.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laboratorys" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-flask"></i></div>
                            Laboratory
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{(Route::currentRouteName()=='laboratory.index' || Route::currentRouteName()=='laboratory.create') ? 'show' :''}}" id="laboratorys" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('product.index')}}">Loading...</a>
                                <a class="nav-link" href="{{route('product.create')}}">Loading...</a>
                            </nav>
                        </div>
                        @endcan

                        @can('setting.index')
                        {{-- <div class="sb-sidenav-menu-heading"> Appointment Management</div> --}}
                        <a class="nav-link collapsed" href="#">
                            <div class="sb-nav-link-icon"><i class="fa fa-cogs"></i></div>
                            Setting
                        </a>
                        @endcan


                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: <strong style="color: white;">{{Auth::user()->name}}</strong> </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('main')
            </main>
            <footer class="py-4 bg-light mt-auto pt-2">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; MH Kabir 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('demo/datatables-demo.js')}}"></script>
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.1/dist/simple-notify.min.js"></script>

    @stack('js')
    @include('partials.alert')
</body>

</html>