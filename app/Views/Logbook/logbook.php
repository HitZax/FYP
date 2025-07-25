<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class="container-fluid">


  <div class=" container-fluid">
              <div class="row">
                  <div class="col-md-12 pt-3">
                      <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                          <li class="breadcrumb-item"><a href="/dashboard" class="text-dark text-underline-hover">
                                  Dashboard</a>
                          </li>
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Logbook</li>
                      </ol>
                  </div>
              </div>
            </div>

    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between flex-wrap align-items-center pb-2 mb-3 border-bottom">
                    <?php if($this->session->role == "Lecturer"):?>
                    <h1 class="my-2 py-2 mt-2">Logbook <?=$student['sname']?></h1>
                    <?php endif?>
                    <?php if($this->session->role == "Student"):?>
                    <h1 class="my-2 py-2 mt-2">Logbook</h1>
                    <?php endif?>
                    <!-- <hr> -->
                    <a href="<?=url_to('task.new', $logbook['lbid'])?>" class="btn btn-outline-primary float-end">Add Task Report</a>
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
                                <th scope="col">Action</th>
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
                                <td>
                                    <a href="<?=url_to('task.show',$t['tid'])?>" class="btn btn-secondary"><i class="bi bi-eye"></i></i></a>
                                    <a href="<?=url_to('task.edit',$t['tid'])?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                                    <form action="<?=url_to('task.delete',$t['tid'])?>" method="post" class="d-inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you wanted to delete this task?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>

                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    <div class=" d-flex justify-content-center"><?=$pager->links('task')?></div>
                </div>
            </div>
        </div>


        

        <?=$this->endsection()?>