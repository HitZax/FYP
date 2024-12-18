<?php $this->session = \Config\Services::session(); ?>

<nav class="navbar navbar-expand-lg navbar-light sticky-top px-5 bg-nav py-3" >
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="text-center"> <img src="/asset\uni10.png" alt="" class="pe-2" style="max-width:50px"></div>

        <?php if($this->session->role == "Student"):?>
        <a class="navbar-brand text-white"><b>Student OLS</b></a>
        <?php endif?>

        <?php if($this->session->role == "Lecturer"):?>
        <a class="navbar-brand text-white"><b>Lecturer OLS</b></a>
        <?php endif?>

        <?php if($this->session->role == "Admin"):?>
        <a class="navbar-brand text-white"><b>Admin OLS</b></a>
        <?php endif?>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            
            <?php if($this->session->role != "Admin"):?>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="/logbook">Logbook</a>
                </li>
                <?php if($this->session->role == "Lecturer"):?>
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="/student">Student</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="/chatlect/<?= $this->session->get('id');?>">Communicate</a>
                </li>
                <?php endif?>

                <?php if($this->session->role == "Student"):?>
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="/chat/<?= $this->session->get('id');?>">Communicate</a>
                </li>
                <?php endif?>
            </ul>
            <?php endif?>

            <?php if($this->session->role == "Admin"):?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="/admin/dashboard">Dashboard</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="/admin/student">Students</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="/admin/lecturer">Lecturers</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="#">Audit Logs</a>
                </li>
                <!-- <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="#">Communicate</a>
                </li> -->
            </ul>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-link active text-white" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <b class="bi bi-person-circle pr-1"> <?= $this->session->get('fullname');  ?> </b><span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" role="menu">  
                        <li class="nav-item">
                        <a class="dropdown-item" href="/profile/edit/<?=$this->session->get('id');?>">
                            <i class="bi bi-pencil-fill"></i></i> Edit Profile
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

            <?php if($this->session->role == "Student"):?>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-link active text-white" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <b class="bi bi-person-circle pr-1"> <?= $this->session->get('fullname');  ?> (<?= $this->session->get('studentid');  ?>)</b><span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" role="menu">  
                        <li class="nav-item">
                        <a class="dropdown-item" href="/profile/edit/<?=$this->session->get('id');?>">
                            <i class="bi bi-pencil-fill"></i></i> Edit Profile
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
                    <a href="#" class="dropdown-toggle nav-link active text-white" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        <b class="bi bi-person-circle pr-1"> <?=fullname()?></b><span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                        <li class="nav-item">
                            <a class="dropdown-item" href="/profile/edit/<?=$this->session->get('id');?>">
                            <i class="bi bi-pencil-fill"></i> Edit Profile
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