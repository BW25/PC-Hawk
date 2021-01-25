<?php

    session_start();

    $object->uid = $_SESSION['uid'];
    $object->account_type = $_SESSION['account_type'];

    $json = json_encode($object);
    echo $json;

?>
