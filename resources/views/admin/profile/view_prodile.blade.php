@extends('admin.admin_master')


@section('admin')

<div class="card" style="width: 18rem;">
  <img src="{{ ( !empty($admin->profile_photo_path)) ? url('upload/admin_images/'.$admin->profile_photo_path) : url('upload/no_image.jpg') }}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Admin Name : {{ $admin->name }}</h5>
    <p class="card-text">Admin Email : {{ $admin->email }}</p>
    <a href="{{ route('admin.edit') }}" class="btn btn-primary">Edit Profile</a>
  </div>
</div>


@endsection