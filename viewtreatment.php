<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM treatment WHERE treatmentid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Треманот е успешно избришан..');</script>";
	}
}
?>


<div class="container-fluid">
  <div class="block-header">
    <h2>Погледни извештај за третман</h2>

  </div>

  <div class="card">

    <section class="container">
     <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
      <tbody>
        <tr>
          <td><strong>Тип на третман</strong></td>
          <td><strong>Цена на третман</strong></td>
          <td><strong>Забелешки</strong></td>
          <td><strong>Статус</strong></td>
          <?php
          if(isset($_SESSION[adminid]))
          {
            ?>
            <td><strong>Акција</strong></td>
            <?php
          }
          ?>
        </tr>
        <?php
        $sql ="SELECT * FROM treatment";
        $qsql = mysqli_query($con,$sql);
        while($rs = mysqli_fetch_array($qsql))
        {
          echo "<tr>
          <td>&nbsp;$rs[treatmenttype]</td>
          <td>&nbsp;Tk.$rs[treatment_cost]</td>
          <td>&nbsp;$rs[note]</td>
          <td>&nbsp;$rs[status]</td>";
          if(isset($_SESSION[adminid]))
          {
            echo "<td>&nbsp;
            <a href='treatment.php?editid=$rs[treatmentid]' class='btn btn-raised g-bg-cyan'>Измени</a> 
            <a href='viewtreatment.php?delid=$rs[treatmentid]' class='btn btn-raised g-bg-blush2'>Избриши</a> </td>";
          }
          echo "</tr>";
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