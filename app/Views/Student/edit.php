<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container mx-auto mt-5">
    <div class="row">
        <div class="card px-2 py-2 bg-light">
          <div class="row class">
          <div class="card-body">
            <h2 class="text-center">Edit Date</h2> 
              <div class="row">
            <form action="/student/edit/<?=$student->sid?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Visiting Date</label>
                    <input type="date" class="form-control" id="name" placeholder="Visit Date" name="visitdate" value="" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Report Submission Date</label>
                    <input type="date" class="form-control" id="name" placeholder="Report Data" name="reportdate" value="" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<?=$this->endsection()?>