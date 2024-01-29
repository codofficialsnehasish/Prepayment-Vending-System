@include("admin/dash_cut/login_header")

<body class="account-pages">
    <!-- Begin page -->
    <div class="accountbg" style="background: url('{{ asset('dashboard_assets/images/pipelines.jpg') }}');background-size: cover;background-position: center;"></div>
        <div class="wrapper-page account-page-full" style="background-color: #ffffffe3!important;right: 0 !important;left: unset;">
            <div class="card shadow-none"style="background-color: #ffffff00;">
                <div class="card-block">
                    <div class="account-box">
                        <div class="card-box shadow-none p-4">
                            <div class="p-2">
                                <div class="text-center mt-4">
                                    <a href="/" style="font-size:40px;font-weight: 600;letter-spacing: 4px;"><img src="{{ asset('/site_data_images')}}/{{get_logo()}}" alt="Logo"></a>
                                </div>
                                <h4 class="font-size-18 mt-2 text-center" style="color:black!important">Welcome Back !</h4>
                                <p class="text-muted text-center" style="color:black!important">Sign in to continue to {{ app_name() }}.</p>
                                @if(Session::has("msg"))
                                <!-- <h5 class="font-size-20" style="color:red;text-align:center;">{{Session::get("msg")}}</h5> -->
                                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Oh snap!</strong> {{Session::get("msg")}}.
                                </div>
                                @endif
                                <form class="mt-4" action="{{url('/checkuser')}}" method="post">
                                    @csrf
                                    <!-- <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username">
                                    </div> -->
                                    <div class="mb-3">
                                        <label class="form-label" for="email" style="color:black!important">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                                    </div> -->
                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword" style="color:black!important">Password</label>
                                        <input type="password" name="pass" class="form-control" id="userpassword" placeholder="Enter password">
                                    </div>
    
                                <div class="mb-3 row">
                                    <!-- <div class="col-sm-6">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customControlInline">
                                            <label class="form-check-label" for="customControlInline">Remember me</label>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-12 text-center">
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>

                                <!-- <div class="mb-3 mt-2 mb-0 row">
                                    <div class="col-12 mt-3">
                                        <a href="pages-recoverpw-2.html"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                    </div>
                                </div> -->

                            </form>

                    @include("admin/dash_cut/login_footer")