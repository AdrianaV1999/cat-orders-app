<?php
include "config.php";

if(isset($_POST['submit'])){

    $uname = mysqli_real_escape_string($con,$_POST['username']);
    $upassword = mysqli_real_escape_string($con,$_POST['password']);

    if ($uname != "" && $upassword != ""){

        $sql_query = "select count(*) as cntUser from Korisnik where name='".$uname."' and password='".$upassword."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            header('Location: home.php');
        }else{
            echo "Pogresna lozinka!";
        }

    }

}
?>




<!doctype html>
<html lang="en">
  <head>
  	<title>CAT SHOP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">CAT SHOP</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Prijava</h3>
		      	<form method="POST" action="#" class="signin-form">
					  <div class="form-group">
						  <input type="text" class="form-control" name="username" placeholder="  Unesi korisnicko ime"/>
						</div>
						<div class="form-group">
						  <input id="password-field" input type="password" class="form-control" name="password" placeholder=" Unesi lozinku"/>
						  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>
						<div class="form-group">
						<input type="submit" class="form-control btn btn-primary submit px-3" name="submit" value="PRIJAVI SE" class="btn-login"/>
						</div>
				</form>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

