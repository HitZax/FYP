<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class=" container-fluid">
    
  <div class=" container-fluid">
              <div class="row">
                  <div class="col-md-12 pt-3">
                      <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                          <li class="breadcrumb-item"><a href="/dashboard" class="text-dark text-underline-hover">
                                  Dashboard</a>
                          </li>
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page"> Chat</li>
                      </ol>
                  </div>
              </div>
            </div>
        </div>

<div class="container-fluid px-3 py-3">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Chat With Student</h1>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">

        <?php foreach ($student as $s) : ?>
        <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div>
                                <b class="card-title fw-bold"><?= $s['sname'];?> </b>
                                <p class="card-text"> <?= $s['studentid'];?> </p>
                                <a href="/chat/<?= $s['chatid'];?>" class="btn btn-primary">Open Chat</a>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-chat-dots float-end fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>



<?=$this->endsection()?>