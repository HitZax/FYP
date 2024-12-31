<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Two-Factor Authentication</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/asset/css/login.css">
    <link rel="stylesheet" href="/asset/css/library.css">
  </head>
  <body>
    <div class="container mx-auto">
      <div class="row">
        <div class="col-md-6 offset-md-3 pt-4 mt-5">
          <div class="shadow-lg">
            <div class="card px-2 py-2 bg-light">
              <div class="row mb-3">
                <div class="text-center">
                  <img src="/asset/uniten.png" alt="" class="img">
                </div>
                <h2 class="text-center text-red mt-3">Two-Factor Authentication</h2>
                <h6 class="text-center text-muted">Please enter the 2FA code sent to your email</h6>
              </div>
                <?php if(session()->getFlashdata('msg')):?>
                  <div class="alert alert-warning">
                    <?= session()->getFlashdata('msg') ?>
                  </div>
                <?php endif;?>
              <form action="/verify-2fa" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                  <input type="text" class="form-control" id="twoFACode" placeholder="Enter your 2FA code" name="twoFACode" required autocomplete="off" pattern="\d{6}" maxlength="6">
                  <div class="invalid-feedback">Please enter a valid 6-digit 2FA code</div>
                </div>
                <div class="d-grid mb-3">
                  <button type="submit" class="btn btn-primary btn-block">Verify</button>
                </div>
              </form>
              <div class="row mt-2 mb-1">
                <h6 class="">Didn't receive a code? <span id="resendContainer"><a href="/resend-2fa-code" id="resendLink" class="hidden">Resend code</a></span></h6>
                <h6 class="">Not your account? <span><a href="/login">Back to Login</a></span></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</html>

<script>
  document.getElementById('twoFACode').addEventListener('input', function (e) {
    this.value = this.value.replace(/\D/g, '');
  });

  // Disable resend link for 3 minutes
  const resendLink = document.getElementById('resendLink');
  const resendContainer = document.getElementById('resendContainer');
  let resendTimeout = localStorage.getItem('resendTimeout');
  if (resendTimeout && new Date().getTime() < resendTimeout) {
    disableResendLink();
  } else {
    showResendLink();
  }

  resendLink.addEventListener('click', function (e) {
    e.preventDefault();
    fetch('/resend-2fa-code')
      .then(response => response.text())
      .then(data => {
        alert('A new 2FA code has been sent to your email.');
        disableResendLink();
        localStorage.setItem('resendTimeout', new Date().getTime() + 3 * 60 * 1000); // 3 minutes
      });
  });

  function disableResendLink() {
    resendLink.classList.add('hidden');
    let countdown = 180; // 3 minutes in seconds
    const interval = setInterval(() => {
      countdown--;
      resendContainer.textContent = `Resend code (${countdown}s)`;
      if (countdown <= 0) {
        clearInterval(interval);
        showResendLink();
        localStorage.removeItem('resendTimeout');
      }
    }, 1000);
  }

  function showResendLink() {
    resendLink.classList.remove('hidden');
    resendContainer.textContent = '';
    resendContainer.appendChild(resendLink);
  }
</script>

<style>
  .hidden {
    display: none;
  }
</style>