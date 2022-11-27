@extends('layouts.blank')

@section('content')

    <link href="/assets/css/login.css" rel="stylesheet">


    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Login</h5>

            

                        <form enctype="multipart/form-data" method="POST" action="{{Route('login')}}">

                            @csrf

                            <div class="form-floating mb-3">
                                <input name="email" type="text" class="form-control" id="floatingInputEmail" placeholder="name@example.com">
                                <label for="floatingInputEmail">Email address</label>
                            </div>

                            <div class="form-floating mb-5">
                                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>


                            <div class="d-grid mb-4">
                                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Login</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
