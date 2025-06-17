@extends('layouts.user')
@section('content')
    <section id="login-form" class="py-5">
        <div class="container-sm">
            <div class="row justify-content-center">
                <div class="col-lg-4 p-5 border shadow-sm">
                    <h5 class="text-uppercase mb-4">Login</h5>
                    <form id="form" method="POST" action="{{ route('login') }}" class="form-group flex-wrap">
                        <div class="col-12 pb-3">
                            <label class="d-none">Username or email address *</label>
                            <input type="text" name="name" placeholder="Username / email" class="form-control">
                        </div>
                        <div class="col-12 pb-3">
                            <label class="d-none">Password *</label>
                            <input type="text" name="email" placeholder="Password" class="form-control">
                        </div>
                        <div class="col-12 pb-3">
                            <label>
                                <input type="checkbox" required="">
                                <span class="label-body">Remember me</span>
                            </label>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary text-uppercase w-100">Log
                                in</button>
                            <p><a href="#">Lost your password?</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
