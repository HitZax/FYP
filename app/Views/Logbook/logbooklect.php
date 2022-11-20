<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid px-3 py-3">

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <?php if(session()->get('message')):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Data has been  <strong></strong> <?=session()->getFlashdata('message');?> </strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif;?>
    </div>
  </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom">
          <!-- Button trigger modal -->
          <h1 class="h2">Student</h1>
          <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            New Student
          </button>
        </div>
    </div>
</div>



<?=$this->endsection()?>