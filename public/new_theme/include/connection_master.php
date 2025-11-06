<?php

	 $connection=mysqli_connect("localhost","root","") or die ("error to connect database");
    $database=mysqli_select_db($connection,"mcb_admin")or die ("error to select database");
	
   


   
	//$base_url="http://localhost/nabl_software_mattest";
	$base_url="http://192.168.0.118/nabl_software_new/";
	//$base_url="http://localhost/nabl_software_micron/";
	//$base_url="http://localhost/nabl_software/";
	$company_name="MCB MATERIAL TESTING & RESEARCH CENTER LLP";
	$Company_address="Plot no. 44 Shri Balaji Dham Marg, Rudrapur, Uttarakhand 263153";
	$lab_id="TC-11241";
	
	$first_of_receipt="MCB/";
	$city="Rudrapur";
	$Sign_url_header = "../images/sign.png";
	$logo_url_header = "../images/mttest.png";
	$audit_logo = "images/mttest.png";
	$audit_sign = "images/sign.png";
	
	

?>