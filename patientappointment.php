<?php

include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
    if(isset($_SESSION[patientid]))
    {
        $lastinsid =$_SESSION[patientid];
    }
    else
    {
        $dt = date("Y-m-d");
        $tim = date("H:i:s");
        $sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,city,mobileno,loginid,password,gender,dob,status) values('$_POST[patiente]','$dt','$tim','$_POST[textarea]','$_POST[city]','$_POST[mobileno]','$_POST[loginid]','$_POST[password]','$_POST[select6]','$_POST[dob]','Active')";
        if($qsql = mysqli_query($con,$sql))
        {
            /* echo "<script>alert('patient record inserted successfully...');</script>"; */
        }
        else
        {
            echo mysqli_error($con);
        }
        $lastinsid = mysqli_insert_id($con);
    }
    
    $sqlappointment="SELECT * FROM appointment WHERE appointmentdate='$_POST[appointmentdate]' AND appointmenttime='$_POST[appointmenttime]' AND doctorid='$_POST[doct]' AND status='Approved'";
    $qsqlappointment = mysqli_query($con,$sqlappointment);
    if(mysqli_num_rows($qsqlappointment) >= 1)
    {
        echo "<script>alert('Терминот е веќе закажан за овој термин..');</script>";
    }
    else
    {
        $sql ="INSERT INTO appointment(appointmenttype,patientid,appointmentdate,appointmenttime,app_reason,status,departmentid,doctorid) values('ONLINE','$lastinsid','$_POST[appointmentdate]','$_POST[appointmenttime]','$_POST[app_reason]','Pending','$_POST[department]','$_POST[doct]')";
        if($qsql = mysqli_query($con,$sql))
        {
            echo "<script>alert('Терминот е додаден успешно...');</script>";
        }
        else
        {
            echo mysqli_error($con);
        }
    }
}
if(isset($_GET[editid]))
{
    $sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
    $qsql = mysqli_query($con,$sql);
    $rsedit = mysqli_fetch_array($qsql);
    
}
if(isset($_SESSION[patientid]))
{
    $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
    $qsqlpatient = mysqli_query($con,$sqlpatient);
    $rspatient = mysqli_fetch_array($qsqlpatient);
    $readonly = " readonly";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="wrapper col4">
    <div id="container">

        <?php
        if(isset($_POST[submit]))
        {
           if(mysqli_num_rows($qsqlappointment) >= 1)
           {        
             echo "<h2>Терминот веќе е закажан за  ". date("d-M-Y", strtotime($_POST[appointmentdate])) . " " . date("H:i A", strtotime($_POST[appointmenttime])) . " .. </h2>";
         }
         else
         {
          if(isset($_SESSION[patientid]))
          {
             echo "<h2>Терминот е земан успешно.. </h2>";
             echo "<p>Терминот е во фаза на исчекување.Ве молиме проверувајте го статусот редовно. </p>";
             echo "<p> <a href='viewappointment.php'>Погледни го терминот</a>. </p>";            
         }
         else
         {
             echo "<h2>Терминот е потврден успешно.. </h2>";
             echo "<p>Терминот е во фаза на исчекување.Ве молиме проверувајте го статусот редовно. </p>";
             echo "<p> <a href='patientlogin.php'>Кликнете тука за да се логирате</a>. </p>";   
         }
     }
 }
 else
 {
   ?>
        <!-- Content -->
        <div id="content">



            <!-- Make an Appointment -->
            <section class="main-oppoiment ">
                <div class="container">
                    <div class="row">

                        <!-- Make an Appointment -->
                        <div class="col-lg-7">
                            <div class="appointment">

                                <!-- Heading -->
                                <div class="heading-block head-left margin-bottom-50">
                                    <h4>Закажете термин за преглед</h4>
                                    <hr>
                                </div>
                                <form method="post" action="" name="frmpatapp" onSubmit="return validateform()"
                                    class="appointment-form">
                                    <ul class="row">
                                        <li class="col-sm-6">
                                            <label>


                                                <input placeholder="Име и презиме" type="text" class="form-control"
                                                    name="patiente" id="patiente"
                                                    value="<?php echo $rspatient[patientname];  ?>"
                                                    <?php echo $readonly; ?>>
                                                <i class="icon-user"></i>
                                            </label>

                                        </li>

                                        <li class="col-sm-6">
                                            <label><input placeholder="Адреса" type="text" class="form-control"
                                                    name="textarea" id="textarea"
                                                    value="<?php echo $rspatient[address];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-compass"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label><input placeholder="Град" type="text" class="form-control"
                                                    name="city" id="city" value="<?php echo $rspatient[city];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-pin"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder="Телефонски број" type="text" class="form-control"
                                                    name="mobileno" id="mobileno"
                                                    value="<?php echo $rspatient[mobileno];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-phone"></i>
                                            </label>

                                        </li>
                                        <?php
                            if(!isset($_SESSION[patientid]))
                            {        
                                ?>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder="ID за најава" type="text" class="form-control"
                                                    name="loginid" id="loginid"
                                                    value="<?php echo $rspatient[loginid];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-login"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>

                                                <input placeholder="Лозинка" type="password" class="form-control"
                                                    name="password" id="password"
                                                    value="<?php echo $rspatient[password];  ?>"
                                                    <?php echo $readonly; ?>><i class="icon-lock"></i>
                                            </label>

                                        </li>
                                        <?php
                            }
                            ?>
                                        <li class="col-sm-6">
                                            <label>

                                                <?php 
                                    if(isset($_SESSION[patientid]))
                                    {
                                       echo $rspatient[gender];
                                   }
                                   else
                                   {
                                    ?>
                                                <select name="select6" id="select6" class="selectpicker">
                                                    <option value="" selected="" hidden="">Пол</option>
                                                    <?php
                                        $arr = array("Машки","Женски");
                                        foreach($arr as $val)
                                        {
                                            echo "<option value='$val'>$val</option>";
                                        }
                                        ?>
                                                </select>
                                                <?php
                                }
                                ?>
                                                <i class="ion-transgender"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder="Датум на раѓање" type="text" class="form-control"
                                                    name="dob" id="dob" onfocus="(this.type='date')"
                                                    value="<?php echo $rspatient[dob]; ?>" <?php echo $readonly; ?>><i
                                                    class="ion-calendar"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder="Датум на терминот" type="text" class="form-control"
                                                    min="<?php echo date("Y-m-d"); ?>" name="appointmentdate"
                                                    onfocus="(this.type='date')" id="appointmentdate"><i
                                                    class="ion-calendar"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <input placeholder="Време на терминот" type="text"
                                                    onfocus="(this.type='time')" class="form-control"
                                                    name="appointmenttime" id="appointmenttime"><i
                                                    class="ion-ios-clock"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>

                                                <select name="department" class="selectpicker" id="department"
                                                    >
                                                    <option value="">Одберете оддел</option>
                                                    <?php
                                $sqldept = "SELECT * FROM department WHERE status='Active'";
                                $qsqldept = mysqli_query($con,$sqldept);
                                while($rsdept = mysqli_fetch_array($qsqldept))
                                {
                                 echo "<option value='$rsdept[departmentid]'>$rsdept[departmentname]</option>";
                             }
                             ?>
                                                </select>
                                                <i class="ion-university"></i>
                                            </label>

                                        </li>
                                        <li class="col-sm-6">
                                            <label>
                                                <select name="doct" class="selectpicker" id="department"
                                                    >
                                                    <option value="">Одберете оддел</option>
                                                    <?php
                        $sqldept = "SELECT * FROM doctor WHERE status='Active'";
                        $qsqldept = mysqli_query($con,$sqldept);
                        while($rsdept = mysqli_fetch_array($qsqldept))
                        {
                            echo "<option value='$rsdept[doctorid]'>$rsdept[doctorname] (";
                            $sqldept = "SELECT * FROM department WHERE departmentid='$rsdept[departmentid]'";
                            $qsqldept = mysqli_query($con,$sqldept);
                            $rsdept = mysqli_fetch_array($qsqldept);
                            echo $rsdept[departmentname];

                            echo ")</option>";
                        }
                        ?>
                                                </select>
                                                <i class="ion-medkit"></i>

                                            </label>

                                        </li>
                                        <li class="col-sm-12">
                                            <label>
                                                <textarea class="form-control" name="app_reason"
                                                    placeholder="Причина за прегледот"></textarea>
                                            </label>
                                        </li>
                                        <li class="col-sm-12">
                                            <button type="submit" class="btn" name="submit" id="submit">Закажете!</button>
                                        </li>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
}
?>

        </div>
    </div>
</div>
</section>
</div>



<?php
include("footer.php");
?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform() {
    if (document.frmpatapp.patiente.value == "") {
        alert("Името на пациентот не треба да е празно..");
        document.frmpatapp.patiente.focus();
        return false;
    } else if (!document.frmpatapp.patiente.value.match(alphaspaceExp)) {
        alert("Името на пациентот не е валидно..");
        document.frmpatapp.patiente.focus();
        return false;
    } else if (document.frmpatapp.textarea.value == "") {
        alert("Адресата не треба да е празна..");
        document.frmpatapp.textarea.focus();
        return false;
    } else if (document.frmpatapp.city.value == "") {
        alert("Градот не треба да е празен..");
        document.frmpatapp.city.focus();
        return false;
    } else if (!document.frmpatapp.city.value.match(alphaspaceExp)) {
        alert("Името на градот не е валидно..");
        document.frmpatapp.city.focus();
        return false;
    } else if (document.frmpatapp.mobileno.value == "") {
        alert("Мобилниот телефон не треба да е празен..");
        document.frmpatapp.mobileno.focus();
        return false;
    } else if (!document.frmpatapp.mobileno.value.match(numericExpression)) {
        alert("Мобилниот телефон не е валиден..");
        document.frmpatapp.mobileno.focus();
        return false;
    } else if (document.frmpatapp.loginid.value == "") {
        alert("Логин ИД не треба да е празно..");
        document.frmpatapp.loginid.focus();
        return false;
    } else if (!document.frmpatapp.loginid.value.match(alphanumericExp)) {
        alert("Логин ИД не е валидно.");
        document.frmpatapp.loginid.focus();
        return false;
    } else if (document.frmpatapp.password.value == "") {
        alert("Лозинката не треба да е празна.");
        document.frmpatapp.password.focus();
        return false;
    } else if (document.frmpatapp.password.value.length < 8) {
        alert("Должината на лозинката не треба да е помала од 8 карактери...");
        document.frmpatapp.password.focus();
        return false;
    } else if (document.frmpatapp.select6.value == "") {
        alert("Полот не треба да е празен..");
        document.frmpatapp.select6.focus();
        return false;
    } else if (document.frmpatapp.dob.value == "") {
        alert("Датумот на раѓање не треба да е празен..");
        document.frmpatapp.dob.focus();
        return false;
    } else if (document.frmpatapp.appointmentdate.value == "") {
        alert("Датум за терминот не треба да е празен..");
        document.frmpatapp.appointmentdate.focus();
        return false;
    } else if (document.frmpatapp.appointmenttime.value == "") {
        alert("Времето на терминот не треба да е празно.");
        document.frmpatapp.appointmenttime.focus();
        return false;
    } else {
        return true;
    }
}

function loaddoctor(deptid) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("divdoc").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "departmentDoctor.php?deptid=" + deptid, true);
    xmlhttp.send();
}
</script>
