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
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title">Internship Start Date</h5>
                                <p class="card-text"> (Start Of Intern) </p>
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
                                <h5 class="card-title">Internship End Date</h5>
                                <p class="card-text"> (End Of Intern) </p>
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
                                <h5 class="card-title">Current Week</h5>
                                <p class="card-text"> On week (1-12) </p>
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
                                <h5 class="card-title">Remarks Given</h5>
                                <p class="card-text"> (Remarks Total) </p>
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
                                <h5 class="card-title">Internship Days Left</h5>
                                <p class="card-text"> (Count total days left) </p>
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
                                <h5 class="card-title">Total students</h5>
                                <p class="card-text"> (Students under supervision) </p>
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