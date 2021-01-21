<?php
session_start();
unset($_SESSION['admin']);
header('Location: ../views/sign_in.php');
