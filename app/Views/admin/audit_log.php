<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class="container-fluid">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 pt-3">
        <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
          <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-dark text-underline-hover">Admin Dashboard</a></li>
          <li class="breadcrumb-item active text-dark text-muted" aria-current="page">Audit Log</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="my-2 py-2 mt-2">Audit Logs</h1>
          <form class="d-flex my-2 my-lg-0" method="get" action="/admin/auditlog">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= isset($search) ? $search : '' ?>">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#activeSessionsModal">Current Active Sessions: <?=$totalActiveSessions;?></button>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">User ID & Name</th>
                <th scope="col">Action</th>
                <th scope="col">Audit Status</th>
                <th scope="col">Attempt No.</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
                <th scope="col">Expand</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php if(empty($logs)):?>
              <tr>
                <td colspan="8" class="text-center">No logs found</td>
              </tr>
              <?php else: ?>
                <?php foreach($logs as $log): ?>
                <tr>
                  <td><?=$log['id'];?></td>
                  <td>(<?=$log['user_id'];?>) - <?=$log['fullname'];?></td>
                  <td><?=$log['action'];?></td>
                  <td><?=$log['status'];?></td>
                  <td><?=$log['attempt_number'];?></td>
                  <td><?= date('h:i', strtotime($log['timestamp'])); ?></td>
                  <td><?= date('d M', strtotime($log['timestamp'])); ?></td>
                  <td><button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#logModal<?=$log['id'];?>"><i class="bi bi-three-dots-vertical"></i></button></td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="logModal<?=$log['id'];?>" tabindex="-1" aria-labelledby="logModalLabel<?=$log['id'];?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="logModalLabel<?=$log['id'];?>">Log Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p class="text-center"><strong>Audit Logs</strong></P>
                        <p><strong>ID:</strong> <?=$log['id'];?></p>
                        <p><strong>User ID:</strong> <?=$log['user_id'];?></p>
                        <p><strong>Action:</strong> <?=$log['action'];?></p>
                        <p><strong>Audit Status:</strong> <?=$log['status'];?></p>
                        <p><strong>Attempt No:</strong> <?=$log['attempt_number'];?></p>
                        <p><strong>Timestamp:</strong> <?= date('Y-m-d H:i:s ', strtotime($log['timestamp'])); ?></p>
                        <p><strong>IP Address:</strong> <?=$log['ip_address'];?></p>
                        <p><strong>User Agent:</strong> <?=$log['user_agent'];?></p>
                        <hr>
                        <p class="text-center"><strong>User Details</strong></P>
                        <p><strong>Full Name:</strong> <?=$log['fullname'];?></p>
                        <p><strong>Email:</strong> <?=$log['email'];?></p>
                        <p><strong>Role:</strong> <?=$log['role'];?></p>
                        <p><strong>User Status:</strong> <?=$log['user_status'];?></p>
                        <p><strong>Last 2FA:</strong> <?=$log['last2FA'];?></p>
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

  <!-- Active Sessions Modal -->
  <div class="modal fade" id="activeSessionsModal" tabindex="-1" aria-labelledby="activeSessionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="activeSessionsModalLabel">Current Active Sessions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">User ID</th>
                <th scope="col">Name</th>
                <th scope="col">Created At</th>
                <th scope="col">Session ID</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody id="activeSessionsTable">
              <?php foreach($activeSessions as $session): ?>
              <tr>
                <td><?=$session['user_id'];?></td>
                <td><?=$session['fullname'];?></td>
                <td><?=$session['created_at'];?></td>
                <td><?=$session['session_id'];?></td>
                <td>
                  <form action="/admin/deleteActiveSession/<?=$session['id'];?>" method="post" onsubmit="return confirm('Are you sure you want to delete this session?');">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<?=$this->endsection()?>