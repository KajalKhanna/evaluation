<?php
$con = mysqli_connect("localhost","root","admin") or die("DB not connected");
		mysqli_select_db($con,"pimcore") or die("DB not found");
		?>