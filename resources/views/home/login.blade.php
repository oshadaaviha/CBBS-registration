<!doctype html>
<html lang="en">

@include('home.loginLayout')

<body>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 id="greetings" class="text-primary"></h5>


                                </div>
                            </div>
                            <div class="col-5 p-3 align-self-end">
                                <img src="assets/images/hem.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="auth-logo">
                            <a href="index.html" class="auth-logo-light">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/images/logo.png" alt="" class="rounded-circle" height="34">
                                            </span>
                                </div>
                            </a>

                            <a href="index.html" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="title ">
                                                <img src="assets/images/logo.png" alt=""height="50">
                                            </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <div class="p-2">
                                @if($errors->any())

                                <div class="container">
                                    <div class="alert alert-danger" role="alert">
                                        {{$errors->first()}}
                                    </div>
                                </div>
                            @endif
                            <form action="{{url('login')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="mb-3">
                                    <label for="username" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" id="email">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" name="password" id="password">

                                        <button class="btn btn-light " type="button" id="togglePassword" ><i class="mdi mdi-eye-outline"></i></button>

                                    </div>
                                </div>



                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                </div>



                            </form>
                        </div>

                    </div>

                <div class="mt-5 text-center">


                    <div>

                        <p>© <script>document.write(new Date().getFullYear())</script>  <img src="assets/images/logo.png" alt="" class="rounded-circle" height="50"> by <a href="https://barbaristaschool.com" class="success"> CBBS </a></p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- end account-pages -->

<script>


    var myDate = new Date();
    var hrs = myDate.getHours();

    var greet;

    if (hrs < 12)
      greet = 'Good Morning';
    else if (hrs >= 12 && hrs <= 17)
      greet = 'Good Afternoon';
    else if (hrs >= 17 && hrs <= 24)
      greet = 'Good Evening';

    document.getElementById('greetings').innerHTML =greet + ' !';
    </script>


    <script>
        const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');

      togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon

    });
        </script>
</body>
</html>
