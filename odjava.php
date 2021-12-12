<?php

session_start();
session_unset();
session_destroy();
header("Location: ../knjiznica/pocetna.php");
exit();