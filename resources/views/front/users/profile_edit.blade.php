@extends('layouts.app')

@section('content')
@include('front.layouts.navbar')

<div class="bg-secondary">
  <div class="container">
    <div class="row">
      <!-- left sidebar -->
      @include('front.sidebar.left')

      <div class="col-md-6 bg-white">
        @include('layouts.errors-and-messages')
        <h4 class="mt-4"><strong>Profile</strong></h4>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" value="{{ $user->username }}" placeholder="Your username" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">E-Mail</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputPassword3" value="{{ $user->email }}" placeholder="E-Mail" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Birthday</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ $user->dob }}" placeholder="Birthday" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ $user->gender }}" placeholder="Birthday" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Profile Picture</label>
            <div class="col-sm-10">
              <input type="file" name="avatar" class="form-control" accept="image/*">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
            </div>
          </div>
        </form>

        <hr>
        <h4 class="mt-4"><strong>Change Password</strong></h4>
        <form class="mt-4" method="POST" action="{{ route('profile.change-password') }}">
          @csrf
          <div class="form-group row">
            <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
            <div class="col-sm-10">
              <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Enter your current password">
            </div>
          </div>
          <div class="form-group row">
            <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="new_password" placeholder="Enter your new password">
            </div>
          </div>
          <div class="form-group row">
            <label for="confirm_new_password" class="col-sm-2 col-form-label">Confirm New Password</label>
            <div class="col-sm-10">
              <input type="password" name="password_confirmation" class="form-control" id="confirm_new_password" placeholder="Enter your new password again">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-success"><i class="fa fa-key"></i> Change Password</button>
            </div>
          </div>
        </form>

          <account-deletion-alert></account-deletion-alert>
      </div>

      <!-- right sidebar -->
      @include('front.sidebar.right')
    </div>
  </div>
</div>
@stop
