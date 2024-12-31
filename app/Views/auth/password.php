<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Forgot Password | LS </title>
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
                        <div class="text-center"> <img src="/asset/uniten.png" alt="" class="img"></div>
                        <h2 class="float-start text-center">Online Logbook System (OLS)</h2> 
                        <h6 class="text-center text-muted">Password Reset</h6>
                            <div class="card-body">
                            <?php if(session()->getFlashdata('msg')):?>
                            <div class="alert alert-warning">
                                <?= session()->getFlashdata('msg') ?>
                            </div>
                            <?php endif;?>
                            </div>
                        <form action="/auth/sendResetLink" method="POST">
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
                            </div>
                            <div class="d-grid mt-3 mb-1">
                                <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
                            </div>
                        </form>
                        <div class="row mt-3">
                            <h6 class="">Remembered it? <span><a href="/login">Back to Login</a></span></h6>
                        </div>          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>