<?php
include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE service_type SET service_type='$_POST[servicetype]',servicecharge='$_POST[servicecharge]',description='$_POST[textarea]',status= '$_POST[select]' WHERE service_type_id='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Типот на услуга е успешно ажуриран..');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO service_type(service_type,servicecharge,description,status) values('$_POST[servicetype]','$_POST[servicecharge]','$_POST[textarea]','$_POST[select]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Типот на услуга е успешно додаден..');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM service_type WHERE service_type_id='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first">Додај нов тип на услуга</li></ul>
  </div>
</div>
<div class="wrapper col4">
  <div id="container">
    <h1>Додај нова услуга</h1>
    <form method="post" action="" name="frmserv" onSubmit="return validateform()">
    <table width="200" border="3">
      <tbody>
        <tr>
          <td width="34%">Тип</td>
          <td width="66%"><input type="text" name="servicetype" id="servicetype" value="<?php echo $rsedit[service_type]; ?>" /></td>
        </tr>
        <tr>
          <td>Цена на услуга</td>
          <td><input type="text" name="servicecharge" id="servicecharge"  value="<?php echo $rsedit[servicecharge]; ?>" /></td>
        </tr>
        <tr>
          <td>Опис</td>
          <td><textarea name="textarea" id="textarea" cols="45" rows="5"><?php echo $rsedit[description] ; ?></textarea></td>
        </tr>
        <tr>
          <td>Статус</td>
          <td><select name="select" id="select">
          <option value="">Одбери</option>
          <?php
		  $arr = array("Active","Inactive");
		  foreach($arr as $val)
		  {
			 if($val == $rsedit[status])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
           </select></td>
        </tr>
         
        <tr>
          <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Потврди" /></td>
        </tr>
      </tbody>
    </table>
    </form>
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
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmserv.servicetype.value == "")
	{
		alert("Типот на услуга не треба да е празен.");
		document.frmserv.servicetype.focus();
		return false;
	}
	else if(!document.frmserv.servicetype.value.match(alphaExp))
	{
		alert("Типот на услуга не е валиден..");
		document.frmserv.servicetype.focus();
		return false;
	}
	else if(document.frmserv.servicecharge.value == "")
	{
		alert("Цената на услуга не треба да е празна.");
		document.frmserv.servicecharge.focus();
		return false;
	}
	else if(!document.frmserv.servicecharge.value.match(numericExpression))
	{
		alert("Цената на услуга не е валидна..");
		document.frmserv.servicecharge.focus();
		return false;
	}
	else if(document.frmserv.textarea.value == "")
	{
		alert("Описот не треба да е празен..");
		document.frmserv.textarea.focus();
		return false;
	}
	else if(document.frmserv.select.value == "" )
	{
		alert("ве молиме одберете статус.");
		document.frmserv.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>