<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid px-3 py-3">

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">

    </div>
  </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom">
          <h1 class="h2">Student's Logbook</h1>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <h5 class="card-title fw-bold"> Luthfil Hadi Bin Zul Hisham </h5>
                                <p class="card-text"> DC97507 </p>
                                <a href="task.edit" class="btn btn-primary">View Logbook</a>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-journal-text float-end fa-4x"></i>
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
                                <h5 class="card-title fw-bold"> (Student's Name) </h5>
                                <p class="card-text"> (Student's ID) </p>
                                <a href="#" class="btn btn-primary">View Logbook</a>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-journal-text float-end fa-4x"></i>
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
                                <h5 class="card-title fw-bold"> (Student's Name) </h5>
                                <p class="card-text"> (Student's ID) </p>
                                <a href="#" class="btn btn-primary">View Logbook</a>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-journal-text float-end fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>



<?=$this->endsection()?>