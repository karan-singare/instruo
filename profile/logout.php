<?php
    include '../connection/db.php';

    session_destroy();
    session_unset();

    header("Location: ../index.php");


 ?>
