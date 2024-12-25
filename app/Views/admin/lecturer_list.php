<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class="container-fluid">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 pt-3">
        <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
          <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-dark text-underline-hover">Admin Dashboard</a></li>
          <li class="breadcrumb-item active text-dark text-muted" aria-current="page">Lecturer List</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="my-2 py-2 mt-2">Lecturer List</h1>
          <form class="d-flex my-2 my-lg-0" method="get" action="/admin/lecturer">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= isset($search) ? $search : '' ?>">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <a href="/register/lecturer" class="btn btn-outline-primary float-end">Add New Lecturer</a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Room</th>
                <th scope="col">Total Students</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php if(empty($lecturers)):?>
              <tr>
                <td colspan="5" class="text-center">No lecturers found</td>
              </tr>
              <?php else: ?>
                <?php foreach($lecturers as $lecturer): ?>
                <tr>
                  <td><?=$lecturer['lname'];?></td>
                  <td><?=$lecturer['lemail'];?></td>
                  <td><?=$lecturer['lroom'];?></td>
                  <td><?=$lecturer['total_students'];?></td>
                  <td>
                    <span style="color: <?= $lecturer['user_status'] == 'Active' ? 'green' : 'red' ?>;">
                        <?= $lecturer['user_status'] ?>
                    </span>
                  </td>
                  <td class="">
                    <a href="/profile/edit/<?=$lecturer['id'];?>" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#studentsModal<?=$lecturer['lid'];?>"><i class="bi bi-eye"></i></button>
                    <a href="#" class="btn btn-secondary btn-sm" onclick="confirmReset(<?=$lecturer['id'];?>)"><i class="bi bi-arrow-clockwise"></i></a>
                    <button class="btn btn-danger btn-sm" onclick="deleteLecturer(<?=$lecturer['lid'];?>)"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="studentsModal<?=$lecturer['lid'];?>" tabindex="-1" aria-labelledby="studentsModalLabel<?=$lecturer['lid'];?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="studentsModalLabel<?=$lecturer['lid'];?>">Students under <?=$lecturer['lname'];?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <ul>
                          <?php foreach($lecturer['students'] as $student): ?>
                            <li><?=$student['sname'];?> (<?=$student['studentid'];?>)</li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <?php endforeach; ?>
              <?php endif;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

<script>
function confirmReset(lecturerId) {
    if (confirm('Are you sure you want to reset this lecturer? This will change the status to active and delete the user active session.')) {
        window.location.href = '/admin/reset/' + lecturerId;
    }
}

function deleteLecturer(lid) {
  if (confirm('Are you sure you want to delete this lecturer?')) {
    window.location.href = '/admin/deleteLecturer/' + lid;
  }
}
</script>

<?=$this->endsection()?>