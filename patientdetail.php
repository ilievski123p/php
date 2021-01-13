<?php
include("dbconnection.php");
if(isset($_POST[submitpat]))
{
	$sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,gender,dob) values('$_POST[patientname]','$_POST[admissiondate]','$_POST[admissiontime]','$_POST[address]','$_POST[mobilenumber]','$_POST[select]','$_POST[dateofbirth]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Податоците за пациентот се успешно изменети..');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

if(isset($_GET[editid]))
{
	$sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>
<?php
if(!isset($_GET[patientid]))
{
?>
<div class="container-fluid">
        <div class="block-header">
            <h2>Закажи преглед</h2>
            
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					
					<div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="patientname" id="patientname"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="patientid" id="patientid" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="address" id="address" cols="45" rows="5"> </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group drop-custum">
                                    <select class="form-control show-tick">
                                        <option value="">-- Пол --</option>
                                        <option value="10">Машки</option>
                                        <option value="20">Женски</option>
                                    </select>
                                </div>
                            </div>
                         
                            <div class="col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="mobilenumber" id="mobilenumber"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" name="dateofbirth" id="dateofbirth" />
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-raised" name="submitpat" id="submitpat" value="Потврди" />
                                
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
    </div>
<form method="post" action="" name="frmpatdet" onSubmit="return validateform()">
      <table class="table table-bordered table-striped">
      <tbody>
     <tr>
                <td width="17%"><strong>Име на пациентот</strong></td>
                <td width="41%"><input type="text" name="patientname" id="patientname"/></td>
                <td width="16%"><strong>ИД на пациентот</strong></td>
                <td width="26%"><input type="text" name="patientid" id="patientid" /></td>
        </tr>
              <tr>
                <td><strong>Адреса</strong></td>
                <td align="right"><textarea name="address" id="address" cols="45" rows="5"> </textarea></td>
                <td><strong>Пол</strong></td>
                <td><label for="select"></label>
                  <select name="select" id="select">
                    <option value="">Одбери</option>
                    <option value="Male">Машки</option>
                    <option value="Female">Женски</option>
                  </select></td>
              </tr>
              <tr>
                <td><strong>Број за контакт</strong></td>
                <td><input type="text" name="mobilenumber" id="mobilenumber"/></td>
                <td><strong>Датум на раѓање</strong></td>
                <td><input type="date" name="dateofbirth" id="dateofbirth" /></td>
              </tr>
              <tr>
                <td colspan="4" align="center"><input type="submit" name="submitpat" id="submitpat" value="Потврди" /></td>
              </tr>
        </tbody>
  </table>       
    </form>
<?php
}
else
{
$sqlpatient = "SELECT * FROM patient where patientid='$_GET[patientid]'";
$qsqlpatient = mysqli_query($con,$sqlpatient);
$rspatient=mysqli_fetch_array($qsqlpatient);
?>

    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <td width="16%"><strong>Име на пациентот </strong></td>
          <td width="34%">&nbsp;<?php echo $rspatient[patientname]; ?></td>
          <td width="16%"><strong>Patient ID</strong></td>
          <td width="34%">&nbsp;<?php echo $rspatient[patientid]; ?></td>
        </tr>
        <tr>
          <td><strong>Адреса</strong></td>
          <td>&nbsp;<?php echo $rspatient[address]; ?></td>
          <td><strong>Gender</strong></td>
          <td> <?php echo $rspatient[gender];?></td>
        </tr>
        <tr>
          <td><strong>Број за контакт</strong></td>
          <td>&nbsp;<?php echo $rspatient[mobileno]; ?></td>
          <td><strong>Date Of Birth </strong></td>
          <td>&nbsp;<?php echo $rspatient[dob]; ?></td>
        </tr>
      </tbody>
    </table>
<?php
}

?>


<script type="application/javascript">
function validateform()
{
	if(document.frmpatdet.patientname.value == "")
	{
		alert("Името на пациентот не треба да е празно..");
		document.frmpatdet.patientname.focus();
		return false;
	}
	else if(document.frmpatdet.patientid.value == "")
	{
		alert("ИД на пациентот не треба да е празно..");
		document.frmpatdet.patientid.focus();
		return false;
	}
	else if(document.frmpatdet.admissiondate.value == "")
	{
		alert("Датум на примање не треба да е празно..");
		document.frmpatdet.admissiondate.focus();
		return false;
	}
	else if(document.frmpatdet.admissiontime.value == "")
	{
		alert("Време на примање не треба да е  празно.");
		document.frmpatdet.admissiontime.focus();
		return false;
	}
	else if(document.frmpatdet.address.value == "")
	{
		alert("Адресата не треба да е празна
		..");
		document.frmpatdet.address.focus();
		return false;
	}
	else if(document.frmpatdet.select.value == "")
	{
		alert("ПОлот не треба да е празен
		.");
		document.frmpatdet.select.focus();
		return false;
	}
	else if(document.frmpatdet.mobilenumber.value == "")
	{
		alert("Број за контакт не треба да е празен.");
		document.frmpatdet.mobilenumber.focus();
		return false;
	}
	else if(document.frmpatdet.dateofbirth.value == "")
	{
		alert("Датум на раѓање не треба да е празен..");
		document.frmpatdet.dateofbirth.focus();
		return false;
	}
	
	else
	{
		return true;
	}
}
</script>