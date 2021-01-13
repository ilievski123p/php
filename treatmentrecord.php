<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	$filename = rand(). $_FILES[uploads][name];
	move_uploaded_file($_FILES["uploads"]["tmp_name"],"treatmentfiles/".$filename);
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE treatment_records SET appointmentid='$_POST[select2]',treatmentid='$_POST[select4]',patientid='$_POST[patientid]',doctorid='$_POST[select5]',treatment_description='$_POST[textarea]',uploads='$filename',treatment_date='$_POST[treatmentdate]',treatment_time='$_POST[treatmenttime]',status='Active' WHERE appointmentid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Извештајот за лекување е успешно ажуриран..');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO treatment_records(appointmentid,treatmentid,patientid,doctorid,treatment_description,uploads,treatment_date,treatment_time,status) values('$_POST[select2]','$_POST[select4]','$_POST[patientid]','$_POST[select5]','$_POST[textarea]','$filename','$_POST[treatmentdate]','$_POST[treatmenttime]','Active')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con)>=1)
		{
			echo "<script>alert('Извештајот за лекување е успешно додаден..');</script>";
		}
	$doctorid= $_POST[select5];
	$billtype = "Doctor Charge";
	
	$treatmentid= $_POST[select4];
	$billtype1="Treatment Cost";
	include("insertbillingrecord.php");	
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM treatment_records WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM treatment_records WHERE appointmentid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Закажаниот термин е успешно избришан.');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2>Додај нови извештаи за лекување</h2>

  </div>

  <div class="card" style="padding: 10px">

    <form method="post" action="" name="frmtreatrec" onSubmit="return validateform()" enctype="multipart/form-data">
    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <td width="40%">Термин</td>
          <td width="60%">
          <input class="form-control" type="text" readonly name="select2" value="<?php echo $_GET[appid]; ?>"  /></td>
        </tr>
        <tr>
          <td>Пациент</td>
          <td>
          <input class="form-control" type="hidden" name="patientid" value="<?php echo $_GET[patientid]; ?>" />
<?php
$sqlpatient= "SELECT * FROM patient WHERE status='Active' AND patientid='$_GET[patientid]'";
$qsqlpatient = mysqli_query($con,$sqlpatient);
$rspatient=mysqli_fetch_array($qsqlpatient);
?>			
          <input class="form-control" type="text" readonly name="select3" value="<?php echo $rspatient[patientname]; ?>"  />
