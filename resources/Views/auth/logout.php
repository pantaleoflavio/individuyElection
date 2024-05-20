<?php

session_unset();
session_destroy();

echo "<script>window.location.href='http://" . $_SERVER['SERVER_NAME'] . "/individuyElection/index.php?page=home'</script>";

?>