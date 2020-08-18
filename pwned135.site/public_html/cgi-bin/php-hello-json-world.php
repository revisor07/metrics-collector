<?php
header('Content-type: application/json');
$title = "Team Pwned";
$message = "This page was generated with the PHP programming langauge";
$heading = "Hello, PHP";
date_default_timezone_set('America/Los_Angeles');
$date = date('m/d/Y h:i:s a', time());
$ip = $_SERVER['REMOTE_ADDR'];
$data = array('title' => $title, 'heading' => $heading, 'message' => $message, 'IP' => $ip, 'time' => $date);

echo json_encode($data);

?>

