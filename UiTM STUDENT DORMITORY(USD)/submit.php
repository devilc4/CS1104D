<?php
	include('config.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'mailer/Exception.php';
	require 'mailer/PHPMailer.php';
	require 'mailer/SMTP.php';
	session_start();

	$errors = array(); 

	// connect to database
	$db = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

	$category = mysqli_real_escape_string($db, $_POST['category']);
	$student_name = mysqli_real_escape_string($db, $_POST['student-name']);
	$student_email = mysqli_real_escape_string($db, $_POST['student-email']);
	$rollno = mysqli_real_escape_string($db, $_POST['rollno']);
	$student_mobile = mysqli_real_escape_string($db, $_POST['student-mobile']);
	
	$first_name = mysqli_real_escape_string($db, $_POST['first-name']);
	$last_name = mysqli_real_escape_string($db, $_POST['last-name']);
	$relation = mysqli_real_escape_string($db, $_POST['relation']);
	$mobile = mysqli_real_escape_string($db, $_POST['mobile']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$address = mysqli_real_escape_string($db, $_POST['address']);

	$duration = mysqli_real_escape_string($db, $_POST['duration']);
	$number = mysqli_real_escape_string($db, $_POST['number']);
	$doa = mysqli_real_escape_string($db, $_POST['doa']);

	$key = mt_rand(100000, 999999);

	if (empty($student_name)) { array_push($errors, "Student Name is required"); }
	if (empty($student_email)) { array_push($errors, "Student email is required"); }
	if (empty($rollno)) { array_push($errors, "Roll No. is required"); }
	if (empty($student_mobile)) { array_push($errors, "Student mobile is required"); }
	if (empty($first_name)) { array_push($errors, "First Name is required"); }
	if (empty($last_name)) { array_push($errors, "Last Name is required"); }
	if (empty($relation)) { array_push($errors, "Relation is required"); }
	if (empty($mobile)) { array_push($errors, "Mobile is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($address)) { array_push($errors, "Address is required"); }
	if (empty($duration)) { array_push($errors, "Duration is required"); }
	if (empty($doa)) { array_push($errors, "Date of arrival is required"); }
	  
	if (count($errors) == 0) {
	  	$query = "INSERT INTO requests (category, st_name, st_email, rollno, st_mobile, first_name, last_name, relation, mobile, email, address, duration, num, date_of_arrival, st_key) VALUES('$category', '$student_name', '$student_email', '$rollno', '$student_mobile', '$first_name', '$last_name', '$relation', '$mobile', '$email', '$address', '$duration', '$number', '$doa', $key)";

	  	if (mysqli_query($db, $query)) {
    		$id = mysqli_insert_id($db);
    		echo "New record created successfully. Last inserted ID is: " . $last_id;
		} else {
    		echo "Error: " . $query . "<br>" . mysqli_error($db);
    		exit();
		}

	  	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = $mail_id;                 // SMTP username
		    $mail->Password = $mail_password;                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom($mail_id, 'VH Registration');
		    $mail->addAddress($student_email);     // Add a recipient


		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Registration for Visitor Hostel';
		    $mail->Body    = 'Click the following link to verify that you registered for a room in Visitor Hostel <br /> <a href="'.$webaddress.'verify.php?key='.$key.'&id='.$id.'">'.$webaddress.'verify.php?key='.$key.'&id='.$id.'</a> .';
		    $mail->AltBody = 'Open this url in your browser to verify that you applied for a room in Visitor Hostel '.$webaddress.'verify.php?key='.$key.'&id='.$id.' .';

		    $mail->send();
		    echo 'Message has been sent';
		    header('location: done.html');
	  		echo "<script>window.location = 'done.html';</script>";
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}

	}
	else {
		echo "<center style='color: red'><h1>There are following errors</h1><ul>";
		foreach ($errors as &$value) {
    		echo '<li><h3>', $value, '</h3></li>';
		}
		echo "</ul></center>";
	}
?>