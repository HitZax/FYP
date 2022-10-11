<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="/student/edit/<?=$student->sid?>" method="post">
                <div class="mb-3">
                    <label for="studentid" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Student ID" name="studentid" value="<?=$student->studentid?>" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Name" name="name" value="<?=$student->sname?>" required>
                </div>
                <div class="mb-3">
                    <label for="program" class="form-label">Programme</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Course" name="program" value="<?=$student->sprogram?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?=$this->endsection()?>