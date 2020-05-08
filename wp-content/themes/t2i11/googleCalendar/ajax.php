<?php
session_start();
header('Content-type: application/json');

require_once('google-calendar-api.php');

// Get event details
$event = $_POST['event_details'];

$capi = new GoogleCalendarApi();

// Get user calendar timezone
$user_timezone = $capi->GetUserCalendarTimezone($_SESSION['access_token']);

// Create event on primary calendar
$event_id = $capi->CreateCalendarEvent('primary', $event['title'], $event['all_day'], $event['event_time'], $user_timezone, $_SESSION['access_token']);

echo json_encode([ 'event_id' => $event_id ]);



?>