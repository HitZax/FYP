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
                <th scope="col">Status</th>
                <th scope="col">Action</th>
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
                    <?= isset($student['lecturer_name']) ? $student['lecturer_name'] : 'Not Assigned'; ?>
                  </td>
                  <td>
                    <span style="color: <?= $student['user_status'] == 'Active' ? 'green' : 'red' ?>;">
                        <?= $student['user_status'] ?>
                    </span>
                  <td class="">
                    <a href="/profile/edit/<?=$student['id'];?>" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#assignLecturerModal" data-student-id="<?=$student['id'];?>" data-student-name="<?=$student['sname'];?>" data-lecturer-id="<?=$student['lid'];?>"><i class="bi bi-person"></i></button>
                    <a href="/admin/reset/<?=$student['id'];?>" class="btn btn-secondary btn-sm" onclick="confirmReset(<?=$student['id'];?>)"><i class="bi bi-arrow-clockwise"></i></a>
                    <button class="btn btn-danger btn-sm" onclick="deleteStudent(<?=$student['sid'];?>)"><i class="bi bi-trash"></i></button>
                  </td>
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
        <h5 class="modal-title" id="assignLecturerModalLabel">Assign Lecturer to <span id="studentName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="assignLecturerForm" method="post" action="/admin/assignLecturer">
        <div class="modal-body">
          <input type="hidden" name="student_id" id="student_id">
          <div class="mb-3">
            <label for="lecturer_id" class="form-label">Select Lecturer</label>
            <select class="form-select" id="lecturer_id" name="lecturer_id">
              <option value="">Unassign</option>
              <?php foreach ($lecturers as $lecturer): ?>
                <option value="<?= $lecturer['lid']; ?>"><?= $lecturer['lname']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Assign</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var assignLecturerModal = document.getElementById('assignLecturerModal');
  assignLecturerModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var studentId = button.getAttribute('data-student-id');
    var studentName = button.getAttribute('data-student-name');
    var currentLecturerId = button.getAttribute('data-lecturer-id');
    
    var studentIdInput = assignLecturerModal.querySelector('#student_id');
    var studentNameSpan = assignLecturerModal.querySelector('#studentName');
    var lecturerSelect = assignLecturerModal.querySelector('#lecturer_id');

    studentIdInput.value = studentId;
    studentNameSpan.textContent = studentName;

    // Set the default option to the current lecturer
    if (currentLecturerId) {
      lecturerSelect.value = currentLecturerId;
    } else {
      lecturerSelect.selectedIndex = 0;
    }
  });
});

function deleteStudent(sid) {
  if (confirm('Are you sure you want to delete this student?')) {
    window.location.href = '/admin/deleteStudent/' + sid;
  }
}

function confirmReset(studentId) {
    if (confirm('Are you sure you want to reset this student? This will delete all active sessions and change the status to active.')) {
        window.location.href = '/admin/reset/' + studentId;
    }
}
</script>

<?=$this->endsection()?>