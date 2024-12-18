<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<?php if($this->session->role == "Student"):?>
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
                            <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Show Report</li>
                        </ol>
                    </div>
                </div>
              </div>
          </div>
<?php endif?>

<?php if($this->session->role == "Lecturer"):?>
<div class=" container-fluid">
  <div class=" container-fluid">
              <div class="row">
                  <div class="col-md-12 pt-3">
                      <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                        <li class=" breadcrumb-item active text-dark text-muted" aria-current="page"> Dashboard</li>
                        <li class=" breadcrumb-item active text-dark text-muted" aria-current="page"> Student's Logbook</li>
                          <li class="breadcrumb-item"><a href="/logbook/<?=$task['lbid']?>" class="text-dark text-underline-hover">
                                  Logbook Task List</a>
                          </li>
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Show Report</li>
                      </ol>
                  </div>
              </div>
            </div>
        </div>
<?php endif?>
        
<div class="container mx-auto">
    <div class="row">
      <!-- <div class="col-md-6 offset-md-3 mt-5 mb-5"> -->
      <!-- <div class="shadow-lg"> -->
        <div class="card mb-5 px-2 py-2 bg-light">
          <div class="row class">
          <div class="card-body">
            <h2 class="text-center">Show Report</h2> 
              <div class="row">
          <form action="/logbook/logbook" method="post" autocomplete="off" enctype="multipart/form-data">
            <?=csrf_field()?>
              <div class="mb-3">
                <label class="form-label float-start">Date Of Task</label>
                  <input type="date" class="form-control" name="tdate" placeholder="Date" value="<?=$task['tdate']?>" required readonly>
                  <div class="invalid-feedback">Please enter your Date.</div>
              </div>
              <div class="mb-3">
                <label class="form-label float-start">Task Activity</label>
                  <input type="text" name="tname" placeholder="Task Activity Name" value="<?=$task['tname']?>" class="form-control" required readonly>
                  <div class="invalid-feedback">Please enter your Task Actvity.</div>
              </div>
              <div class="mb-3">
                <label class="form-label float-start">Task Description</label>
                  <input type="text" name="tdesc" placeholder="Description of Task" value="<?=$task['tdesc']?>" class="form-control" style="height: 100px" required readonly>
                  <div class="invalid-feedback">Please enter your Task Description.</div>
              </div>
              <div class="mb-3">
                <label class="form-label float-start">Lecturer's Remarks</label>
                  <input type="text" name="tname" placeholder="Remarks left by lecturer" value="<?=$task['remark']?>" class="form-control" required readonly>
                  <div class="invalid-feedback">Please enter your Remarks</div>
              </div>

<div>
  <label class="form-label float-start">Task File/Image:</label>
  <div class="clearfix"></div>
  <button type="button" class="btn btn-secondary" onclick="toggleFile()">View <i class="bi bi-eye"></i></button>
  <div id="fileContainer" style="display: none; margin-top: 10px;">
    <?php
    $file_extension = pathinfo($task['tpic'], PATHINFO_EXTENSION);
    if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
      echo '<img src="/asset/img/task/'.$task['tpic'].'" alt="Task Image" style="max-width: 100%; height: auto;">';
    } elseif ($file_extension == 'pdf') {
      echo '<embed src="/asset/img/task/'.$task['tpic'].'" type="application/pdf" width="100%" height="600px" />';
    } else {
      echo '<a href="/asset/img/task/'.$task['tpic'].'" target="_blank">View File</a>';
    }
    ?>
  </div>
</div>
</div>
</form>

<script>
function toggleFile() {
  var fileContainer = document.getElementById('fileContainer');
  if (fileContainer.style.display === 'none') {
    fileContainer.style.display = 'block';
  } else {
    fileContainer.style.display = 'none';
  }
}
</script>

</div>
</div>
</div>
<!-- </div> -->
</div>

<?=$this->endsection()?>