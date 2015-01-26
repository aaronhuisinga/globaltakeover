<?php
$title="Counterspies";
include('members/config.php');
require_once("members/header.php");
include("members/Countdown_he.php");
include("members/countdown_p.php");
checks();
online();

?>
<div id="ltable" align="center">
<h1>Counterspies</h1>
<p>Think someone is hunting you? Hire your own set of spies to counter and kill theirs!</p>
<table>
<tr>
<td>
<form action="members/counterspies.php" method="post">
Number of spies:  <select name="number">
  <option value="1">1 Counter Spy($4,000,000)</option>
  <option value="2">2 Counter Spies($8,000,000)</option>
  <option value="3">3 Counter Spies($16,000,000)</option>
  <option value="4">4 Counter Spies($32,000,000)</option>
</select><br />
<center><input type="submit" name="submit" value="Submit" /></center>
<input type="hidden" name="submitted" value="TRUE" />
</form>
</td>
</tr>
</table>
</div>
<? include("members/footer.php"); ?>