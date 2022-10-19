<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Register Student | LS </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/asset/css/style.css">
  <link rel="stylesheet" href="/asset/css/library.css">
  </head>

  <style>
    body{
      /* background-color:#F5F5F5; */
      /* background-image: url("/asset/bgloginimg.jpg"); */

    }

    .img{
      max-width: 200px;
    }
  </style>
  <body>

  <div class="container mx-auto">
    <div class="row">
      <div class="col-md-6 offset-md-3 pt-4 mt-5">  
        <div class="row mb-3">
          <img src="/asset\uniten logo.png" alt="" class="img">
          <h2 class="float-start">Good Morning!</h2> 
          <h6 class="text-muted">Create your lecturer account to login to the system</h6>
        </div>
        <form action="/register/lecturer/<?=$invitecode?>" method="post" autocomplete='off'>
          <div class="mb-3">
            <label class="form-label float-start">Full Name</label>
              <input type="text" name="name" placeholder="Full name"  class="form-control" required>
              <div class="invalid-feedback">Please enter your Full Name.</div>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label float-start">Email</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" required>
              <div class="invalid-feedback">Please enter your Email.</div>
          </div>

          <div class="mb-3">
            <label class="form-label float-start">Room Number</label>
              <input type="text" class="form-control" name="room" placeholder="Room Number" required>
              <div class="invalid-feedback">Please enter your Room Number.</div>
          </div>
     
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label float-start">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
              <div class="invalid-feedback">Please enter your Password</div>
          </div>
          <div class="mb-3">
          <div class="form-group mb-3">
          <label for="exampleInputPassword1" class="form-label float-start">Confirm Password</label>
                        <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control" >
                    
          </div>
          <div class="mb-3">
          <div class="form-group mb-3">
          <label for="exampleInputPassword1" class="form-label float-start">Invite Code</label>
                        <input type="text" name="invcode"  class="form-control" value="<?=$invitecode?>"  >
                    
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
          </div>
        </form>

        <div class="row mt-2">
          <h6>Already own an account? <span><a href="/login" @click="analyticEvent('Authentication', 'Click', 'Register button on login page')">Login</a></span></h6>
        </div>
          
        <div class="row mt-2 mb-4">
          <h6>Need an account for student? <span><a href="/register" @click="analyticEvent('Authentication', 'Click', 'Register button on login page')">Register</a></span></h6>
        </div>
    
      </div>
    </div>
  </div>