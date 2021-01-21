<?php
session_start();
unset($_SESSION['client']);
header('Location: ../views/index.php');
