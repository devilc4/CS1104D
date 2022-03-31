<?php
	include('config.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'mailer/Exception.php';
	require 'mailer/PHPMailer.php';
	require 'mailer/SMTP.php';
	session_start();

	// connect to database
	$db = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

	$id = mysqli_real_escape_string($db, $_GET['id']);
	$key = mysqli_real_escape_string($db, $_GET['key']);

	$incharge_email = "prmsrswt@gmail.com";

	$query = "SELECT * FROM requests WHERE id='$id' AND st_key='$key'";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) == 1) {
		$in_key = mt_rand(100000, 999999);

		$sql = "UPDATE requests SET app_student=1, in_key='$in_key' WHERE id='$id'";
		mysqli_query($db, $sql);

		$mail = new PHPMailer();                              // Passing `true` enables exceptions
		$email = '<strong>'.$row['st_name'].'</strong> has requested a '.$row['category'].' room for '.$row['first_name'].'. Click the following link to approve the request. <br /> <a href="'.$webaddress.'approve.php?key='.$in_key.'&id='.$row['id'].'">'.$webaddress.'approve.php?key='.$in_key.'&id='.$row['id'].'</a> .';
		$altemail = $row['st_name'].' has requested a '.$row['category'].' room for '.$row['first_name'].'. Open the following link in browser to approve the request. '.$webaddress.'approve.php?key='.$in_key.'&id='.$row['id'].' .';
		try {
		    //Server settings
		    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = $mail_id;                // SMTP username
		    $mail->Password = $mail_password;                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom($mail_id, 'Prem Sarswat');
		    $mail->addAddress($incharge_email);     // Add a recipient


		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'New Registration for Visitor Hostel';
		    $mail->Body    = $email;
		    $mail->AltBody = $altemail;

		    $mail->send();
		    $msg = '<h1><span class="doneTitle">You have verified the request.</span></h1>
			<h3><span class="doneSub">An email will be sent to visitor when your request is approved.</span></h3>';
		} catch (Exception $e) {
			$msg = '<h1><span class="doneTitle">Message could not be sent. Mailer Error: </span></h1>'.$mail->ErrorInfo; 
		}
	} else {
		$msg = '<h1><span class="doneTitle">Failed to verify the request.</span></h1>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ABV-IIITM | VH Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="icon" type="image/png" href="logo.png">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Serif|Rubik" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<script type="text/javascript" >
		$(window).on('scroll', function() {
			if($(window).scrollTop()) {
				$('nav').addClass('black');
			}
			else {
				$('nav').removeClass('black');
		}
	})
	</script>
</head>
<body>
	<div class="wrapper">
		<nav>
			<div>
				<img class="logo" src="logo.png">
			<h1 class="companyName">
				ABV-Indian Institute of Information Technology & Management, Gwalior
			</h1>
			</div>
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="faq.html">FAQ</a></li>
				<li><a class="room" href="form.html"><b>Book A Room</b></a></li>
				
			</ul>
		</nav>
		<section class="doneSec sec1">
			<?php
				echo $msg;
			?>
		</section>

		<footer>
			Copyright &copy; ABV-Indian Institute of Information Technology & Management, Gwalior
		</footer>
	</div>



</body>
</html>