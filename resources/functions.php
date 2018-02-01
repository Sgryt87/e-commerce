<?php

function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

function fetchQuery($sql)
{
    return mysqli_fetch_array($sql);
}

function confirmQuery($conn)
{
    global $connection;
    if (!$conn) {
        die('Query Failed ' . mysqli_error($connection));
    }
}

function cleanData($data)
{
    global $connection;
    return mysqli_escape_string($connection, trim(htmlentities($data)));
}

function redirect($link)
{
    header('Location: $link');
}