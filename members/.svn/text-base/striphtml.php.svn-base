<?
function stripHTML($Text) {
	$Text = preg_replace("(\<script(.+?)\>(.+?)\<\/script>)is",'',$Text);
	$Text = preg_replace("(\<script\>(.+?)\<\/script>)is",'',$Text);
	$Text = preg_replace("(\<script>)is",'',$Text);
	$Text = preg_replace("(\<script language=\"javascript\"\/\>)is",'',$Text);
	$Text = preg_replace("(\\<\/td>)is",'',$Text);
	$Text = preg_replace("(\<\/tr>)is",'',$Text);
	$Text = preg_replace("(\<table>)is",'',$Text);
	$Text = preg_replace("(\<table(.+?)\>)is",'',$Text);
	$Text = preg_replace("(\<tr>)is",'',$Text);
	$Text = preg_replace("(\<\/table>)is",'',$Text);
	$Text = preg_replace("(\<\/body>)is",'',$Text);
	$Text = preg_replace("(\<\/div>)is",'',$Text);
	$Text = preg_replace("(\<div(.+?)\>)is",'',$Text);
	$Text = preg_replace("(\<div(.+?)\>(.+?)\<\/div>)is",'',$Text);
	$Text = preg_replace("(\<form(.+?)\>(.+?)\<\/form>)is",'',$Text);
	$Text = preg_replace("(\<frame(.+?)\>(.+?)\<\/frame>)is",'',$Text);
	$Text = preg_replace("(\<frameset>)is",'',$Text);
	$Text = preg_replace("(\<td(.+?)\>(.+?)\<\/td>)is",'',$Text);
	$Text = preg_replace("(\<td\>(.+?)\<\/td>)is",'',$Text);
	$Text = preg_replace("(\<td>)is",'',$Text);
	$Text = preg_replace("(\<td(.+?)\>)is",'',$Text);
	$Text = preg_replace("(\<tbody(.+?)\>(.+?)\<\/tbody>)is",'',$Text);
	$Text = preg_replace("(\<tbody\>(.+?)\<\/tbody>)is",'',$Text);
	$Text = preg_replace("(\<tbody>)is",'',$Text);
	$Text = preg_replace("(\<tbody(.+?)\>)is",'',$Text);
	$Text = preg_replace("(\\<\/tbody>)is",'',$Text);
	
	return $Text;
}
?>