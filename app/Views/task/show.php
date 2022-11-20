<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container mx-auto mt-5">
    <div class="row">
      <!-- <div class="col-md-6 offset-md-3 mt-5 mb-5"> -->
      <!-- <div class="shadow-lg"> -->
        <div class="card px-2 py-2 bg-light">
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
                <div>
                   <a href="/asset/img/task/<?=$task['tpic']?>" target="_blank"><h5>View Image</h5></a>
                </div>
              </div>          
            </form>
            
          </div>
        </div>
      </div>
          <!-- </div> -->
  </div>

<?=$this->endsection()?>