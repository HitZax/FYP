<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class=" container-fluid">
  <div class=" container-fluid">
              <div class="row">
                  <div class="col-md-12 pt-3">
                      <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                        <li class=" breadcrumb-item active text-dark text-muted" aria-current="page"> Dashboard</li>
                          <li class="breadcrumb-item"><a href="/logbook" class="text-dark text-underline-hover">
                                  Student's Logbook</a>
                          </li>
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page"> Logbook Task List</li>
                      </ol>
                  </div>
              </div>
            </div>
        </div>

<div class="container-fluid">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="my-2 py-2 mt-2">Logbook Task List</h1>
                    <!-- <hr> -->
                    
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Task Name</th>
                                <th scope="col">Lecturer's Remarks</th>
                                <th scope="col">Edit Remarks</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php if(empty($task)):?>
                            <tr>
                                <td colspan="5" class="text-center">Data is unavailable</td>
                            </tr>
                            <?php endif;?>
                            <?php $bil=1;?>
                            <?php foreach($task as $t):?>
                            <tr>
                                <th scope="row"><?=$bil++;?></th>
                                <td><?=date('d/m/y',strtotime($t['tdate']));?></td>
                                <td><?=$t['tname'];?></td>
                                <td><?=$t['remark'];?></td>
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$t['tid']?>">
                                <i class="bi bi-pencil"></i></button></td>
                                <td><a href="<?=url_to('task.show',$t['tid'])?>" class="btn btn-secondary"><i class="bi bi-eye"></i></a></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->


<!-- Modal -->
<?php foreach($task as $t):?>
<div class="modal fade" id="exampleModal<?=$t['tid']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remarks For <?=$t['tname'];?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/update/task/<?=$t['tid']?>" method="post" autocomplete="off">
            <?=csrf_field()?>
              <div class="mb-3">
                <label class="form-label float-start">Remarks</label>
                  <input type="text" class="form-control" name="remark" value="<?=$t['remark']?>" placeholder="Please insert remarks">
                  <div class="invalid-feedback">Please insert remarks</div>
              </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary">Edit Remarks</button>
            </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>

        <?=$this->endsection()?>