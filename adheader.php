<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>:: Care And Cure - Hospital Admin ::</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="assets/plugins/morrisjs/morris.css" rel="stylesheet" />
    
    <!-- Custom Css -->
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="assets/css/themes/all-themes.css" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->

</head>

<body class="theme-cyan">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-cyan">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Morphing Search  -->

    <!-- Top Bar -->
    <nav class="navbar clearHeader">
        <div class="col-12">
            <div class="navbar-header"> <a href="javascript:void(0);" class="bars"></a> <a class="navbar-brand"
                    href="#">Здравје и живот</a> </div>
            <ul class="nav navbar-nav navbar-right">
                <!-- Notifications -->
                <li>
                    <a data-placement="bottom" title="Full Screen" href="logout.php"><i
                            class="zmdi zmdi-sign-in"></i></a>
                </li>               

            </ul>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <?php
                if(isset($_SESSION[adminid]))
                {
            ?>
            <!--Admin Menu -->
            <div class="menu">
                <ul class="list" style="overflow: hidden; width: auto; height: calc(-184px + 100vh);">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active open"><a href="adminaccount.php"><i
                                class="zmdi zmdi-home"></i><span>Почетна</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Профил</span> </a>
                        <ul class="ml-menu">
                            <li><a href="adminprofile.php">Админ Профил</a></li>
                            <li><a href="adminchangepassword.php">Промени лозинка</a></li>
                            <li><a href="admin.php">Додај Админ</a></li>
                            <li><a href="viewadmin.php">Погледни Админ</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Термини</span> </a>
                        <ul class="ml-menu">
                            <li><a href="appointment.php">Нов термин</a></li>
                            <li><a href="viewappointmentpending.php">Погледни термини во исчекување</a>
                            </li>
                            <li><a href="viewappointmentapproved.php">Погледни одобрени термини</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Доктори</span> </a>
                        <ul class="ml-menu">
                            <li><a href="doctor.php">Додај доктор</a>
                            </li>
                            <li><a href="viewdoctor.php">Погледни доктор</a></li>
                            
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Пациенти</span> </a>
                        <ul class="ml-menu">
                            <li><a href="patient.php">Додај пациент</a></li>
                            <li><a href="viewpatient.php">Погледни извештаи за пациент</a></li>
                        </ul>
                    </li>


                    <li> <a href="javascript:void(0);" class="menu-toggle toggled waves-effect waves-block"><i
                                class="zmdi zmdi-copy"></i><span>Услуги</span> </a>
                        <ul class="ml-menu" style="display: block;">
                            <li><a href="department.php" class=" waves-effect waves-block">Додај оддел</a></li>
                            <li><a href="viewdepartment.php" class=" waves-effect waves-block">Погледни оддел</a></li>
                            <li><a href="treatment.php" class=" waves-effect waves-block">Додај нов третман</a></li>
                            <li><a href="viewtreatment.php" class=" waves-effect waves-block">Погледни типови на третмани</a></li>
                            <li><a href="medicine.php" class=" waves-effect waves-block">Додај лек</a></li>
                            <li><a href="viewmedicine.php" class=" waves-effect waves-block">Погледни лекови</a></li>
                        </ul>
                    </li>

                    
                </li>

                </ul>
            </div>
            <!-- Admin Menu -->
            <?php }?>


            <!-- doctor Menu -->
            <?php
            if(isset($_SESSION[doctorid]))
            {
            ?>
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active open"><a href="doctoraccount.php"><i
                                class="zmdi zmdi-home"></i><span>Почетна</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Профил</span> </a>
                        <ul class="ml-menu">
                            <li><a href="doctorprofile.php">Профил</a></li>
                            <li><a href="doctorchangepassword.php">Промени лозинка</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Термини</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewappointmentpending.php" style="width:250px;">Погледни термини во исчекување</a>
                            </li>
                            <li><a href="viewappointmentapproved.php" style="width:250px;">Погледни одобрени термини</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Доктори</span> </a>
                        <ul class="ml-menu">
                            
                            <li><a href="doctortimings.php">Додај часови за посета</a></li>
                            <li><a href="viewdoctortimings.php">Погледни часови за посета</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Пациенти</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewpatient.php">Погледни пациент</a>
                            </li>
                        </ul>
                    </li>

                    <li> <a href="viewdoctorconsultancycharge.php"><i class="zmdi zmdi-copy"></i><span>Извештај за приход</span> </a></li>


                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-copy"></i><span>Услуги</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewtreatmentrecord.php">Погледни извештаи за третмани</a></li>
                            <li><a href="viewtreatment.php">Погледни третмани</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

            <?php }; ?>
            <!-- doctor Menu -->




            <!-- patient Menu -->
            <?php
            if(isset($_SESSION[patientid]))
            {
            ?>
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active open"><a href="patientaccount.php"><i
                                class="zmdi zmdi-home"></i><span>Почетна</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Профил</span> </a>
                        <ul class="ml-menu">
                            <li><a href="patientprofile.php">Погледни профил</a></li>
                            <li><a href="patientchangepassword.php">Промени лозинка</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Термини</span> </a>
                        <ul class="ml-menu">
                            <li><a href="patientappointment.php" >Нов термин</a></li>
                            <li><a href="viewappointment.php" >Погледни термини</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Рецепти</span> </a>
                        <ul class="ml-menu">
                            <li><a  href="patviewprescription.php">Погледни извештаи за рецепти</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Лекувања</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewtreatmentrecord.php">Погледни извештаи за лекување</a></li>
                    </li>
                </ul>
                </li>


                </ul>
            </div>

            <?php }; ?>
            <!-- patient Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
     
    </section>
     <section class="content home">
