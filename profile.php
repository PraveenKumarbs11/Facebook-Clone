<?php 

session_start();
if(!isset($_SESSION['id'])){
	header("location: registerorlogin.php");
}
include('connection.php');
error_reporting(0);
$result = mysqli_query($link, "SELECT image FROM accounts where id='".$_SESSION['id']."'");
$row = mysqli_fetch_assoc($result);

$values_query = "select * from accounts where id='".$_SESSION['id']."'";
$values_result = mysqli_query($link, $values_query);
$values_row = mysqli_fetch_array($values_result);
$_SESSION['d_fname'] = $values_row['fname'];
$_SESSION['d_sname'] = $values_row['sname'];
$_SESSION['d_mail'] = $values_row['email'];
$_SESSION['d_phone'] = $values_row['phone'];
$_SESSION['d_gender'] = $values_row['gender'];
$string_dob = $values_row['dob'];
$dateofbirth = explode("-", $string_dob);
$_SESSION['date'] = (int)$dateofbirth[2];
$_SESSION['month'] = (int)$dateofbirth[1];
$_SESSION['year'] = (int)$dateofbirth[0];
$_SESSION['d_dob'] = $values_row['dob'];

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="assets/soft/logo1.png"/>
	<title>Facebook | Clone</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<meta property="og:type" content="website">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style type="text/css">
		body{
			margin: 0;
			padding: 0;
			background: #F0F2F5;
		}
		nav.faceb{
			height: 80px;
			background: #3B5998;
		}
		nav.faceb a{
			text-decoration: none;
			color: #fff;
			font-size: 3rem;
			font-weight: 500;
			margin-left: 570px;
		}
		nav.faceb a:hover{
			font-size: 3.2rem;
			margin-left: 560px;
		}
		nav.faceb small{
			color: #fff;
			font-weight: 500;
			letter-spacing: 1px;
		}
		header{
			height: 600px;
			background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0)); 
			width: 100%;
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
		header div img{
			display: block;
			margin-left: auto;
			padding-top: 20px;
			margin-right: auto;
			opacity: 0.8;
			border-radius: 10px;
		}
		header .profilePhoto form label{
			border: 2px solid #878AA0;
			margin-left: 750px;
			margin-right: 20px;
			margin-top: 20px;
			border-radius: 50%;
		}
		header .profilePhoto form label svg{
			height: 3rem;
			width: 3rem;
			color: #878AA0;
			margin: 10px;
			cursor: pointer;
		}
		input[type="file"] {
		    display: none;
		}
		header .profilePhoto form button{
			background: #fff;
			border: 2px solid #60a448;
			color: #60a448;
			font-size: 18px;
			font-weight: 500;
		}
		.profileDisplay{
			height: 350px;
			background: #fff;
			width: 1200px;
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			margin-top: 40px;
			margin-left: 200px;
			border-radius: 15px;
		}
		.profileDisplay p{
			margin-left: 400px;
			padding: 30px 0px 30px 0px;
			font-size: 4rem;
			font-weight: 500;
		}
		.profileDisplay .mail{
			font-size: 2rem;
			padding: 80px;
		}
		.profileDisplay .phone{
			font-size: 2rem;
			padding: 80px;
			font-weight: 500;
			margin-left: 200px;
		}
		.profileDisplay .dob{
			font-size: 1.5rem;
			margin: 0px 50px 0px 300px;
			padding: 0px 100px 100px 50px;
		}
		.profileDisplay .gender{
			font-size: 1.5rem;
			margin: 0px 50px 0px 170px;
		}
		.profileContainer{
			margin-top: 50px;
			background: #fff;
			border-radius: 15px;
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			margin-left: 100px;
			margin-bottom: 0px;
			width: 1400px;
			height: 750px;
			font-size: 1.2rem;
		}
		.profileContainer .updateForm form label{
			font-weight: 500;
		}
		.profileContainer .updateForm form label.fname{
			margin-left: 240px;
		}
		.profileContainer .updateForm form label.mail{
			margin-left: 400px;
		}
		.profileContainer .updateForm form label.phone{
			margin-left: 450px;
			margin-top: 20px;
		}
		.profileContainer .updateForm form label.dob{
			margin-left: 650px;
		}
		.profileContainer .updateForm form label.gend{
			margin-left: 680px;
		}
		.profileContainer .updateForm form input, .profileContainer .updateForm form select{
			border: 2px solid #DDDFE2;
			padding-left: 10px;
			border-radius: 4px;
		}
		.profileContainer .updateForm form input#fname{
			margin: 100px 50px 10px 20px;
		}
		.profileContainer .updateForm form input#sname{
			margin: 20px 20px 10px 20px;
		}
		.profileContainer .updateForm form input#mail{
			margin: 20px 20px 10px 20px;
		}
		.profileContainer .updateForm form input#phone{
			margin: 20px 20px 10px 5px;
		}
		.profileContainer .updateForm form select.date{
			margin: 0px 20px 0px 500px;
		}
		.profileContainer .updateForm form select.month{
			margin-right: 20px;
		}
		.profileContainer .updateForm form select.year{
			margin-right: 20px;
		}
		.profileContainer .updateForm form button.bttn{
			border-radius: 50%;
			border: none;
			height: 20px;
			margin: 5px 20px 5px 5px;
		}
		.profileContainer .updateForm form input.fe{
			margin-left: 550px;
		}
		.profileContainer .updateForm form input.m{
			margin: 2px 0px 20px 20px;
		}
		.profileContainer .updateForm form input.o{
			margin-left: 20px;
		}
		.profileContainer .updateForm form label.o{
			margin-right: 20px;
		}
		.profileContainer .updateForm form label.pass{
			margin: 40px 20px 20px 400px;
		}
		.error{
			margin-left: 600px;
			color: red;
			font-weight: 500;
			font-size: 14px;
		}
		.copy{
			color: #878AA0;
			font-weight: 500;
			font-size:14px;
			margin-left: 750px;
		}
		input:focus{
			outline: none;
		}
	</style>
