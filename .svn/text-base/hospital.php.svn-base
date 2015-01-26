<?php
$title="Hospital";
require_once("members/config.php");
require_once("members/header.php");
include("members/Countdown_he.php");
include("members/countdown_p.php");
checks();

echo("<div id=\"ltable\" align=\"center\"><h1>Hospital</h1>
<p>Please state how many hours you will be staying with us.<br />
The cost is $10,000 per hour, and for every hour you are in the hospital you will receive 10 health.</p>
<form method=\"post\" action=\"members/hospital.php\">
    <p>Hours: <input type=\"text\" name=\"h\" /></p>
	<input type=\"submit\" name=\"submit\" value=\"Enter Hospital\" />
	<input type=\"hidden\" name=\"submitted\" value=\"TRUE\" /></p>
</form></div>");
include("members/footer.php");
?>