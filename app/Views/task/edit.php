<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class=" container-fluid">
  <div class=" container-fluid">
              <div class="row">
                  <div class="col-md-12 pt-3">
                      <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                        <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Dashboard</li>
                          <li class="breadcrumb-item"><a href="/logbook" class="text-dark text-underline-hover">
                                  Logbook</a>
                          </li>
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Edit Report</li>
                      </ol>
                  </div>
              </div>
            </div>
        </div>

<div class="container mx-auto">
    <div class="row">
      <!-- <div class="col-md-6 offset-md-3 mt-5 mb-5"> -->
      <!-- <div class="shadow-lg"> -->
        <div class="card mb-5 px-2 py-2 bg-light">
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
              <div class="mb-3">
              <div><label class="form-label float-start">Task File or Image: </label></div>
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit File</button>
                <!-- <div class="offset-md-3"> -->
                   <!-- <img src="/asset/img/task/<?=$task['tpic']?>" target="_blank" height="50%" width="50%"></img> -->
                   <a href="/asset/img/task/<?=$task['tpic']?>" target="_blank"> View File</a>
                  </div>
                </div> 
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Insert File Or Image</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="post" action="" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="mb-2">
                    <label class="form-label">File Or Image</label>
                </div>
                <div class="mb-2"><input type="file" name="tpic " multiple>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" value="Upload">Upload</button>
        </form> 
      </div>
    </div>
  </div>
</div>

  <script>
  document.getElementById("date").addEventListener("keydown", function(event) {
  event.preventDefault();
  // other code here
});

</script>

<?=$this->endsection()?>