<?php
function add($a,$b)
{
$r = $a+$b;
echo $r;
}
function sub($a,$b)
{
$r = $a-$b;
echo $r;
}
function mul($a,$b)
{
$r = $a*$b;
echo $r;
}
function div($a,$b)
{
$r = $a/$b;
echo $r;
}

$ch=4;
switch($ch)
{
case 1:add(4,7);
break;
case 2:sub(4,7);

break;
case 3:mul(4,7);

break;
case 4:div(4,0);

break;
default:
echo ("invalid option\n");
}
?>