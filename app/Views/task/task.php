<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<form action="/register" method="post">
          <div class="mb-3">
            <label class="form-label float-start">Full Name</label>
              <input type="text" name="name" placeholder="Full name"  class="form-control" required>
              <div class="invalid-feedback">Please enter your Full Name.</div>
          </div>

          <div class="mb-3">
            <label class="form-label float-start">Student ID</label>
              <input type="text" class="form-control" name="studentid" placeholder="Student ID" required>
              <div class="invalid-feedback">Please enter your Student ID.</div>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label float-star">Email</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" required>
              <div class="invalid-feedback">Please enter your Email.</div>
          </div>

<?=$this->endsection()?>