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
                    <!-- @foreach($newEvent as $event)
            <div class="row">
                @if($event->type == "half")
                    <div class="col-lg-4 col-md-6">
                    <div class="card">
                        //images and information
                    </div>
                    </div>  
                @else 
                    <div class="col-lg-8 col-md-12">
                    <div class="card">
                        //images and information
                        </div>
                    </div>
                @endif
            </div>
            @endforeach -->
        </div>
    </div>
</div>

<?=$this->endsection()?>