<?php
session_start();
requireValidSession();
date_default_timezone_set('America/Sao_Paulo');

loadModel('WorkingHours');

$formatter = new IntlDateFormatter(
    'pt_BR',
    IntlDateFormatter::FULL,
    IntlDateFormatter::NONE,
    'America/Sao_Paulo',
    IntlDateFormatter::GREGORIAN
);

$date = (new Datetime())->getTimeStamp();
$today = $formatter->format($date);
$user = $_SESSION['user'];
$records = WorkingHours::loadFromUserAndDate($user->id, date("Y-m-d"));

loadTemplateView('day_records', [
    'today' => $today,
    'records' => $records
]);
