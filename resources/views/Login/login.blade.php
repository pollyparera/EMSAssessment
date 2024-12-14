@extends('layouts.login')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-sm-12 m-auto">
      <form class="card auth_form" method="POST" action="{{route('get-login')}}">
        @csrf
        <div class="header">
          <h5>Event Management System</h5>
        </div>
        <div class="body">
          <div class="input-group mb-3">
            <select name="login_type" id="login_type" class="form-control">
              <option value="Speaker">Speaker</option>
              <option value="Reviewer">Reviewer</option>
            </select>
          </div>
          <div class="input-group mb-3 email_div">
            <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="alice.johnson@example.com"/>
            <div class="input-group-append">
              <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
            </div>
          </div>
          @error('email')
            <label class="error help-block">{{ $message }}</label>
          @enderror
          <div class="input-group mb-3 password_div">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="speaker@2024"/>
            <div class="input-group-append ">
              <span class="input-group-text"
                ><i class="zmdi zmdi-lock"></i></span>
            </div>
          </div>
            @error('password')
              <label class="error help-block">{{ $message }}</label>
            @enderror
          <input type="submit" name="sign-in" id="signin" value="Sign In" class="btn btn-primary waves-effect waves-light btn-block waves-effect waves-light"/>
        </div>
      </form>
    </div>
  </div>
</div>
<script type='text/javascript'>
$(function(){
  $.validator.addMethod(
    "customEmail",
    function(value, element) {
      return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
    },
    "Please enter a valid email address."
  );

  $(".auth_form").validate({
    rules: {
            email: {
                required: true,
                customEmail: true
            },
            password: {
                required: true
            }
        },
    errorPlacement: function(error, element) {
            if (element.attr("name") == "email" ){
                error.insertAfter(".email_div");
            }

            if (element.attr("name") == "password" ){
                error.insertAfter(".password_div");
            }
        },
    messages: {
            email: {
                required: "Please enter email"
            },
            password: {
                required: "Please enter password"
            }
        }
  })

  $("#login_type").change(function(){
    if($(this).val()=='Speaker'){
      $("#email").val('alice.johnson@example.com');
      $("#password").val('speaker@2024');
    }
    else{
      $("#email").val('reviewer1@gmail.com');
      $("#password").val('Reviewer@2024');
    }
  })
})
</script>
@endsection