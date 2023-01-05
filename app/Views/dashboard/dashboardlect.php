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
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"><?=date('d-M-Y',strtotime($intern->startdate));?></h5>
                                <p class="card-text">Internship Start Date</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar3 fa-3x"></i>
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
                                <h5 class="card-title fw-bold"> <?=date('d-M-Y',strtotime($intern->enddate));?> </h5>
                                <p class="card-text"> Internship End Date </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar3 fa-3x"></i>
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
                                <h5 class="card-title fw-bold">3</h5>
                                <p class="card-text"> Total Remarks </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-pencil-fill fa-3x"></i>
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
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"><?=$cs['numrows']?></h5>
                                <p class="card-text"> Total Students </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-person-fill fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="my-2 py-2 fs-2">My Recent Tasks</h1>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col-md-1">#</th>
                                <th scope="col-md-3">Task</th>
                                <th scope="col-md-5">Description</th>
                                <th scope="col-md-1">Date</th>
                                <th scope="col-md-2">Lecturer Remark's</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


</div>




<?=$this->endsection()?>