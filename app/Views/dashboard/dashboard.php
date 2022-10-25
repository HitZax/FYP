<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid py-4 px-4">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h1 class="fs-2">Dashboard</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title">Internship Start Date</h5>
                                <p class="card-text"> <?=$intern->startdate;?> </p>
                            </div>
                            <div class="align-self-center">
                                 <i class="bi bi-calendar-plus fa-10x"></i>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Internship End Date</h5>

                            <p class="card-text"> <?=$intern->enddate;?> </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Currently On Week</h5>

                            <p class="card-text"><?=$week?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total Task Updated</h5>

                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>



</div>



<?=$this->endsection()?>