<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class=" container-fluid">
  <div class=" container-fluid">
              <div class="row">
                  <div class="col-md-12 pt-3">
                      <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                          <li class="breadcrumb-item"><a href="/dashboard" class="text-dark text-underline-hover">
                                  Dashboard</a>
                          </li>
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page"> Student's Date Edit</li>
                      </ol>
                  </div>
              </div>
            </div>
        </div>

<div class="container-fluid px-3 py-3">

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <?php if(session()->get('message')):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Data has been  <strong></strong> <?=session()->getFlashdata('message');?> </strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif;?>
    </div>
  </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Student's Date Edit</h1>

<?php foreach($student as $s):?>
<!-- Modal Visit Date -->
<div class="modal fade" id="Modal<?=$s['internid']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Visit Date (<?=$s['studentid'];?>)</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="/intern/update/visit/<?=$s['internid']?>" method="post">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Visit Date</label>
                    <input type="date" class="form-control" id="date" placeholder="Visit Date" name="visitdate" value="<?=$s['visitdate'];?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
      </div>
    </div>
  </div>
</div>
<?php endforeach?>

<?php foreach($student as $s):?>
<!-- Modal Report Date-->
<div class="modal fade" id="exampleModal<?=$s['internid']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Report Submission Date (<?=$s['studentid'];?>)</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="/intern/update/report/<?=$s['internid']?>" method="post">
              <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Report Date</label>
                    <input type="date" class="form-control" id="date" placeholder="Report Date" name="reportdate" value="<?=$s['reportdate'];?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
      </div>
    </div>
  </div>
</div>
<?php endforeach?>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student ID</th>
      <th scope="col">Name</th>
      <th scope="col">Visiting Date</th>
      <th scope="col">Report Submission Date</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php if(empty($student)):?>
      <tr>
        <td colspan= "5" class="text-center">Data is unavailable</td>
      </tr>
      <?php endif;?>
    <?php $bil=1;?>
<?php foreach($student as $s):?>
    <tr>
      <th scope="row"><?=$bil++;?></th>
      <td><?=$s['studentid'];?></td>
      <td><?=$s['sname'];?></td>
      <td>
        <?=date('d-m-Y',strtotime($s['visitdate']));?>
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#Modal<?=$s['sid']?>"><i class="bi bi-pencil"></i></button>
                                    
      </td>
      <td><?=date('d-m-Y',strtotime($s['reportdate']));?><button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$s['sid']?>"><i class="bi bi-pencil"></i></td>
      <!-- <td><a href="/student/edit/<?=$s['sid']?>"  class="btn btn-primary"><i class="bi bi-pencil"></i></a> -->
        <!-- <form action="/student/delete/<?=$s['sid']?>" method="post" class="d-inline">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you wanted to delete this student?')"><i class="bi bi-trash"></i></button>
        </form> -->
        <!-- <a href="/student/edit/<?=$s['sid']?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a> -->
    </td>
    </tr>
<?php endforeach;?>
  </tbody>
</table>


        </div>
    </div>
</div>
</div>



<?=$this->endsection()?>