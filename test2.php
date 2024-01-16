<?php
$database = mysqli_connect("localhost","root","", "testovoe");
function related($database)
{
    $SQL = "SELECT click.*
    FROM click
    JOIN actions ON actions.click_id = click.id
    ORDER BY click.id";
    $result = mysqli_query($database, $SQL);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        echo "<pre>";
        var_dump($row);
        echo "</pre>";
    } else {
        echo "not found!";
    }
}
function notRelated($database)
{
    $SQL = "SELECT click.*
    FROM click
    JOIN actions ON actions.click_id != click.id
    ORDER BY click.id";
    $result = mysqli_query($database, $SQL);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        echo "<pre>";
        var_dump($row);
        echo "</pre>";
    } else {
        echo "not found!";
    }
}
echo "Relations with click_id:";
related($database);
echo "\n";
echo "Not related:";
notRelated($database);