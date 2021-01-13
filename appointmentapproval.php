<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
		if(isset($_GET[editid]))
		{
				$sql ="UPDATE patient SET status='Active' WHERE patientid='$_GET[patientid]'";
				$qsql=mysqli_query($con,$sql);
			$roomid=0;
			$sql ="UPDATE appointment SET appointmenttype='$_POST[apptype]',departmentid='$_POST[select5]',doctorid='$_POST[select6]',status='Approved',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]' WHERE appointmentid='$_GET[editid]'";
			if($qsql = mysqli_query($con,$sql))
			{
				$roomid= $_POST[select3];
				$billtype = "Room Rent";
				include("insertbillingrecord.php");				
				echo "<script>alert('Терминот е ажуриран успешнп..');</script>";				
				echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[editid]';</script>";
			}
			else
			{
				echo mysqli_error($con);
			}	
		}
		else
		{
			$sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[select4]'";
			$qsql=mysqli_query($con,$sql);
				
			$sql ="INSERT INTO appointment(appointmenttype,patientid,roomid,departmentid,appointmentdate,appointmenttime,doctorid,status) values('$_POST[select2]','$_POST[select4]','$_POST[select3]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]')";
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
?>


<div class="card ">
 
    <h2>Процес за одобрување на термин</h2>
   <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
  
    <table class="table table-striped">                
        <tr>
          <td >Пациент</td>
          <td >
            <?php
			if(isset($_GET[patientid]))
			{
				$sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patientid]'";
				$qsqlpatient = mysqli_query($con,$sqlpatient);
				$rspatient=mysqli_fetch_array($qsqlpatient);
				echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])";
			}
			else
			{
				$sqlpatient= "SELECT * FROM patient WHERE status='Active'";
				$qsqlpatient = mysqli_query($con,$sqlpatient);
				while($rspatient=mysqli_fetch_array($qsqlpatient))
				{
					if($rspatient[patientid] == $rsedit[patientid])
					{
					echo "<option value='$rspatient[patientid]' selected> $rspatient[patientname](Patient ID - $rspatient[patientid])</option>";
					}
				}
			}
		  ?>
      </td>
        </tr>

        <tr>
          <td>Оддел</td>
          <td><select name="select5" id="select5" class="form-control show-tick">
           <option value="">Одбери</option>
            <?php
		  	$sqldepartment= "SELECT * FROM department WHERE status='Active'";
			$qsqldepartment = mysqli_query($con,$sqldepartment);
			while($rsdepartment=mysqli_fetch_array($qsqldepartment))
			{
				if($rsdepartment[departmentid] == $rsedit[departmentid])
				{
	echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
				}
				else
				{
  echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
				}
				
			}
		  ?>
          </select></td>
        </tr>
		
        <tr>
          <td>Доктор</td>
          <td><select name="select6" id="select6" class="form-control show-tick">
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
          </select></td>
        </tr>
		
        <tr>
          <td>Датум на преглед</td>
          <td><input class="form-control" type="date" name="appointmentdate" id="appointmentdate" value="<?php echo $rsedit[appointmentdate]; ?>" /></td>
        </tr>
        <tr>
          <td>Време на преглед</td>
          <td><input class="form-control" type="time" name="time" id="time" value="<?php echo $rsedit[appointmenttime]; ?>" /></td>
        </tr>
        <tr>
          <td>Причина за преглед</td>
          <td><input class="form-control" name="appreason" id="appreason" value="<?php echo $rsedit[app_reason]; ?>"/></td>         
        </tr>
        <tr>
          <td colspan="2" align="center"><input class="btn btn-default" type="submit" name="submit" id="submit" value="Потврди" /></td>
        </tr>
      </tbody>
    </table>
    </form>
    <p>&nbsp;</p>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
function validateform()
{
	if(document.frmappnt.select4.value == "")
	{
		alert("Името на пациентот не треба да е празно..");
		document.frmappnt.select4.focus();
		return false;
	}
	else if(document.frmappnt.select3.value == "")
	{
		alert("Тип на соба не треба да е празен.");
		document.frmappnt.select3.focus();
		return false;
	}
	else if(document.frmappnt.select5.value == "")
	{
		alert("Името на одделот не треба да е празно..");
		document.frmappnt.select5.focus();
		return false;
	}
	else if(document.frmappnt.appointmentdate.value == "")
	{
		alert("Датумот за термин не треба да е празен..");
		document.frmappnt.appointmentdate.focus();
		return false;
	}
	else if(document.frmappnt.time.value == "")
	{
		alert("Време на терминот не треба да е празно.");
		document.frmappnt.time.focus();
		return false;
	}
	else if(document.frmappnt.select6.value == "")
	{
		alert("Името на докторот не треба да е празно..");
		document.frmappnt.select6.focus();
		return false;
	}
	else if(document.frmappnt.select.value == "" )
	{
		alert("Ве молиме одберете статус..");
		document.frmappnt.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
$('.out_patient').hide();
$('#apptype').change(function()
{
	apptype=$('#apptype').val();
	if(apptype=='InPatient')
	{
		$('.out_patient').show();
	}
	else
	{
		$('.out_patient').hide();
	}
});
</script>