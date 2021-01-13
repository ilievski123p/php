<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST["submitfullamount"]))
{
  $sql ="INSERT INTO payment(patientid,appointmentid,paiddate,paidtime,paidamount,status) values('$_GET[patientid]','$_GET[appointmentid]','$dt','$tim','$_POST[paidamount]','Active')";
  if($qsql = mysqli_query($con,$sql))
  {
   echo "<script>alert('Извештајот за плаќање е успешно додаден..');</script>";
 }
 else
 {
   echo mysqli_error($con);
 }

 $sql ="UPDATE billing SET discount=$_POST[discountamount]+ discount, discountreason=CONCAT('$_POST[discountreason] , ', discountreason),discharge_time='$_POST[dischargetime]',discharge_date='$_POST[dischargedate]' WHERE appointmentid='$_GET[appointmentid]'";
 $qsql = mysqli_query($con,$sql);
 echo mysqli_error($con);

 echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[appointmentid]'</script>";
}
if(isset($_SESSION[patientid]))
{
	$sql="SELECT * FROM payment WHERE paymentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
$billappointmentid = $_GET[appointmentid];
?>
<div class="container-fluid">
  <div class="block-header">
    <h2>Направи наплата</h2>

  </div>

  <div class="card" style="padding: 10px">


      <?php
      include("viewpaymentreport.php");
      ?>   

      <section class="container">
      <form method="post" action="">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th colspan="2">Отпуст</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Датум на отпуст</td>
              <td><input class="form-control" name="dischargedate" type="text" id="dischargedate" value="<?php echo date("Y-m-d"); ?>" readonly></td>
            </tr>
            <tr>
              <td>Време на отпуст</td>
              <td><input class="form-control" name="dischargetime" type="text" id="dischargetime" value="<?php echo date("h:i:s"); ?>" readonly></td>
            </tr>
            <tr>
              <td>Износ на баланс</td>
              <td><input class="form-control" name="balamt" type="text" id="balamt" value="<?php echo $balanceamt; ?>" readonly onkeyup="calculatepayable()"></td>
            </tr>
            <tr>
              <td>Попуст *</td>
              <td><input class="form-control" name="discountamount" type="text" id="discountamount" value="0" onkeyup="calculatepayable()"></td>
            </tr>
            <tr>
              <td>Износ за плаќање</td>
              <td><input class="form-control" name="paidamount" type="text" id="paidamount" value="<?php echo $balanceamt; ?>" readonly></td>
            </tr>
            <tr>
              <td>Причина за попуст</td>
              <td><textarea name="discountreason" id="discountreason"></textarea></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input class="form-control" type="submit" name="submitfullamount" id="submitfullamount" value="Потврди" /></td>
            </tr>
          </tbody>
        </table> 
      </form>    

      <table width="342" border="3">
        <thead>
          <tr>
            <td colspan="2" align="center"><a href='patientreport.php?patientid=<?php echo $_GET[patientid]; ?>&appointmentid=<?php echo $_GET[appointmentid]; ?>'><strong>Погледни извештај за пациент>></strong></a></td>
          </tr>
        </thead>
      </table>   
</section>   
</div>
</div>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
  function calculatepayable()
  {
   document.getElementById("paidamount").value = document.getElementById("balamt").value - document.getElementById("discountamount").value
 }
</script>