<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container mx-auto mt-5">
    <div class="row">
      <!-- <div class="col-md-6 offset-md-3 mt-5 mb-5"> -->
      <!-- <div class="shadow-lg"> -->
        <div class="card px-2 py-2 bg-light">
          <div class="row class">
          <div class="card-body">
            <h2 class="text-center">Edit Report</h2> 
              <div class="row">
          <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <?=csrf_field()?>
              <div class="mb-3">
                <label class="form-label float-start">Date Of Task</label>
                  <input type="date" class="form-control" name="tdate" placeholder="Date" value="<?=$task['tdate']?>" max="<?=date("Y-m-d")?>" required>
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
              <div class="d-grid mb-1">
                <button type="submit" class="btn btn-primary btn-block">Edit File or Picture</button>
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

  <!-- Modal Report Date-->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Report Submission Date (<?=$s['studentid'];?>)</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="/intern/update/report/<?=$s['internid']?>" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label float-start">Task File or Image <label class="text-muted">(Please Reupload)</label></label> 
                  <input type="file" class="form-control" name="tpic" placeholder="Picture Reference" >
                  <div class="invalid-feedback">Enter if you have one.</div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
      </div>
    </div>
  </div>
</div> -->

  <script>
  document.getElementById("date").addEventListener("keydown", function(event) {
  event.preventDefault();
  // other code here
});

</script>

<?=$this->endsection()?>