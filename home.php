<?php

session_start();
if(!isset($_SESSION['id'])){
    header("location: registerorlogin.php");
}
error_reporting(0);
$result = mysqli_query($link, "SELECT image FROM accounts where id='".$_SESSION['id']."'");
$row = mysqli_fetch_array($result);

?><!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="assets/soft/logo1.png" /> 
        <title>Facebook | Clone</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <meta property="og:type" content="website">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v7.0" nonce="l2gFXO14"></script>
        <style type="text/css">
            body{
                margin: 0;
                padding: 0;
            }
            nav.navbar{
                background: #fff;
                height: 70px;
                border-bottom: 1px solid #DDDFE2;
                -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
            nav a.navbar_brand{
                background: #3B5998;
                color: #fff;
                font-family: Roboto, Open sans;
                font-size: 1.5rem;
                font-weight: bold;
                text-decoration: none;
                padding: 10px 18px 10px 18px;
                position: absolute;
                top: 7px;
                left: 50px;
                border: none;
                border-radius: 50%;
            }
            .navbar .nav{
                position: relative;
                margin-left: 450px;
                top: 15px;
            }
            .navbar .nav .nav-item{
                padding: 0px 150px 0px 150px;
            }
            .navbar .nav .nav-item a{
                color: #212529;
            } 
            .navbar .nav .nav-item a svg {
                width: 2rem;
                height: 2rem;
            }
            .navbar .nav .nav-item a svg:hover{
                width: 2.5rem;
                height: 2.5rem;
                margin-left: -7px;
                margin-top: -8px;
            }
            /*.navbar .profile{
                height: 50px;
                width: 50px;
                float: right;
                right: 20px;
                border: 1px solid #dddfe2;
                border-radius: 50%;
                top: 7px;
                position: absolute;
            }*/
            div.facebook{
            	margin-left: 550px;
            	top: 40px;
            }
            .dropbtn {
			  	color: white;
			  	padding: 0px;
			  	font-size: 16px;
			  	border: none;
                border-radius: 50%;
			  	cursor: pointer;
			}
			.dropdown {
			  	position: relative;
                float: right;
                border: none;
                margin-right: 50px;
                margin-top: -25px;
			  	display: inline-block;
			}

			.dropdown-content {
			  	display: none;
                border: none;
                font-family: Roboto, Open sans;
			  	position: absolute;
			  	background-color: #f1f1f1;
			  	min-width: 100px;
			  	overflow: auto;
			  	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			  	z-index: 1;
			}

			.dropdown-content a {
			  	color: black;
                border: none;
			  	padding: 12px 16px;
			  	text-decoration: none;
			  	display: block;
			}

			.dropdown a:hover {background-color: #ddd;}

			.show {display: block;}
            button{
                outline: none;
                border: none;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       	<script  type="text/javascript"  >
    		function unloadExternalContent() {
	        	$('.fb-page').css("z-index", "-1");
	        	$('.displayConatiner').load("container.php");
    		}
    	</script>
    </head>
    <body>
        <nav class="navbar">
            <a class="navbar_brand" href="home.php">F</a>
            <div class="nav">
                <span class="nav-item">
                    <a class="nav-link" href="home.php" onclick="unloadExternalContent();">
                        <svg viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg></a>
                </span>
                <span class="nav-item">
                    <a class="nav-link" href="" onclick="loadExternalContent();">
                        <svg viewBox="0 0 16 16" class="bi bi-collection-play" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
                            <path fill-rule="evenodd" d="M6.258 6.563a.5.5 0 0 1 .507.013l4 2.5a.5.5 0 0 1 0 .848l-4 2.5A.5.5 0 0 1 6 12V7a.5.5 0 0 1 .258-.437z"/>
                        </svg></a>
                </span>
            </div>
            <div class="dropdown">
			  	<button onclick="myFunction()" class="dropbtn"><img class="dropbtn" src="images/high-rise-rock-near-sea-at-daytime-164229.jpg" height="50px" width="50px" /></button>
			  	<div id="myDropdown" class="dropdown-content">
			    	<a href="home.php">Home</a>
                    <a href="profile.php">Profile</a>
			    	<a href="about.php">About</a>
                    <a href="logout.php">Logout</a>
			  	</div>
			</div>
        </nav>
		<div class="displayConatiner"></div>
		<div class="fb-page facebook" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-width="500px" data-height="800px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/"></a></blockquote></div>
		<script>
			/* When the user clicks on the button, 
			toggle between hiding and showing the dropdown content */
			function myFunction() {
			  document.getElementById("myDropdown").classList.toggle("show");
			}

			// Close the dropdown if the user clicks outside of it
			window.onclick = function(event) {
			  if (!event.target.matches('.dropbtn')) {
			    var dropdowns = document.getElementsByClassName("dropdown-content");
			    var i;
			    for (i = 0; i < dropdowns.length; i++) {
			      var openDropdown = dropdowns[i];
			      if (openDropdown.classList.contains('show')) {
			        openDropdown.classList.remove('show');
			      }
			    }
			  }
			}
		</script>

    </body>
</html>