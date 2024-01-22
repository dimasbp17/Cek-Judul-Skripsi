<?php

require_once "config/config.php";

unset($_SESSION['user']);
session_destroy();
header("location:login.php");
