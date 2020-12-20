<html>
<head>
<form action ="dateoperations.php" method="post">
<input type="date" name="date"  />
<input type="submit" name="sub" value="sub"/>

</form>
</head>

<?php
$date=date_create($_POST['date']);
date_add($date,date_interval_create_from_date_string("40 days"));
echo date_format($date,"d-m-Y");

$mydate=getdate(date("U"));
$d=date_add($mydate['mday']-$mydate['year'],date_interval_create_from_date_string("40 days"));
echo $d;
?>
</html>