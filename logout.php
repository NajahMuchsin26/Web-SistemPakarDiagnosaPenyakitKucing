<?php
session_start();
session_destroy();
header('location: halamanDefault.php');