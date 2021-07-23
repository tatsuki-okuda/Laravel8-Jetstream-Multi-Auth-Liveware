@extends('user.user_master')


@section('user')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<div class="row" style="padding: 20px;">
  <div class="col-md-6">
    <form method="POST" action="{{ route('user.profile.update') }}"  enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <img id="showImage" src="{{ ( !empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg') }}" style="width: 100px; height: 100px;">
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Default file input example</label>
        <input class="form-control" name="profile_photo_path" type="file" id="image">
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">User Name</label>
        <input type="text" name="name" class="form-control" value="{{ old($user->name, $user->name) }}" >
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" value="{{ old($user->email, $user->email) }}" >
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#image').change(function(e){
      let reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files[0]);
    })
  })
</script>

@endsection