<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class=" container-fluid">
  <div class=" container-fluid">
              <div class="row">
                  <div class="col-md-12 pt-3">
                      <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-dark text-underline-hover">
                                  Dashboard</a>
                          <li class="breadcrumb-item"><a href="/logbook" class="text-dark text-underline-hover">
                                  Logbook</a>
                          </li>
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Add Report</li>
                      </ol>
                  </div>
              </div>
            </div>
        </div>

<div class="container mx-auto">
    <div class="row">
      <!-- <div class="col-md-6 offset-md-3 mt-5 mb-5"> -->
      <!-- <div class="shadow-lg"> -->
        <div class="card px-2 py-2 bg-light">
          <div class="row class">
          <div class="card-body">
            <h2 class="text-center">Add Report</h2> 
            <?php if(session()->get('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>
              <div class="row">
          <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <?=csrf_field()?>
              <div class="mb-3">
                <label class="form-label float-start">Date Of Task</label>
                  <input type="date" id="date" class="form-control" name="tdate" placeholder="Date" value="<?=date('Y-m-d')?>" max="<?=date("Y-m-d")?>" required>
                  <div class="invalid-feedback">Please enter your Date.</div>
              </div>
              <div class="mb-3">
                <label class="form-label float-start">Task Activity</label>
                  <input type="text" name="tname" placeholder="Task Activity Name"  class="form-control" required>
                  <div class="invalid-feedback">Please enter your Task Actvity.</div>
              </div>
              <div class="mb-3">
                <label class="form-label float-start">Task Description</label>
                  <input type="text" name="tdesc" placeholder="Description of Task"  class="form-control" style="height: 100px" required>
                  <div class="invalid-feedback">Please enter your Task Description.</div>
              </div>
              <div class="mb-3">
                <label class="form-label float-start">Task File/Image <i class="text-muted">(Only PNG/JPEG/PDF)</i><label class="text-muted"></label></label> 
                  <input type="file" class="form-control" name="tpic" placeholder="Picture" required>
                  <div class="invalid-feedback">Enter if you have one.</div>
              </div>
              <div class="d-grid mb-1">
                <button type="submit" class="btn btn-primary btn-block">Add Task Report</button>
              </div>
            </form>
          </div>
        </div>
      </div>
          <!-- </div> -->
  </div>

<script>
  document.getElementById("date").addEventListener("keydown", function(event) {
  event.preventDefault();
  // other code here
});

</script>

<?=$this->endsection()?>