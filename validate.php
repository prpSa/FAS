<?php
$username = $_GET['username'];
session_start();
if (!isset($_SESSION[$username])) {
    header('location: index.php');
}
$username = $_GET['username'];
