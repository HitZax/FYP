<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="my-2 py-2 mt-2">Admin Dashboard</h1>
                <hr>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"><?=date('d-M-Y', strtotime($intern->startdate));?></h5>
                                <p class="card-text">Internship Start Date</p>
                            </div>
                            <div class="align-self-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#changeStartDateModal">
                                    <i class="bi bi-calendar3 fa-3x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"><?=date('d-M-Y', strtotime($intern->enddate));?></h5>
                                <p class="card-text">Internship End Date</p>
                            </div>
                            <div class="align-self-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#changeEndDateModal">
                                    <i class="bi bi-calendar3 fa-3x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold">Currently On Week <?=$currentWeek;?></h5>
                                <p class="card-text">Internship Week</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar-week fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"><?=$totalLecturers;?></h5>
                                <p class="card-text">Total Lecturers</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-person-fill fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"><?=$daysRemaining;?></h5>
                                <p class="card-text">Internship Days Remaining</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-hourglass-split fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"><?=$totalStudents;?></h5>
                                <p class="card-text">Total Students</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-person-fill fa-3x"></i>
                            </div>
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
                        <h1 class="my-2 py-2 fs-2 mt-2">Recent Audit Logs</h1>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Audit Status</th>
                                    <th scope="col">Attempt No.</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php if(empty($latestAuditLogs)):?>
                                <tr>
                                    <td colspan="7" class="text-center">No logs found</td>
                                </tr>
                                <?php else: ?>
                                    <?php foreach($latestAuditLogs as $log): ?>
                                    <tr>
                                        <td><?=$log['id'];?></td>
                                        <td>(<?=$log['user_id'];?>)</td>
                                        <td><?=$log['action'];?></td>
                                        <td><?=$log['status'];?></td>
                                        <td><?=$log['attempt_number'];?></td>
                                        <td><?= date('h:i', strtotime($log['timestamp'])); ?></td>
                                        <td><?= date('d M', strtotime($log['timestamp'])); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

<!-- Modal for changing end date -->
<div class="modal fade" id="changeEndDateModal" tabindex="-1" aria-labelledby="changeEndDateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('admin/changeEndDate')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeEndDateModalLabel">Change End Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="endDate" class="form-label">New End Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for changing start date -->
<div class="modal fade" id="changeStartDateModal" tabindex="-1" aria-labelledby="changeStartDateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('admin/changeStartDate')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStartDateModalLabel">Change Start Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">New Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?=$this->endsection()?>