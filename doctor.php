<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE doctor SET doctorname='$_POST[doctorname]',mobileno='$_POST[mobilenumber]',departmentid='$_POST[select3]',loginid='$_POST[loginid]',password='$_POST[password]',status='$_POST[select]',education='$_POST[education]',experience='$_POST[experience]',consultancy_charge='$_POST[consultancy_charge]' WHERE doctorid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Профилот за докторот е ажуриран успешно...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO doctor(doctorname,mobileno,departmentid,loginid,password,status,education,experience,consultancy_charge) values('$_POST[doctorname]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','Active','$_POST[education]','$_POST[experience]','$_POST[consultancy_charge]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Профилот за докторот е додаден успешно..');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM doctor WHERE doctorid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="container-fluid">
	<div class="block-header">
		<h2> Додај нов доктор </h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">


				<form method="post" action="" name="frmdoct" onSubmit="return validateform()" style="padding: 10px">


					
					<div class="form-group"><label>Име на доктор</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="doctorname" id="doctorname" value="<?php echo $rsedit[doctorname]; ?>" />
				</div>
				</div>


					<div class="form-group"><label>Мобилен телефон</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Оддел</label> 
						<div class="form-line">
					<select  name="select3" id="select3" class="form-control show-tick">
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
					</select>
				</div>
			</div>

					<div class="form-group"><label>Логин ID</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="loginid" id="loginid" value="<?php echo $rsedit[loginid]; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Лозинка/label> 
					<div class="form-line">
					<input class="form-control" type="password" name="password" id="password" value="<?php echo $rsedit[password]; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Потврди лозника</label> 
					<div class="form-line">
					<input class="form-control" type="password" name="cnfirmpassword" id="cnfirmpassword" value="<?php echo $rsedit[password]; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Образование</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="education" id="education" value="<?php echo $rsedit[education]; ?>" />
				</div>
				</div>


					<div class="form-group"><label>Работно искуство</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="experience" id="experience" value="<?php echo $rsedit[experience]; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Цена за консултации</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="consultancy_charge" id="consultancy_charge" value="<?php echo $rsedit[experience]; ?>"/>
				</div>
				</div>

					<div class="form-group">
					<label>Статус</label> 
					<div class="form-line">
					<select class="form-control show-tick" name="select" id="select">
						<option value="" selected="" hidden>Одбери</option>
						<?php
						$arr= array("Active","Inactive");
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
					</select>
				</div>
				</div>


					
					<input class="btn btn-default" type="submit" name="submit" id="submit" value="Потврди" />
				


				</form>
			</div>
		</div>
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
	if(document.frmdoct.doctorname.value == "")
	{
		alert("Името на докторот не треба да е празно.");
		document.frmdoct.doctorname.focus();
		return false;
	}
	else if(!document.frmdoct.doctorname.value.match(alphaspaceExp))
	{
		alert("Името на докторот не е валидно.");
		document.frmdoct.doctorname.focus();
		return false;
	}
	else if(document.frmdoct.mobilenumber.value == "")
	{
		alert("Мобилниот телефон не треба да е празен..");
		document.frmdoct.mobilenumber.focus();
		return false;
	}
	else if(!document.frmdoct.mobilenumber.value.match(numericExpression))
	{
		alert("Мобилниот телефон не е валиден.");
		document.frmdoct.mobilenumber.focus();
		return false;
	}
	else if(document.frmdoct.select3.value == "")
	{
		alert("ID на одделот не треба да е празно..");
		document.frmdoct.select3.focus();
		return false;
	}
	else if(document.frmdoct.loginid.value == "")
	{
		alert("ID за најава не треба да е празно..");
		document.frmdoct.loginid.focus();
		return false;
	}
	else if(!document.frmdoct.loginid.value.match(alphanumericExp))
	{
		alert("ID за најава не е валидно.");
		document.frmdoct.loginid.focus();
		return false;
	}
	else if(document.frmdoct.password.value == "")
	{
		alert("Лозинката не треба да е празна..");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.password.value.length < 8)
	{
		alert("Големината на лозинката треба да е над 8 карактери...");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.password.value != document.frmdoct.cnfirmpassword.value )
	{
		alert("Лозинката и потврди лозинка треба да имаат иста вредност..");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.education.value == "")
	{
		alert("Образование не треба да е празно.");
		document.frmdoct.education.focus();
		return false;
	}
	else if(!document.frmdoct.education.value.match(alphaExp))
	{
		alert("Образованието не е валидно..");
		document.frmdoct.education.focus();
		return false;
	}
	else if(document.frmdoct.experience.value == "")
	{
		alert("Работното искуство не треба да е празно..");
		document.frmdoct.experience.focus();
		return false;
	}
	else if(!document.frmdoct.experience.value.match(numericExpression))
	{
		alert("Работното искуство не е валидно..");
		document.frmdoct.experience.focus();
		return false;
	}
	else if(document.frmdoct.select.value == "" )
	{
		alert("Ве молиме одберете статус..");
		document.frmdoct.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>