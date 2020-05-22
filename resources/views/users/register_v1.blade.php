@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-4 ">
                <img src="{{ asset('images/logo.png') }}" class="img img-responsive pt-5">
                <form class="mt-2" method="POST" action="{{ route('register') }}" novalidate>
                @csrf
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        name="username"
                        value="{{ old('username') }}"
                        id="username"
                        placeholder="Enter username"
                        required
                        autocomplete>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter E-Mail"
                        required>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="password">Password</label>
                        <a href="#"><i class="fa fa-eye"></i> Show</a>
                    </div>
                    <input type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="Password"
                        required
                        autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="password-confirm">Confirm Password</label>
                        <a href="#"><i class="fa fa-eye"></i> Show</a>
                    </div>
                    <input type="password"
                        name="password_confirmation"
                        class="form-control"
                        id="password-confirm"
                        placeholder="Password"
                        required
                        autocomplete="new-password">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Birthday</label>
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" name="month">
                                <?php $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.'); ?>
                                @foreach($months as $num => $name)
                                    <option value="{{ $num }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select class="form-control" name="day">
                                @foreach(range(1, 31) as $index => $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select class="form-control" name="year">
                                @foreach(range(1990, date('Y')) as $index => $value)
                                    <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Gender</label>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="radio" name="gender" id="male" value="M">
                            <label for="male">Male</label>
                        </div>

                        <div class="col-md-4">
                            <input type="radio" name="gender" id="female" value="F">
                            <label for="female">Female</label>
                        </div>

                        <div class="col-md-4">
                            <input type="radio" name="gender" id="other" value="O">
                            <label for="other">Other</label>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">City</label>
                    <select class="form-control" name="city_id">
                        <option value="1">Quezon City</option>
                    </select>
                  </div>

                  <div class="d-flex justify-content-between my-2">
                    <a href="/">< Back to Login</a>
                    <button type="submit" class="btn btn-success">Create Account</button>
                  </div>

                  <div class="py-4 text-center">
                      ©2020 All Rights Reserved. Bulong ® Cookie Preferences, Privacy, and Terms.
                  </div>
                </form>
            </div>

            <div class="col-md-8 px-5 mb-4">
                <img src="{{ asset('images/cat.png') }}" class="" width="100%">
                <h6>Latest Confessions:</h6><hr>
                @foreach($latestConfessions as $confession)
                    @include('partials.latest_confession')
                @endforeach

                <div class="d-flex justify-content-end">
                    <h6 class="mt-2 text-muted">Login or Sign Up to view more confessions</h6>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

