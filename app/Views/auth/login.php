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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <div class="container mx-auto">
      <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">  
          <div class="shadow-lg">
            <div class="card px-2 py-2 bg-light">
              <div class="row">
                <div class="text-center"> 
                  <img src="/asset/uniten.png" alt="" class="img">
                </div>
                <h2 class="float-start mt-3 text-center">Online Logbook System (OLS)</h2> 
                <h6 class="text-center text-muted">Login into your account</h6>
              </div>
              <div class="card-body mt-3">
                <?php if(session()->getFlashdata('msg')):?>
                  <div class="alert alert-warning">
                    <?= session()->getFlashdata('msg') ?>
                  </div>
                <?php endif;?>
                <form action="/login" method="POST">
                  <?=csrf_field()?>
                  <div class="mb-3">
                    <input type="text" name="auth" placeholder="Student ID / Email" value="" class="form-control" required>
                    <div class="invalid-feedback">Please enter your Student ID / email.</div> 
                  </div>
                  <div class="mb-3 position-relative">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                    <button type="button" class="btn btn-outline-secondary position-absolute top-0 end-0" onclick="togglePassword()">
                      <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                    <div class="invalid-feedback">Please enter your Password</div> 
                  </div>
                  <div class="d-flex justify-content-center mb-3">
                    <div class="g-recaptcha" data-sitekey="6Lea9pAqAAAAAAdZPqzB-VFw4bwsI6f85OKZdC1H"></div>
                  </div>
                  <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                  </div>
                </form>
                <div class="row float-end">
                  <h6><span><a href="/password">Forgot Password?</a></span></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function togglePassword() {
        var passwordField = document.getElementById('password');
        var toggleIcon = document.getElementById('toggleIcon');
        if (passwordField.type === 'password') {
          passwordField.type = 'text';
          toggleIcon.classList.remove('bi-eye');
          toggleIcon.classList.add('bi-eye-slash');
        } else {
          passwordField.type = 'password';
          toggleIcon.classList.remove('bi-eye-slash');
          toggleIcon.classList.add('bi-eye');
        }
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
  </body>
</html>