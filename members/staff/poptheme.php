<?
include('config.php');

$sql1 = mysql_query("SELECT * FROM Players WHERE theme='style'");
$sql2 = mysql_query("SELECT * FROM Players WHERE theme='wood'");
$sql3 = mysql_query("SELECT * FROM Players WHERE theme='ben'");
$sql4 = mysql_query("SELECT * FROM Players WHERE theme='charcoal'");
$sql5 = mysql_query("SELECT * FROM Players WHERE theme='gloss'");
$sql6 = mysql_query("SELECT * FROM Players WHERE theme='medieval'");

$t1 = mysql_num_rows($sql1);
$t2 = mysql_num_rows($sql2);
$t3 = mysql_num_rows($sql3);
$t4 = mysql_num_rows($sql4);
$t5 = mysql_num_rows($sql5);
$t6 = mysql_num_rows($sql6);


echo "default: $t1, wood: $t2, evil: $t3, charcoal: $t4, gloss: $t5, medieval: $t6";

?>