<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class="container mx-auto mt-5">
    <div class="row">
      <!-- <div class="col-md-6 offset-md-3 mt-5 mb-5"> -->
      <!-- <div class="shadow-lg"> -->
        <div class="card px-2 py-2 bg-light">
        <div class="row mb-3 class">

        <div class="card-body">
          <h2 class="text-center">Edit Profile</h2> 
          <div class="row">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="/profile/edit/<?=$user['id']?>" method="post">
                        <?php if($this->session->role == "Student"):?>
                            <div class="mb-3">
                                <label for="studentid" class="form-label">Student ID</label>
                                <input type="text" class="form-control" id="name" placeholder="Your Student ID" name="studentid" readonly value="<?=$user['studentid']?>">
                            </div>
                            <?php endif?>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Your Name" name="fullname" readonly value="<?=$user['fullname']?>">
                            </div>
                            <div class="mb-3">
                                <label for="program" class="form-label">Email</label>
                                <input type="text" class="form-control" id="name" placeholder="Your Email" name="email" value="<?=$user['email']?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="program" class="form-label">Password</label>
                                <input type="text" class="form-control" id="name" placeholder="Your Password" name="password" value="<?=$user['password']?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

</div>
</div>
</div>
</div>
</div>

<?=$this->endsection()?>