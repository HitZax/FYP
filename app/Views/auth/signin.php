<!-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Register Student | LS </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>

  <style>
    body{
      /* background-color:#F5F5F5; */
      background-image: url("public\asset\bgloginimg.jpg");

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
          <h6 class="text-muted">Create your account to login to the system</h6>
        </div>
        <form class="needs-validation" novalidate>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label float-start">Full Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Full Name" required>
              <div class="invalid-feedback">Please enter your Full Name.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label float-start">Student ID</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Student ID" required>
              <div class="invalid-feedback">Please enter your Student ID.</div>
          </div>
          <div class="mb-3">
            <label for="program" class="form-label float-start">Programme</label>
            <select class="form-select" aria-label="Default select example" name="program" required>
                      <?php /*foreach($program as $p):?>
                        <option value="<?=$p['pname']?>"> <?=$p['pname']?></option>
                      <?php endforeach;*/?>
                    </select>
          </div>
          <div class="invalid-feedback">Please your Program.</div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label float-start">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
              <div class="invalid-feedback">Please enter your Password</div>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
          </div>
        </form>

        <div class="row mt-2 mb-4">
          <h6>Do You Have an account? <span><a href="/login" @click="analyticEvent('Authentication', 'Click', 'Register button on login page')">Login</a></span></h6>
              
        </div>
          
    
      </div>
    </div>
  </div>



<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  </body>
</html> -->

<!doctype html>
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
                
                <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-warning">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>
                <form action="<?php echo base_url(); ?>/SigninController/loginAuth" method="post">
                    <div class="form-group mb-3">
                        <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control" >
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
</html>