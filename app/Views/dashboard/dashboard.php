<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="my-2 py-2">Dashboard</h1>
                <hr>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title">Internship Start Date</h5>
                                <p class="card-text"> <?=$intern->startdate = date('d-m-Y');?> </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar-plus fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title">Internship End Date</h5>
                                <p class="card-text"> <?=$intern->enddate = date('d-m-Y');?> </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-calendar-check fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title">Current Week</h5>
                                <p class="card-text"> On week <?=$week?> </p>
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
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title">Task Added</h5>
                                <p class="card-text"> (Task Total) </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-journal-plus fa-5x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title">Internship Days Left</h5>
                                <p class="card-text"> <?=$days?> </p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-hourglass-split fa-5x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>




<?=$this->endsection()?>