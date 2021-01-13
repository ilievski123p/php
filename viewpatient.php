<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM patient WHERE patientid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Записот за пациентот е успешно избришан..');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2>Погледни записи за пациенти</h2>

  </div>

<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

      <thead>
        <tr>
          <th width="15%" height="36"><div align="center">Име на пациент</div></th>
          <th width="20%"><div align="center">Детали за примање</div></th>
          <th width="28%"><div align="center">Адреса</div></th>    
          <th width="20%"><div align="center">Профил на пациентот</div></th>
          <th width="17%"><div align="center">Акција</div></th>
        </tr>
      </thead>
      <tbody>
       <?php
       $sql ="SELECT * FROM patient";
       $qsql = mysqli_query($con,$sql);
       while($rs = mysqli_fetch_array($qsql))
       {
        echo "<tr>
        <td>$rs[patientname]<br>
        <strong>Логин ИД :</strong> $rs[loginid] </td>
        <td>
        <strong>Датум</strong>: &nbsp;$rs[admissiondate]<br>
        <strong>Време</strong>: &nbsp;$rs[admissiontime]</td>
        <td>$rs[address]<br>$rs[city] -  &nbsp;$rs[pincode]<br>
        Тел. - $rs[mobileno]</td>
        <td><strong>Крвна група</strong> - $rs[bloodgroup]<br>
        <strong>Пол</strong> - &nbsp;$rs[gender]<br>
        <strong>DOB</strong> - &nbsp;$rs[dob]</td>
        <td align='center'>Статус - $rs[status] <br>";
        if(isset($_SESSION[adminid]))
        {
          echo "<a href='patient.php?editid=$rs[patientid]' class='btn btn-sm btn-raised g-bg-cyan'>Edit</a><a href='viewpatient.php?delid=$rs[patientid]' class='btn btn-sm btn-raised g-bg-blush2'>Избриши</a> <hr>
          <a href='patientreport.php?patientid=$rs[patientid]' class='btn btn-sm btn-raised'>Погледни извештај</a>";
        }
        echo "</td></tr>";
      }
      ?>
    </tbody>
  </table>
</section>

</div>
</div>
<?php
include("adformfooter.php");
?>