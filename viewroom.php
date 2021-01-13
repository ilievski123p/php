<?php
include("header.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM room WHERE roomid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Собата е успешно избришана..');</script>";
	}
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Погледни соба</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Погледни детали за соба</h1>
    <table width="200" border="3">
      <tbody>
        <tr>
          <td width="21%">Тип на соба</td>
          <td width="21%">Број на соба</td>
          <td width="30%">Број на кревети</td>
            <td width="30%">Тарифа на соба</td>
          <td width="14%">Статус</td>
          <td width="14%">Акција</td>
        </tr>
          <?php
		$sql ="SELECT * FROM room";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[roomtype]</td>
          <td>&nbsp;$rs[roomno]</td>
		   <td>&nbsp;$rs[noofbeds]</td>
		   <td>&nbsp;$rs[room_tariff]</td>
		<td>&nbsp;$rs[status]</td>
		 <td>&nbsp;<a href='room.php?editid=$rs[roomid]'>Измени</a> | <a href='viewroom.php?delid=$rs[roomid]'>Избриши</a> </td>
        </tr>";
		}
		?>
      </tbody>
    </table>
    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>