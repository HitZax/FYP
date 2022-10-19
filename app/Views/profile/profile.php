<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="/profile/edit/<?=$user['id']?>" method="post">
            <?php if($this->session->role == "Student"):?>
                <div class="mb-3">
                    <label for="studentid" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Student ID" name="studentid" value="<?=$user['studentid']?>">
                </div>
                <?php endif?>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Name" name="fullname" value="<?=$user['fullname']?>">
                </div>
                <div class="mb-3">
                    <label for="program" class="form-label">Email</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Course" name="email" value="<?=$user['email']?>" required>
                </div>
                <div class="mb-3">
                    <label for="program" class="form-label">Password</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Course" name="password" value="<?=$user['password']?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?=$this->endsection()?>