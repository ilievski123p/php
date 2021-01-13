<?php
session_start();
include("dbconnection.php");
?>
		
<table class="table table-bordered table-striped">
          <tr>
            <td><strong>Тип на лекување</strong></td>
            <td><strong>Датум и  & време на третманот</strong></td>
            <td><strong>Доктор</strong></td>
            <td><strong>Опис на лекувањето</strong></td>
            <td><strong>Цена за лекувањето</strong></td>
          </tr>
          <?php
		 $sql ="SELECT * FROM treatment_records LEFT JOIN treatment ON treatment_records.treatmentid=treatment.treatmentid WHERE treatment_records.patientid='$_GET[patientid]' AND treatment_records.appointmentid='$_GET[appointmentid]'";
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
					</td><td>&nbsp;" . date("d-m-Y",strtotime($rs[treatment_date])). "  &nbsp;". date("h:i A",strtotime($rs[treatment_time])) . "</td>
					<td>&nbsp;$rsdoc[doctorname]</td>
					<td>&nbsp;$rs[treatment_description]";
if(file_exists("treatmentfiles/$rs[uploads]"))
{
	if($rs[uploads] != "")
	{
		echo "<br><a href='treatmentfiles/$rs[uploads]'>Превземи</a>";
	}
}
					echo "</td>";
			echo "<td>₹$rs[treatment_cost]</td></tr>";
		}
		?>
</table>
<?php
if(isset($_SESSION[doctorid]))
{
?>  
<hr>
	<table>
	<tr>
	<td><div align="center"><strong><a href="treatmentrecord.php?patientid=<?php echo $_GET[patientid]; ?>&appid=<?php echo $rsappointment[appointmentid]; ?>">Додај нови лекувања</a></strong></div></td>
	</tr>
	</table>
<?php
}
?>
<script type="application/javascript">
function validateform()
{
	if(document.frmtreatdetail.select.value == "")
	{
		alert("Името на третманот не треба да е празно..");
		document.frmtreatdetail.select.focus();
		return false;
	}
	
	else if(document.frmtreatdetail.select2.value == "")
	{
		alert("Името на докторот не треба да е празно.");
		document.frmtreatdetail.select2.focus();
		return false;
	}
	else if(document.frmtreatdetail.textarea.value == "")
	{
		alert(" Описот не треба да е празен.");
		document.frmtreatdetail.textarea.focus();
		return false;
	}
	else if(document.frmtreatdetail.treatmentfile.value == "")
	{
		alert("Фајлот не треба да е празен.");
		document.frmtreatdetail.treatmentfile.focus();
		return false;
	}
	else if(document.frmtreatdetail.date.value == "")
	{
		alert("Датумот не треба да  е празен.");
		document.frmtreatdetail.date.focus();
		return false;
	}
	else if(document.frmtreatdetail.time.value == "")
	{
		alert("Времето не треба да е празно.");
		document.frmtreatdetail.time.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
