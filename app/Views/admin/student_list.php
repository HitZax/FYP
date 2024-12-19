<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class="container-fluid">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 pt-3">
        <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
          <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-dark text-underline-hover">Admin Dashboard</a></li>
          <li class="breadcrumb-item active text-dark text-muted" aria-current="page">Student List</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="my-2 py-2 mt-2">Student List</h1>
          <form class="d-flex my-2 my-lg-0" method="get" action="/admin/student">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= isset($search) ? $search : '' ?>">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <a href="/register" class="btn btn-outline-primary float-end">Add New Student</a>
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
                <th scope="col">Student ID</th>
                <th scope="col">Program</th>
                <th scope="col">Visiting Lecturer</th>
                <th scope="col">Action</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php if(empty($students)):?>
              <tr>
                <td colspan="5" class="text-center">No students found</td>
              </tr>
              <?php else: ?>
                <?php foreach($students as $student): ?>
                <tr>
                  <td><?=$student['sname'];?></td>
                  <td><?=$student['studentid'];?></td>
                  <td><?=$student['sprogram'];?></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#assignLecturerModal" data-sid="<?=$student['sid'];?>">
                        <i class="bi bi-person-fill"></i>
                    </button>
                    <?= isset($student['lecturer_name']) ? $student['lecturer_name'] : 'Not Assigned'; ?>
                  </td>
                  <td class="">
                    <a href="/profile/edit/<?=$student['id'];?>" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="/admin/reset/<?=$student['id'];?>" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-clockwise"></i></a>
                    <button class="btn btn-danger btn-sm" onclick="deleteStudent(<?=$student['sid'];?>)"><i class="bi bi-trash"></i></button>
                  </td>
                  <td>
                    <span style="color: <?= $student['user_status'] == 'Active' ? 'green' : 'red' ?>;">
                        <?= $student['user_status'] ?>
                    </span>
                </tr>
                <?php endforeach; ?>
              <?php endif;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Modal -->
  <div class="modal fade" id="assignLecturerModal" tabindex="-1" aria-labelledby="assignLecturerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assignLecturerModalLabel">Assign Lecturer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="assignLecturerForm" method="post" action="/assignLecturer">
            <input type="hidden" name="sid" id="studentId">
            <div class="mb-3">
              <label for="lecturer" class="form-label">Select Lecturer</label>
              <select class="form-select" id="lecturer" name="lecturer">
                <?php foreach($lecturers as $lecturer): ?>
                  <option value="<?=$lecturer['lid'];?>"><?=$lecturer['lname'];?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Assign</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var assignLecturerModal = document.getElementById('assignLecturerModal');
  assignLecturerModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var sid = button.getAttribute('data-sid');
    var studentIdInput = document.getElementById('studentId');
    studentIdInput.value = sid;
  });
});

function deleteStudent(sid) {
  if (confirm('Are you sure you want to delete this student?')) {
    // Perform the delete action here
    window.location.href = '/students/delete/' + sid;
  }
}
</script>

<?=$this->endsection()?>