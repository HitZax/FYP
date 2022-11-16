<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container mx-auto mt-5">
    <div class="row">
      <!-- <div class="col-md-6 offset-md-3 mt-5 mb-5"> -->
      <!-- <div class="shadow-lg"> -->
        <div class="card px-2 py-2 bg-light">
          <div class="row class">
          <div class="card-body">
            <h2 class="text-center">Task Edit Report</h2> 
              <div class="row">
          <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <?=csrf_field()?>
              <div class="mb-3">
                <label class="form-label float-start">Date Of Task</label>
                  <input type="date" class="form-control" name="tdate" placeholder="Date" value="<?=$task['tdate']?>" required>
                  <div class="invalid-feedback">Please enter your Date.</div>
              </div>
              <div class="mb-3">
                <label class="form-label float-start">Task Activity</label>
                  <input type="text" name="tname" placeholder="Task Activity Name" value="<?=$task['tname']?>" class="form-control" required>
                  <div class="invalid-feedback">Please enter your Task Actvity.</div>
              </div>
              <div class="mb-3">
                <label class="form-label float-start">Task Description</label>
                  <input type="text" name="tdesc" placeholder="Description of Task" value="<?=$task['tdesc']?>" class="form-control" style="height: 100px" required>
                  <div class="invalid-feedback">Please enter your Task Description.</div>
              </div>
              <div class="mb-3">
                <label class="form-label float-start">Picture Of Task <label class="text-muted">(If available)</label></label> 
                  <input type="file" class="form-control" name="tpic" placeholder="Picture Reference" >
                  <div class="invalid-feedback">Enter if you have one.</div>
              </div>
              <div class="d-grid mb-1">
                <button type="submit" class="btn btn-primary btn-block">Edit Task Report</button>
              </div>
            </form>
          </div>
        </div>
      </div>
          <!-- </div> -->
  </div>

<?=$this->endsection()?>