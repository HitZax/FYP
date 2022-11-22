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
        <?php foreach ($student as $s) : ?>
            <div class="col-lg-4 col-md-4">
                <div class="card-shadow">
                    <!-- <h5 class="card-header">Featured</h5> -->
                    <div class="card-body">
                        <i class="bi bi-journal-text float-end fa-4x"></i>
                        <h5 class="card-title"><?= $s['sname'];?></h5>
                        <p class="card-text"><?= $s['studentid'];?></p>
                        <a href="" class="btn btn-primary">View Logbook</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>

<?=$this->endsection()?>