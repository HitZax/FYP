<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class="container-fluid">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 pt-3">
        <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
          <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-dark text-underline-hover">Admin Dashboard</a></li>
          <li class="breadcrumb-item active text-dark text-muted" aria-current="page">Lecturer List</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="my-2 py-2 mt-2">Lecturer List</h1>
          <form class="d-flex my-2 my-lg-0" method="get" action="/admin/lecturer">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= isset($search) ? $search : '' ?>">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <a href="/registerlect" class="btn btn-outline-primary float-end">Add New Lecturer</a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Total Students</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php if(empty($lecturers)):?>
              <tr>
                <td colspan="4" class="text-center">No lecturers found</td>
              </tr>
              <?php else: ?>
                <?php foreach($lecturers as $lecturer): ?>
                <tr>
                  <td><?=$lecturer['lname'];?></td>
                  <td><?=$lecturer['lemail'];?></td>
                  <td><?=$lecturer['total_students'];?></td>
                  <td class="">
                    <a href="/profile/edit/<?=$lecturer['id'];?>" class="btn btn-secondary btn-sm"><i class="bi bi-pencil"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php endif;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

<?=$this->endsection()?>