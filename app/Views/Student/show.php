<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

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
        <div class="col-md-12">
          <!-- Button trigger modal -->
          <h1 class="h2">Student</h1>
          <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            New Student
          </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Insert New Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="/student" method="post">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="studentid" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Student ID" name="studentid" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="program" class="form-label">Programme</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Course" name="program" required>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
      <th scope="col">Programme</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php $bil=1;?>
<?php foreach($student as $s):?>
    <tr>
      <th scope="row"><?=$bil++;?></th>
      <td><?=$s['studentid'];?></td>
      <td><?=$s['sname'];?></td>
      <td><?=$s['sprogram'];?></td>
      <td>
        <a href="/student/edit/<?=$s['sid']?>"  class="btn btn-secondary"><i class="bi bi-pencil"></i></a>
        <form action="/student/delete/<?=$s['sid']?>" method="post" class="d-inline">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you wanted to delete this student?')"><i class="bi bi-trash"></i></button>
        </form>
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