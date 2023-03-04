<?php


function start_session()
{
    // this starts the session so that can retrieve the value in GLOBAL session
    session_start();

    if (!isset($_SESSION['name'])) {
        echo "<script>alert('you cannot enter this page');</script>";
        enter_page("home");
    }
}

function create_session($name)
{
    session_start();
    $_SESSION['name'] = $name;
}


function stop_session()
{
    session_start();
    session_unset();
    session_destroy();
    require("custom_functions.php");
    enter_page("home");
}
?>