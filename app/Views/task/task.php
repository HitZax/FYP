<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container mx-auto mt-5">
    <div class="row">
      <!-- <div class="col-md-6 offset-md-3 mt-5 mb-5"> -->
      <!-- <div class="shadow-lg"> -->
        <!-- <div class="card px-2 py-2 bg-light"> -->
        <div class="row class">

        <div class="card-body">
          <h2 class="text-center">Task Form</h2> 
          <div class="row">

<form action="/register" method="post">
          <div class="mb-3">
            <label class="form-label float-start">Task Activity</label>
              <input type="text" name="tname" placeholder="Task Activity Name"  class="form-control" required>
              <div class="invalid-feedback">Please enter your Task Actvity.</div>
          </div>

          <div class="mb-3">
            <label class="form-label float-start">Task Description</label>
              <input type="text" name="tdesc" placeholder="Task Description"  class="form-control" required>
              <div class="invalid-feedback">Please enter your Task Description.</div>
          </div>


          <div class="mb-3">
            <label class="form-label float-start">Date Of Task</label>
              <input type="date" class="form-control" name="tdate" placeholder="Date" required>
              <div class="invalid-feedback">Please enter your Date.</div>
          </div>

          <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Comments</label>
</div>

          <!-- <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label float-star">Email</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" required>
              <div class="invalid-feedback">Please enter your Email.</div>
          </div> -->

          <div class="d-grid mb-1">
            <button type="submit" class="btn btn-primary btn-block">Add Task</button>
          </div>

          </div>
          </div>
          </div>
          <!-- </div> -->
          </div>

<?=$this->endsection()?>