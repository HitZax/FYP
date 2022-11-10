<?php $this->extend('layout/template')?>
<?php $this->section('content')?>

<?php $this->session = \Config\Services::session(); ?>

<div class="container-fluid mt-5 pt-5">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="fs-2 text-center border-bottom">Internship Detail</h1>
                
            </div>
        </div>
    </div>




    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/intership/detail/<?=$this->session->get('id')?>" method="post">
                    <?=csrf_field()?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="startddate">                    
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="exampleInputPassword1" name="enddate">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Location</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="location">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">SuperVisor Name</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="svname">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">SuperVisor Number</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="svnum">
                    </div>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    
                </form>
            </div>
        </div>
    </div>

</div>
<?php $this->endSection()?>