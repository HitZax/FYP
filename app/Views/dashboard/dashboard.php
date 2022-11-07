<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="my-2 py-2 mt-2">Dashboard</h1>
                <hr>
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
                                <h5 class="card-title fw-bold"><?=$intern->startdate = date('d-M-Y');?></h5>
                                <p class="card-text">Internship Start Date</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar-plus fa-3x"></i>
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
                                <h5 class="card-title fw-bold"> <?=$intern->enddate;?> </h5>
                                <p class="card-text"> Internship End Date </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar-check fa-3x"></i>
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
                                <h5 class="card-title fw-bold">(Task Total)</h5>
                                <p class="card-text"> Task Added </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-journal-plus fa-5x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"> <?=$days?> Days </h5>
                                <p class="card-text"> Internship Days Remaining </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-hourglass-split fa-5x"></i>
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

            <div class="container-fluid mt-2">
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
                                <tbody class="table-group-divider">
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>




<?=$this->endsection()?>