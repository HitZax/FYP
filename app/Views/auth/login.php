<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Login | LS </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/login.css">
    <link rel="stylesheet" href="asset/css/library.css">

  </head>

 
  <body>

  <div class="container mx-auto">
    <div class="row">
      <div class="col-md-6 offset-md-3 mt-5">  
          <div class="shadow-lg">
            <div class="card px-2 py-2 bg-light">
              <div class="row">
                <div class="text-center"> <img src="/asset\uniten.png" alt="" class="img"></div>
                <h2 class="float-start mt-3 text-center">Online Logbook System (OLS)</h2> 
                <h6 class="text-center text-muted">Login into your account</h6>
              </div>

        <div class="card-body mt-3">
<?php if(session()->getFlashdata('msg')):?>
        <!-- <div class="container-fluid"> -->
            <div class="alert alert-warning">
                 <?= session()->getFlashdata('msg') ?>
              </div>
          <!-- </div> -->
<?php endif;?>
        <form action="/login" method="POST">
          <?=csrf_field()?>
          
          <div class="">
            <!-- <label for="exampleInputEmail1" class="form-label float-start">Student ID / Email</label> -->
            <input type="text" name="auth" placeholder="Student ID / Email" value="" class="form-control" required>
              <div class="invalid-feedback">Please enter your Student ID / email.</div> 
          </div>
        
          <div class="mt-3 mb-3">
            <!-- <label for="exampleInputPassword1" class="form-label float-start">Password</label> -->
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
               <div class="invalid-feedback">Please enter your Password</div> 
          </div>

          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>

        </form>

        <div class="row float-end">
        <h6 class=""><span><a href="/register" @click="analyticEvent('Authentication', 'Click', 'Register button on login page')">Forgot Password? </a></span></h6>
        </div>
          <h6 class="">Need an account for student? <span><a href="/register" @click="analyticEvent('Authentication', 'Click', 'Register button on login page')">Register</a></span></h6>
        </div>
          <div class="row mt-2 mb-2">
          <h6 class="">Need an account for lecturer? <span><a href="/register/lecturer" @click="analyticEvent('Authentication', 'Click', 'Register button on login page')">Register</a></span></h6>
          </div>
    
      </div>
          </div>
          </div>
          </div>
    </div>
  </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  </body>
</html>

<!-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Codeigniter Login with Email/Password Example</title>
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-5">
                
                <h2>Login in</h2>
                
                
                <form action="/login" method="post">
                    <div class="form-group mb-3">
                        <input type="text" name="auth" placeholder="StudentID or Email" value="" class="form-control" >
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" placeholder="Password" class="form-control" >
                    </div>
                    
                    <div class="d-grid">
                         <button type="submit" class="btn btn-success">Signin</button>
                    </div>     
                </form>
            </div>
              
        </div>
    </div>
  </body>
</html> -->