@extends('user.user_master')


@section('user')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<div class="row" style="padding: 20px;">
  <div class="col-md-6">
    <h3>Change Password</h3>
    <form method="POST" action="{{ route('password.update') }}" >
      @csrf

      <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input class="form-control" name="oldpassword" type="password" id="current_password">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input class="form-control" name="password" type="password" id="password">
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input class="form-control" name="password_confirmation" type="password" id="password_confirmation">
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection