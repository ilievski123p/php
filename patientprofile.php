<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
		$sql ="UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',bloodgroup='$_POST[select2]',gender='$_POST[select3]',dob='$_POST[dateofbirth]' WHERE patientid='$_SESSION[patientid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Пациентот е ажуриран успешно...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
}
if(isset($_SESSION[patientid]))
{
	$sql="SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>



<div class="container-fluid">
        <div class="block-header">
            <h2>Профил на пациентот</h2>
            
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
				<form method="post" action="" name="frmpatprfl" onSubmit="return validateform()">
					<div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                	<label for="">Име на пациентот</label>
                                    <div class="form-line">
                                    	
                                        <input class="form-control" type="text" name="patientname" id="patientname"  value="<?php echo $rsedit[patientname]; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                	<label for="">Датум на примање</label>
                                    <div class="form-line">
                                    	
                                        <input class="form-control" type="date" name="admissiondate" id="admissiondate" value="<?php echo $rsedit[admissiondate]; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                	<label for="admissiontme">Време на примање</label>
                                    <div class="form-line">                                 	
                                    	
                                        <input class="form-control" type="time" name="admissiontme" id="admissiontme" value="<?php echo $rsedit[admissiontime]; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group ">
                                	<label for="">Адреса</label>
                                	<div class="form-line">
                                    <input class="form-control" name="address" id="address" value="<?php echo $rsedit[address]; ?>" /> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                	<label for="">Мобилен телефон</label>
                                	<div class="form-line">
                                    <input class="form-control" type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                    	<label for="">Град</label>
                                    	<div class="form-line">
                                       <input class="form-control" type="text" name="city" id="city" value="<?php echo $rsedit[city]; ?>" />
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    	<label for="">pincode</label>
                                    	<div class="form-line">

                                        <input class="form-control" type="text" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>" />
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    	<label for="">loginid</label>
                                    	<div class="form-line">
                                        <input class="form-control" type="text" name="loginid" id="loginid"  value="<?php echo $rsedit[loginid]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    	<label for="blood group">Крвна група</label>
                                    	<div class="form-line">
                                    	<select name="select2" id="select2" class="form-control show-tick">
                                    		<option value="" selected hidden="">Select</option>
                                    		<?php
                                    		$arr = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
                                    		foreach($arr as $val)
                                    		{
                                    			if($val == $rsedit[bloodgroup])
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
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    	<label for="">Пол</label>
                                    	<div class="form-line">
                                    	<select name="select3" id="select3" class="form-control show-tick">
                                    		<option value="" selected="" hidden="">Одбери</option>
                                    		<?php
                                    		$arr = array("MALE","FEMALE");
                                    		foreach($arr as $val)
                                    		{
                                    			if($val == $rsedit[gender])
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
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                    	<label for="">Датум на раѓање</label>
                                    	<div class="form-line">
                                       <input class="form-control" type="date" name="dateofbirth" id="dateofbirth"  value="<?php echo $rsedit[dob]; ?>"/>
                                   </div>
                                    </div>
                                </div>
                            </div>
                            



                            
                            <div class="col-sm-12">                                
                                <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Потврди" />
                            </div>
                        </div>
                    </div>
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
	if(document.frmpatprfl.patientname.value == "")
	{
		alert("Името на пациентот не треба да е празно.");
		document.frmpatprfl.patientname.focus();
		return false;
	}
	else if(!document.frmpatprfl.patientname.value.match(alphaspaceExp))
	{
		alert("Имет она пациентот не е валидно..");
		document.frmpatprfl.patientname.focus();
		return false;
	}
	else if(document.frmpatprfl.admissiondate.value == "")
	{
		alert("Датумот на примање не треба да е празен..");
		document.frmpatprfl.admissiondate.focus();
		return false;
	}
	else if(document.frmpatprfl.admissiontme.value == "")
	{
		alert("Времето на примање не треба да е празно..");
		document.frmpatprfl.admissiontme.focus();
		return false;
	}
	else if(document.frmpatprfl.address.value == "")
	{
		alert("Адресата не треба да е празна
..");
		document.frmpatprfl.address.focus();
		return false;
	}
	else if(document.frmpatprfl.mobilenumber.value == "")
	{
		alert("Мобилниот телефон не треба да е празен..");
		document.frmpatprfl.mobilenumber.focus();
		return false;
	}
	else if(!document.frmpatprfl.mobilenumber.value.match(numericExpression))
	{
		alert("Мобилниот телефон не  е валиден..");
		document.frmpatprfl.mobilenumber.focus();
		return false;
	}
	else if(document.frmpatprfl.city.value == "")
	{
		alert("Градот не треба да е празен..");
		document.frmpatprfl.city.focus();
		return false;
	}
	else if(!document.frmpatprfl.city.value.match(alphaspaceExp))
	{
		alert("Градот не е валиден..");
		document.frmpatprfl.city.focus();
		return false;
	}
	else if(document.frmpatprfl.pincode.value == "")
	{
		alert("Пин кодот не треба да е празен..");
		document.frmpatprfl.pincode.focus();
		return false;
	}
	else if(!document.frmpatprfl.pincode.value.match(numericExpression))
	{
		alert("Пин кодот не е валиден.");
		document.frmpatprfl.pincode.focus();
		return false;
	}
	else if(document.frmpatprfl.loginid.value == "")
	{
		alert("Логин ИД не треба да е празен..");
		document.frmpatprfl.loginid.focus();
		return false;
	}
	else if(!document.frmpatprfl.loginid.value.match(emailExp))
	{
		alert("Логин ИД не е валиден..");
		document.frmpatprfl.loginid.focus();
		return false;
	}
	else if(document.frmpatprfl.password.value == "")
	{
		alert("Лозинката не треба да е празна.");
		document.frmpatprfl.password.focus();
		return false;
	}
	else if(document.frmpatprfl.password.value.length < 8)
	{
		alert("Должината не лозинката треба да е над 8 карактери...");
		document.frmpatprfl.password.focus();
		return false;
	}
	else if(document.frmpatprfl.password.value != document.frmpatprfl.confirmpassword.value )
	{
		alert("Лозинка и потврди лозинка треба да се исти..");
		document.frmpatprfl.confirmpassword.focus();
		return false;
	}
	else if(document.frmpatprfl.select2.value == "")
	{
		alert("Крвна група не треба да е празна.");
		document.frmpatprfl.select2.focus();
		return false;
	}
	else if(document.frmpatprfl.select3.value == "")
	{
		alert("Полот не треба да е празен..");
		document.frmpatprfl.select3.focus();
		return false;
	}
	else if(document.frmpatprfl.dateofbirth.value == "")
	{
		alert("Датумот на раѓање не треба да е празен.");
		document.frmpatprfl.dateofbirth.focus();
		return false;
	}
	else if(document.frmpatprfl.select.value == "" )
	{
		alert("Ве молиме одберете статус..");
		document.frmpatprfl.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>