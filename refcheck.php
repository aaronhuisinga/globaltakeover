<?
include_once("members/config.php");
$refer = $_POST['refer']; // get the username

		if ($refer != "gtbeta38jjb89xf4g") {
			echo "<span style=\"color:#f00\">Invalid invitation code. $refer</span>";
		} else {
			echo '<span style="color:#0c0">Invitation code validated.</span><script language="javascript">submit.disabled=false;</script>';
		}
?>
