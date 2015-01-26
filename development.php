<?php
$title="Development";
include ("members/config.php");
checks();
require_once("members/header.php");
// Pull the data to parse
$process = curl_init('http://gtogame.beanstalkapp.com/api/changesets.json');
curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($process, CURLOPT_HEADER, 1);
curl_setopt($process, CURLOPT_USERPWD, 'globaltakeover' . ":" . '[D7Awthkp2946]');
curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($process, CURLOPT_CUSTOMREQUEST, 'GET');
$content = curl_exec($process);
curl_close($process);
$json=json_decode("[{".substr($content, strripos($content,'[{')+strlen('[{')));
?>

<div class="page-header"><h1>Development <small>See what we've been up to!</small></h1></div>

<p>As we continually develop and update Global Takeover, we want all of the players to be able to see what we're doing, and when we do it.<br>
To do this, we have decided to log all of our changes/updates to the game here, for all of the players to see.</p>

<div class="well">
<h5>Last 10 Changes</h5>
<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th>Revision Number</th>
	<th>Time of Change</th>
	<th>Change Comment</th>
</tr>
</thead>
<tbody>
<? 
$i = 0;
foreach($json as $item){
   if(++$i > 10) break;
   echo "<tr>
   <td>".$item->revision_cache->revision."</td>
   <td>".$item->revision_cache->time."</td>
   <td>".$item->revision_cache->message."</td>
   </tr>";
}
?>
</tbody>
</table>
</div>
<? require_once("members/footer.php"); ?>