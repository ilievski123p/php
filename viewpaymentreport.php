<?php
session_start();
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM billing_records WHERE billingid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Записот за сметка е успешно избришан..');</script>";
	}
}

?>
 <section class="container">
<?php
$sqlbilling_records ="SELECT * FROM billing WHERE appointmentid='$billappointmentid'";
$qsqlbilling_records = mysqli_query($con,$sqlbilling_records);
$rsbilling_records = mysqli_fetch_array($qsqlbilling_records);
?>
 	<table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <th scope="col"><div align="right">Број на сметка &nbsp; </div></th>
          <td><?php echo $rsbilling_records[billingid]; ?></td>
          <td>Име на термин &nbsp;</td>
          <td><?php echo $rsbilling_records[appointmentid]; ?></td>
        </tr>
        <tr>
          <th width="442" scope="col"><div align="right">Датум на сметка &nbsp; </div></th>
          <td width="413"><?php echo $rsbilling_records[billingdate]; ?></td>
          <td width="413">Време на сметка&nbsp; </td>
          	<td width="413"><?php echo $rsbilling_records[billingtime] ; ?></td>
        </tr>
         
		<tr>
          <th scope="col"><div align="right"></div></th>
          <td></td>
          <th scope="col"><div align="right">Износ на сметка &nbsp; </div></th>
          <td><?php
		$sql ="SELECT * FROM billing_records where billingid='$rsbilling_records[billingid]'";
		$qsql = mysqli_query($con,$sql);
		$billamt= 0;
		while($rs = mysqli_fetch_array($qsql))
		{
			$billamt = $billamt +  $rs[bill_amount];
		}
?>
  &nbsp;Tk. <?php echo $billamt; ?></td>
        </tr>
        <tr>
          <th width="442" scope="col"><div align="right"></div></th>
          <td width="413">&nbsp;</td>
          <th width="442" scope="col"><div align="right">ДДВ Износ (5%) &nbsp; </div></th>
          <td width="413">&nbsp;Tk. <?php echo $taxamt = 5 * ($billamt / 100); ?></td>
       	</tr>
         
		<tr>
		  <th scope="col"><div align="right">Причина за попуст</div></th>
		  <td rowspan="4" valign="top"><?php echo $rsbilling_records[discountreason]; ?></td>
		  <th scope="col"><div align="right">Попуст &nbsp; </div></th>
		  <td>&nbsp;Tk. <?php echo $rsbilling_records[discount]; ?></td>
	    </tr>
        
		<tr>
		  <th rowspan="3" scope="col">&nbsp;</th>
		  <th scope="col"><div align="right">Вкупно за плаќање &nbsp; </div></th>
		  <td>&nbsp;Tk. <?php echo $grandtotal = ($billamt + $taxamt)  - $rsbilling_records[discount] ; ?></td>
	    </tr>
		<tr>
		  <th scope="col"><div align="right">Платен износ </div></th>
		  <td>Tk. <?php
		  	$sqlpayment ="SELECT sum(paidamount) FROM payment where appointmentid='$billappointmentid'";
			$qsqlpayment = mysqli_query($con,$sqlpayment);
			$rspayment = mysqli_fetch_array($qsqlpayment);
			echo $rspayment[0];		  
		   ?></td>
	    </tr>
		<tr>
		  <th scope="col"><div align="right">Износ на баланс</div></th>
		  <td>Tk. <?php echo $balanceamt = $grandtotal - $rspayment[0]  ; ?></td>
	    </tr>
      </tbody>
    </table>
   <p><strong>Извештај за плаќање:</strong></p>
<?php
$sqlpayment = "SELECT * FROM payment where appointmentid='$billappointmentid'";
$qsqlpayment = mysqli_query($con,$sqlpayment);
if(mysqli_num_rows($qsqlpayment) == 0)
{
	echo "<strong>No transaction details found..</strong>";
}
else
{
?>
   <table class="table table-bordered table-striped">
     <tbody>
       <tr>
         <th scope="col">Датум на плаќање</th>
         <th scope="col">Време на плаќање</th>
         <th scope="col">Платен износ</th>
       </tr>
<?php       
		while($rspayment = mysqli_fetch_array($qsqlpayment))
		{
		?>
			   <tr>
				 <td>&nbsp;<?php echo $rspayment[paiddate]; ?></td>
				 <td>&nbsp;<?php echo $rspayment[paidtime]; ?></td>
				 <td>&nbsp;Tk. <?php echo $rspayment[paidamount]; ?></td>
			   </tr>
		<?php
		}
?>

     </tbody>
   </table>
<?php
}
?>   
   <p><strong></strong></p>
</section>