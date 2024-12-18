<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12 pt-3">
            <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                <li class="breadcrumb-item">
                    <a href="<?= $this->session->role == 'Admin' ? '/admin/dashboard' : '/dashboard' ?>" class="text-dark text-underline-hover">
                        <?= $this->session->role == 'Admin' ? 'Admin Dashboard' : 'Dashboard' ?>
                    </a>
                </li>
                <?php if($this->session->role == "Admin"):?>
                <li class="breadcrumb-item">
                    <a href="javascript:history.back()" class="text-dark text-underline-hover">
                        List
                    </a>
                </li>
                <?php endif ?>
                <li class="breadcrumb-item active text-dark text-muted" aria-current="page">Edit Profile</li>
            </ol>
        </div>
    </div>
</div>

<div class="container mx-auto">
    <div class="row">
        <div class="card px-2 py-2 bg-light">
            <div class="row mb-3">
                <div class="card-body">
                    <h3 class="text-center mb-3">
                        <?= $this->session->role == 'Admin' ? 'Admin Edit: ' : 'Edit Profile: ' ?><?=$user['fullname']?>
                    </h3>
                    <div class="row">
                        <?php if (session()->get('message')): ?>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?= session()->get('message') ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif ?>

                        <?php if($this->session->role != "Admin"):?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/profile/edit/<?=$user['id']?>" method="post">
                                        <?php if ($this->session->role == 'Student'): ?>
                                            <div class="mb-3">
                                                <label for="studentid" class="form-label">Student ID <i class="text-muted">(View Only)</i></label>
                                                <input type="text" class="form-control" id="studentid" placeholder="Your Student ID" name="studentid" readonly value="<?=$user['studentid']?>">
                                            </div>
                                        <?php endif ?>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name <i class="text-muted">(View Only)</i></label>
                                            <input type="text" class="form-control" id="name" placeholder="Name" name="fullname" readonly value="<?=$user['fullname']?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?=$user['email']?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required oninput="checkPassword()">
                                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()"><i class="bi bi-eye"></i></button>
                                            </div>
                                            <div id="passwordHelp" class="form-text">
                                                <ul>
                                                    <li id="length" class="invalid">At least 8 characters</li>
                                                    <li id="lowercase" class="invalid">At least 1 lower case letter</li>
                                                    <li id="uppercase" class="invalid">At least 1 upper case letter</li>
                                                    <li id="number" class="invalid">At least 1 number</li>
                                                    <li id="special" class="invalid">At least 1 special character</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-grid mb-1">
                                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Edit Profile</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endif?>

                        <?php if($this->session->role == "Admin"):?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/profile/edit/<?=$user['id']?>" method="post">
                                        <?php if ($this->session->role == 'Admin' && !is_null($user['studentid'])): ?>
                                            <div class="mb-3">
                                                <label for="studentid" class="form-label">Student ID</label>
                                                <input type="text" class="form-control" id="studentid" placeholder="Student ID" name="studentid" value="<?=$user['studentid']?>">
                                            </div>
                                        <?php endif ?>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Name" name="fullname" value="<?=$user['fullname']?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?=$user['email']?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="Uni10pass!" required oninput="checkPassword()">
                                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()"><i class="bi bi-eye"></i></button>
                                            </div>
                                            <div id="passwordHelp" class="form-text">
                                                <ul>
                                                    <li id="length" class="invalid">At least 8 characters</li>
                                                    <li id="lowercase" class="invalid">At least 1 lower case letter</li>
                                                    <li id="uppercase" class="invalid">At least 1 upper case letter</li>
                                                    <li id="number" class="invalid">At least 1 number</li>
                                                    <li id="special" class="invalid">At least 1 special character</li>
                                                    <li id="noSpace" class="invalid">No Space Allowed</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-grid mb-1">
                                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Edit Profile</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endif?>

                        <script>
                            function togglePassword() {
                                var passwordField = document.getElementById('password');
                                var toggleButton = passwordField.nextElementSibling;
                                if (passwordField.type === 'password') {
                                    passwordField.type = 'text';
                                    toggleButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
                                } else {
                                    passwordField.type = 'password';
                                    toggleButton.innerHTML = '<i class="bi bi-eye"></i>';
                                }
                            }
                        
                            function checkPassword() {
                                var password = document.getElementById('password').value;
                                var length = document.getElementById('length');
                                var lowercase = document.getElementById('lowercase');
                                var uppercase = document.getElementById('uppercase');
                                var number = document.getElementById('number');
                                var special = document.getElementById('special');
                                var noSpace = document.getElementById('noSpace');
                                var submitBtn = document.getElementById('submitBtn');
                        
                                var isValid = true;
                        
                                // Check length
                                if (password.length >= 8) {
                                    length.classList.remove('invalid');
                                    length.classList.add('valid');
                                } else {
                                    length.classList.remove('valid');
                                    length.classList.add('invalid');
                                    isValid = false;
                                }
                        
                                // Check lowercase
                                if (/[a-z]/.test(password)) {
                                    lowercase.classList.remove('invalid');
                                    lowercase.classList.add('valid');
                                } else {
                                    lowercase.classList.remove('valid');
                                    lowercase.classList.add('invalid');
                                    isValid = false;
                                }
                        
                                // Check uppercase
                                if (/[A-Z]/.test(password)) {
                                    uppercase.classList.remove('invalid');
                                    uppercase.classList.add('valid');
                                } else {
                                    uppercase.classList.remove('valid');
                                    uppercase.classList.add('invalid');
                                    isValid = false;
                                }
                        
                                // Check number
                                if (/\d/.test(password)) {
                                    number.classList.remove('invalid');
                                    number.classList.add('valid');
                                } else {
                                    number.classList.remove('valid');
                                    number.classList.add('invalid');
                                    isValid = false;
                                }
                        
                                // Check special character
                                if (/[\W_]/.test(password)) {
                                    special.classList.remove('invalid');
                                    special.classList.add('valid');
                                } else {
                                    special.classList.remove('valid');
                                    special.classList.add('invalid');
                                    isValid = false;
                                }
                        
                                // Check for spaces
                                if (!/\s/.test(password)) {
                                    noSpace.classList.remove('invalid');
                                    noSpace.classList.add('valid');
                                } else {
                                    noSpace.classList.remove('valid');
                                    noSpace.classList.add('invalid');
                                    isValid = false;
                                }
                        
                                // Enable or disable the submit button
                                submitBtn.disabled = !isValid;
                            }
                        
                            function validatePassword() {
                                var password = document.getElementById('password').value;
                                var passwordPolicy = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])(?!.*\s).{8,}$/;
                        
                                if (!password.match(passwordPolicy)) {
                                    alert('Password does not meet the required policy: 8 characters minimum length, 1 lower case, 1 upper case, 1 number, 1 special character, and no spaces.');
                                    return false;
                                }
                                return true;
                            }
                        </script>
                        <style>
                            .valid {
                                color: green;
                            }
                            .invalid {
                                color: red;
                            }
                        </style>
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endsection()?>