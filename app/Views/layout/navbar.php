<?php $this->session = \Config\Services::session(); ?>

<nav class="navbar navbar-expand-lg navbar-light sticky-top px-5 bg-nav py-3" >
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php if($this->session->role == "Student"):?>
        <a class="navbar-brand" href="#"><b>Online Logbook System (Student)</b></a>
        <?php endif?>

        <?php if($this->session->role == "Lecturer"):?>
        <a class="navbar-brand" href="#"><b>Online Logbook System (Lecturer)</b></a>
        <?php endif?>

        <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="/dashboard">Dashboard</a>
                </li>
                <?php if($this->session->role == "Lecturer"):?>
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="/student">Student</a>
                </li>
                <?php endif?>
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="/task">Task</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="/com">Communicate</a>
                </li>
            </ul>

            <?php if($this->session->role == "Student"):?>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-link active" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <b class="bi bi-person-circle pr-1"> <?= $this->session->get('fullname');  ?> (<?= $this->session->get('studentid');  ?>)</b><span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" role="menu">  
                        <li class="nav-item">
                        <a class="dropdown-item" href="/profile/edit/<?=$this->session->get('id');?>">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Edit Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item" href="/logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php endif?>

            <?php if($this->session->role == "Lecturer"):?>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-link active" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <b class="bi bi-person-circle pr-1"> <?= $this->session->get('fullname');  ?></b><span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                         <li class="nav-item">
                            <a class="dropdown-item" href="/profile/edit/<?=$this->session->get('id');?>">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Edit Profile
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="dropdown-item" href="/logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php endif?>

        </div>
    </div>
</nav>