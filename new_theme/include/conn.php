<?php

	 //$connection=mysqli_connect("localhost","matsoft","matsoft@123") or die ("error to connect database");
    //$database=mysqli_select_db($connection,"matsoft_admin")or die ("error to select database");
	
   


    $conn=mysqli_connect("localhost","root","") or die ("error to connect database");
    $db=mysqli_select_db($conn,$_SESSION['master_db'])or die ("error to select database");
    mysqli_set_charset($conn,"utf8");
	//$base_url="http://192.168.1.151/nabl_software_micron/";
	//$base_url="http://localhost/nabl_software_mattest/";
	$base_url="http://192.168.0.118/new_theme/";
	//$base_url="http://localhost/nabl_software/";
	$company_name="MCB MATERIAL TESTING & RESEARCH CENTER LLP";
	$Company_address="Plot no. 44 Shri Balaji Dham Marg, Rudrapur, Uttarakhand 263153";
	$Company_no="Telephone: +91-0261-2272261";
	$Company_email="Email: masssurat@gmail.com";
	$lab_id="TC-11241";
	
	$first_of_receipt="MCB/";
	$city="Surat";
	//$sign_data = "../images/sign.png";
	$Sign_url_header = "../images/sign.png";
	$logo_url_header = "../images/mttest.jpg";
	$audit_logo = "images/mttest.png";
	$audit_sign = "images/sign.png";
	
	  $conn1=mysqli_connect("localhost","root","") or die ("error to connect database");
	$db1=mysqli_select_db($conn1,"mcb_lab")or die ("error to select database");
	 mysqli_set_charset($conn1,"utf8"); 
	 
	

?>