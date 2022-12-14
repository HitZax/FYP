<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<?php if($this->session->role == "Student"):?>
  <div class=" container-fluid">
    <div class=" container-fluid">
                <div class="row">
                    <div class="col-md-12 pt-3">
                        <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Dashboard</li>
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

              <div><label class="form-label float-start">Task File or Image:</label>
                <!-- <div class="offset-md-3"> -->
                   <!-- <img src="/asset/img/task/<?=$task['tpic']?>" target="_blank" height="50%" width="50%"></img> -->
                   <a href="/asset/img/task/<?=$task['tpic']?>" target="_blank"> View File</a>
                </div>
              </div>          
            </form>
            
          </div>
        </div>
      </div>
          <!-- </div> -->
  </div>

<?=$this->endsection()?>