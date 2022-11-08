<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

    <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between flex-wrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="my-2 py-2 mt-2">Logbook</h1>
                        <!-- <hr> -->
                        <a href="<?=url_to('task.new', $lbid['lbid'])?>" class="btn btn-outline-primary float-end">Add New Task</a>

                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2">
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
                                <tbody class="table-group-divider">
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    
</div>

<?=$this->endsection()?>