</head>
<body>
	<nav class="faceb">
		<a style="text-decoration: none; font-size: 2rem; font-weight: 500; color: #fff; background: #60a448; padding: 0px 10px 0px 10px; margin-left: 30px;" href="home.php">&#8592;</a>
		<a class="brand" href="home.php">facebook </a><small> clone</small></nav>
	<header>
		<div>
			<img src="images/<?php echo $row['image']; ?>" height="500px" width="auto"/>
		</div>
		<span class="profilePhoto">
			<form method="POST" action="profilePhotoUpdater.php" enctype="multipart/form-data">
				<label for="choose">
					<svg viewBox="0 0 16 16" class="bi bi-camera" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  	<path fill-rule="evenodd" d="M15 12V6a1 1 0 0 0-1-1h-1.172a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 9.173 3H6.828a1 1 0 0 0-.707.293l-.828.828A3 3 0 0 1 3.172 5H2a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
				  	<path fill-rule="evenodd" d="M8 11a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
				  	<path d="M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
				</svg>
				</label>
				<input type="file" name="image" id="choose" class="choose">
				<button type="submit" name="upload">Upload</button>
			</form>
		</span>
	</header>
	<div class="profileDisplay">
		<p class="name"><?php echo $_SESSION["d_fname"]; ?><?php echo $_SESSION["d_sname"]; ?></p>
		<span class="mail"><?php echo $_SESSION["d_mail"]; ?></span>
		<span class="phone"><?php echo $_SESSION["d_phone"]; ?></span><br><br><br>
		<span class="dob"><?php echo $_SESSION["d_dob"]; ?></span>
		<span class="gender"><?php echo $_SESSION["d_gender"]; ?></span>
	</div>
	<hr style="margin-top: 50px; width: 1400px; border-top: 2px solid #dddfe2;">
	<div class="profileContainer">
		<span class="updateForm">
			<form action="nameUpdate.php" method="post" class="upForm">
				<label for="fname" class="fname">First Name</label>
			    <input class="update_form" type="text" name="fname" id="fname" value="<?php echo $_SESSION["d_fname"]; ?>" style="width:250px;">
			    <label for="sname">Last Name</label>
			    <input class="update_form" type="text" name="sname" id="sname" value="<?php echo $_SESSION["d_sname"]; ?>" style="width:250px;">
			    <input type="submit" value="submit" name="nameSubmit" />
			</form>
			<br>
			<form action="emailUpdate.php" method="post" calss="upForm">
			    <label for="mail" class="mail">Email</label>
			    <input class="update_form" type="text" name="mail" id="mail" value="<?php echo $_SESSION["d_mail"]; ?>" style="width:400px;">
			    <input type="submit" name="mailSubmit" value="submit" />
			</form>
			    <br>
			<form action="phoneUpdate.php" method="post" calss="upForm">
			    <label for="phone" class="phone">Phone</label>
			    <input class="update_form" type="text" name="phone" id="phone" value="<?php echo $_SESSION["d_phone"]; ?>" style="width:300px;">
				<input type="submit" value="submit" name="phoneSubmit"/>
			</form>
				<br><br>
			<form action="dobUpdate.php" method="post" calss="upForm">
				<label for="date" class="dob">Date of birth</label><br>
			    <select class="date" name="date" value="<?php echo $_SESSION["date"]; ?>">
					<option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
				</select>
			    <select class="month" name="month" value="<?php echo $_SESSION["month"]; ?>">
			        <option value="01">Jan</option>
					<option value="02">feb</option>
					<option value="03">mar</option>
					<option value="04">apr</option>
					<option value="05">may</option>
					<option value="06">jun</option>
					<option value="07">jul</option>
					<option value="08">aug</option>
					<option value="09">sep</option>
					<option value="10">oct</option>
					<option value="11">nov</option>
					<option value="12">dec</option>
				</select>
			    <select class="year" name="year" value="<?php echo $_SESSION["year"]; ?>">
                    <option value="1960">1960</option>
                    <option value="1961">1961</option>
                    <option value="1962">1962</option>
                    <option value="1963">1963</option>
                    <option value="1964">1964</option>
                    <option value="1965">1965</option>
                    <option value="1966">1966</option>
                    <option value="1967">1967</option>
                    <option value="1968">1968</option>
                    <option value="1969">1969</option>
                    <option value="1970">1970</option>
                    <option value="1971">1971</option>
                    <option value="1972">1972</option>
                    <option value="1973">1973</option>
                    <option value="1974">1974</option>
                    <option value="1975">1975</option>
                    <option value="1976">1976</option>
                    <option value="1977">1977</option>
                    <option value="1978">1978</option>
                    <option value="1979">1979</option>
                    <option value="1980">1980</option>
                    <option value="1981">1981</option>
                    <option value="1982">1982</option>
                    <option value="1983">1983</option>
                    <option value="1984">1984</option>
                    <option value="1985">1985</option>
                    <option value="1986">1986</option>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
                    <option value="2000">2000</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                </select>
			    <button type="button" class="bttn btn-secondary" data-toggle="tooltip" data-placement="right" title="Providing your date of birth helps make sure that you get the right Facebook experience for your age. If you want to change who sees this, go to the About section of your Profile. For more details, please visit our Data Policy.">
						?
				</button>
				<input type="submit" value="submit" name="dobSubmit"/>
			</form>
				<br>
			<form action="genderUpdate.php" method="post" calss="upForm">
			    <label for="gender" class="gend">Gender</label><br>
			    <input type="radio" name="gender" id="gender" class="gender fe" value="Female" <?php if($_SESSION['d_gender'] == 'Female'){ echo 'checked'; }?> > <label class="gender">Female</label>&nbsp;&nbsp;&nbsp;&nbsp;
			    <input type="radio" name="gender" id="gender" class="gender m" value="Male" <?php if($_SESSION['d_gender'] == 'Male'){ echo 'checked'; }?> > <label class="gender">Male</label>&nbsp;&nbsp;&nbsp;&nbsp;
			    <input type="radio" name="gender" id="gender" class="gender o" value="Other" <?php if($_SESSION['d_gender'] == 'Other'){ echo 'checked'; }?> > <label class="gender o">Other</label>
				<input type="submit" value="submit" name="genderSubmit"/>
			</form>
			<form action="passwordUpdate.php" method="post" calss="upForm">
			    <label for="password" class="pass">Password</label>
			    <input class="update_form" type="password" name="password" id="password" style="width:400px;"><button type="button" class="bttn btn-secondary" data-toggle="tooltip" data-placement="right" title="Password must conatin atleast one number, atleast one Captial letter, atleast special character like !@#$%">
  						?
			</button>
			    <input type="submit" name="passSubmit" value="submit" />
			</form>
			<br><br>
		</span>
		<p class="error"><?php echo $_SESSION['error']; ?></p>
	</div>
	<a style="text-decoration: none; font-size: 16px; font-weight: 500; color: #fff; background: #60a448; padding: 10px 30px 10px 30px; margin-left: 770px;" href="home.php">Back</a>
	<hr style="margin-top: 50px; width: 1400px; border-top: 2px solid #dddfe2;">
	<footer>
		<p class="copy">facebook &copy; clone</p>
	</footer>
</body>
</html>
