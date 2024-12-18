<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="my-2 py-2 mt-2">Dashboard</h1>
                <hr>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold">
                                    <?= $intern->startdate ? date('d-M-Y', strtotime($intern->startdate)) : "Date hasn't Been Set"; ?>
                                </h5>
                                <p class="card-text">Internship Start Date</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar3 fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold">
                                    <?= $intern->enddate ? date('d-M-Y', strtotime($intern->enddate)) : " Date hasn't Been Set"; ?>
                                </h5>
                                <p class="card-text">Internship End Date</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar3 fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <?php if($intern->visitdate == ''):?>
                            <div>
                                <h5 class="card-title fw-bold">Date Hasn't Been Set</h5>
                                <p class="card-text"> Visiting Appointment Date </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar fa-3x"></i>
                            </div>
                            <?php else:?>
                            <div>
                                <h5 class="card-title fw-bold"> <?=date('d-M-Y',strtotime($intern->visitdate));?> </h5>
                                <p class="card-text"> Visiting Appointment Date </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar-check fa-3x"></i>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <?php if($intern->reportdate == ''):?>
                            <div>
                                <h5 class="card-title fw-bold">Date Hasn't Been Set</h5>
                                <p class="card-text"> Report Submission Date </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar fa-3x"></i>
                            </div>
                            <?php else:?>
                            <div>
                                <h5 class="card-title fw-bold"> <?=date('d-M-Y',strtotime($intern->reportdate));?> </h5>
                                <p class="card-text"> Report Submission Date </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar-check fa-3x"></i>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="my-2 py-2">Dashboard</h1>
                <hr>
            </div>
        </div>
    </div> -->

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"><?=$taskcount['numrows']?></h5>
                                <p class="card-text"> Total Task Added </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-journal-plus fa-3x"></i>
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
                                <h5 class="card-title fw-bold"> <?=$days?> Days </h5>
                                <p class="card-text"> Internship Days Remaining </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-hourglass-split fa-3x"></i>
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
                                <h5 class="card-title fw-bold"> Currently On Week <?=$week?> </h5>
                                <p class="card-text"> Internship Week </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar-week fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="my-2 py-2 fs-2 mt-2">My Recent Tasks</h1>
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
                                <th scope="col">Date</th>
                                <th scope="col">Task Name</th>
                                <th scope="col">Task Desc</th>
                                <th scope="col">Lecturer's Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php if(empty($task)):?>
                            <tr>
                                <td colspan="5" class="text-center">Data is unavailable</td>
                            </tr>
                            <?php endif;?>
                            <?php $bil=1;?>
                            <?php foreach($task as $t):?>
                            <tr>
                                <th scope="row"><?=$bil++;?></th>
                                <td><?=date('d/m/Y',strtotime($t['tdate']));?></td>
                                <td><?=$t['tname'];?></td>
                                <td><?=$t['tdesc'];?></td>
                                <td><?=$t['remark'];?></td>

                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</div>




<?=$this->endsection()?>