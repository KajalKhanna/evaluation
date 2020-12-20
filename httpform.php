<html>
<head>
<script type ="text/javascript">
function submitform()
{
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange= function()
{
if(this.readyState == 4 && this.status ==200)
{
//document.getElementById("demo").innerHTML = xhttp.responseText;	
var response = JSON.parse(xhttp.responseText);
console.log(response);
}
};
xhttp.open("POST","form.php",true);
xhttp.send();
}
</script>
</head>
<body>
<div id = "demo">[No Content]</div>
<form action ="form.php" method ="post">
<label>
First Name
<input type ="text" name ="fname"/>
</label>
<label>
Last Name
<input type ="text" name ="lname"/>
</label>
<input type ="button" value ="submit" onclick="submitform();"
/>
</form>
</body>
</html>