</td>
        </tr>
        
        <tr>
          <td>Одбери тип на лекување</td>
          <td>          
          <select name="select4" id="select4" class="form-control show-tick">
           <option value="">Одбери</option>
            <?php
		  	$sqltreatment= "SELECT * FROM treatment WHERE status='Active'";
			$qsqltreatment = mysqli_query($con,$sqltreatment);
			while($rstreatment=mysqli_fetch_array($qsqltreatment))
			{
				if($rstreatment[treatmentid] == $rsedit[treatmentid])
				{
				echo "<option value='$rstreatment[treatmentid]' selected>$rstreatment[treatmenttype]  - (Tk. $rstreatment[treatment_cost])</option>";
				}
				else
				{
					echo "<option value='$rstreatment[treatmentid]'>$rstreatment[treatmenttype]  - (Tk. $rstreatment[treatment_cost])</option>";
				}
				
			}
		  ?>
 </select></td>
        </tr>
        
        
        <?php
		if(isset($_SESSION[doctorid]))
		{
		?>
        <tr>
          <td>Doctor</td>
          <td>
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active' AND doctor.doctorid='$_SESSION[doctorid]'";
				$qsqldoctor = mysqli_query($con,$sqldoctor);
				while($rsdoctor = mysqli_fetch_array($qsqldoctor))
				{
					echo "$rsdoctor[doctorname] ( $rsdoctor[departmentname] )";
				}
				?>
                <input class="form-control" type="hidden" name="select5" value="<?php echo $_SESSION[doctorid]; ?>"  />
          </td>
        <?php
		}
		else
		{
		?>
        <tr>
          <td>Доктор</td>
          <td>
          <select name="select5" id="select5">
    		<option value="">Одбери</option>
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
				$qsqldoctor = mysqli_query($con,$sqldoctor);
				while($rsdoctor = mysqli_fetch_array($qsqldoctor))
				{
					if($rsdoctor[doctorid] == $rsedit[doctorid])
					{
					echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
					}
					else
					{
					echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";				
					}
				}
		  		?>
          	</select>
          </td>
        <?php
		}
		?>
          
       
        </tr>
        <tr>
          <td>Опис на третманот</td>
          <td><input class="form-control" name="textarea" id="textarea" cols="45" rows="5"><?php echo $rsedit[treatment_description] ; ?></textarea></td>
        </tr>
        <tr>
          <td>Фајлови за третманот</td>
          <td><input class="form-control" type="file" name="uploads" id="uploads" value="<?php echo $rsedit[uploads]; ?>" /></td>
        </tr>
        <tr>
          <td>Датум на лекување</td>
          <td><input class="form-control" type="date" max="<?php echo date("Y-m-d"); ?>" name="treatmentdate" id="treatmentdate" value="<?php echo $rsedit[treatment_date]; ?>" /></td>
         
        </tr>
        <tr>
          <td>Време на лекување</td>
          <td><input class="form-control" type="time" name="treatmenttime" id="treatmenttime" value="<?php echo $rsedit[treatment_time]; ?>" /></td>
        </tr>

        <tr>
          <td colspan="2" align="center"><input class="form-control" type="submit" name="submit" id="submit" value="Потврди" /> | <a href='patientreport.php?patientid=<?php echo $_GET[patientid]; ?>&appointmentid=<?php echo $_GET[appid]; ?>'><strong>View Patient Report>></strong></a></td>
        </tr>
      </tbody>
    </table>
    </form>
    <p>&nbsp;</p>
          <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <td width="71">Тип на лекување</td>
            <td width="78">Доктор</td>
            <td width="82">Опис</td>
            <td width="103">Прикачувања</td>
            <td width="43">Датум на лекување</td>
            <td width="43">Време на лекување</td>
            <td width="54">Статус</td>
            <td width="58">Акција</td>
          </tr>
          <?php
		$sql ="SELECT * FROM treatment_records WHERE patientid='$_GET[patientid]' AND appointmentid='$_GET[appid]' ";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpat = mysqli_query($con,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);
			
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoc = mysqli_query($con,$sqldoc);
			$rsdoc = mysqli_fetch_array($qsqldoc);
			
			$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$rs[treatmentid]'";
			$qsqltreatment = mysqli_query($con,$sqltreatment);
			$rstreatment = mysqli_fetch_array($qsqltreatment);
			
        echo "<tr>
          <td>&nbsp;$rstreatment[treatmenttype]</td>
		    <td>&nbsp;$rsdoc[doctorname]</td>
			<td>&nbsp;$rs[treatment_description]</td>
			<td>&nbsp;<a href='treatmentfiles/$rs[uploads]'>Превземи</a></td>
			 <td>&nbsp;$rs[treatment_date]</td>
			  <td>&nbsp;$rs[treatment_time]</td>
			    <td>&nbsp;$rs[status]</td>
          <td>&nbsp;
		  <a href='treatmentrecord.php?editid=$rs[appointmentid]&patientid=$_GET[patientid]&appid=$_GET[appid]'>Edit</a>| <a href='treatmentrecord.php?delid=$rs[appointmentid]&patientid=$_GET[patientid]&appointmentid=$_GET[appid]'>Избриши</a> </td>
        </tr>";
		}
		?>
        </tbody>
      </table>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmtreatrec.select2.value == "")
	{
		alert("ИД на терминот не треба да е празно..");
		document.frmtreatrec.select2.focus();
		return false;
	}
	
	else if(document.frmtreatrec.select4.value == "")
	{
		alert("ИД на третманот не треба да е празно.");
		document.frmtreatrec.select4.focus();
		return false;
	}
	else if(document.frmtreatrec.select3.value == "")
	{
		alert("ИД на пациентот не треба да е празно..");
		document.frmtreatrec.select3.focus();
		return false;
	}
	else if(document.frmtreatrec.select5.value == "")
	{
		alert("ИД на докторот не треба да е празно.");
		document.frmtreatrec.select5.focus();
		return false;
	}
	else if(document.frmtreatrec.textarea.value == "")
	{
		alert("Описот на лекување не треба да е празен..");
		document.frmtreatrec.textarea.focus();
		return false;
	}
	else if(document.frmtreatrec.treatmentdate.value == "")
	{
		alert("Датумот за лекување не треба да е празен..");
		document.frmtreatrec.treatmentdate.focus();
		return false;
	}
	else if(document.frmtreatrec.treatmenttime.value == "")
	{
		alert("Времето за лекување не треба да е празно.");
		document.frmtreatrec.treatmenttime.focus();
		return false;
	}
	else if(document.frmtreatrec.select.value == "" )
	{
		alert("Ве молиме одберете статус..");
		document.frmtreatrec.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>