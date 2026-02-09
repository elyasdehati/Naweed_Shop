<!DOCTYPE html>
<html lang="fa">
    <head>

        <meta charset="utf-8" />
        <title>ورود | Naweed Online Shop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="پنل مدیریت فروشگاه آنلاین Naweed Online Shop"/>
        <meta name="author" content="Naweed"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-white">
        <!-- Begin page -->
        <div class="account-page">
            <div class="container-fluid p-0">
                <div class="row align-items-center g-0">

                    <div class="col-xl-5">
                        <div class="row">
                            <div class="col-md-7 mx-auto">
                                <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                                    <div class="mb-4 p-0">
                                        <a href="/" class="auth-logo">
                                            <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="Naweed Online Shop" class="mx-auto" height="28" />
                                        </a>
                                    </div>
    
                                    <div class="pt-0">
                                        <form action="{{ route('login') }}" method="POST" class="my-4">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="emailaddress" class="form-label">ایمیل</label>
                                                <input class="form-control" type="email" name="email" id="emailaddress" required placeholder="ایمیل خود را وارد کنید">
                                            </div>
                
                                            <div class="form-group mb-3">
                                                <label for="password" class="form-label">رمز عبور</label>
                                                <input class="form-control" type="password" name="password" id="password" required placeholder="رمز عبور خود را وارد کنید">
                                            </div>
                
                                            <div class="form-group d-flex mb-3">
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember">
                                                        <label class="form-check-label" for="checkbox-signin">مرا به خاطر بسپار</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 text-end">
                                                    <a class='text-muted fs-14' href="{{ route('password.request') }}">رمز عبور خود را فراموش کرده‌اید؟</a>                             
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary" type="submit"> ورود </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="account-page-bg p-md-5 p-4">
                            <div class="text-center">
                                <h3 class="text-dark mb-3 pera-title">پنل مدیریت فروشگاه آنلاین <br> Naweed Online Shop</h3>
                                <div class="auth-image">
                                    <img src="{{ asset('backend/assets/images/authentication.svg') }}" class="mx-auto img-fluid"  alt="تصویر ورود">
                                </div>
                                <p class="text-muted mt-3">لطفاً ایمیل و رمز عبور خود را برای ورود به پنل وارد کنید.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <!-- Vendor -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>

        <!-- App js-->
        <script src="{{ asset('backend/assets/js/app.js') }}"></script>
        
    </body>
</html>