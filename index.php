<?php

declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


session_start(); //we are going to use session variables so we need to enable sessions

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$products = [
    ['name' => 'Pesto Mozzarella', 'price' => 3],
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Ham & Cheese', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products = [
    ['name' => 'Coke', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => '7up', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 2],
    ['name' => 'Ice-tea Green', 'price' => 3]
];

$emailErr = "";
$street = "";
$streetErr = "";
$streetnum = "";
$streetnumErr = "";
$city = "";
$cityErr = "";
$zip = "";
$zipErr = "";



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "<div class='alert alert-danger'>Don't forget to enter your e-mail address!</div>";
    }
    else {
        $email = ($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "<div class='alert alert-danger'>Hey, that doesn't look like an email!</div>";
        }
    }


    if (empty($_POST["street"])) {
        $streetErr = "<div class='alert alert-danger'>We won't be able to deliver your meal without a street name.</div>";
    }
    else {
        $street ($_POST["street"]);
        if (!is_string($_POST["street"])) {
            $streetErr = "<div class='alert alert-danger'>Sorry, I don't know where that is.</div>";
        }
    }

    if (empty ($_POST["streetnumber"])) {
        $streetnumErr = "<div class='alert alert-danger'>It'd be a lot easier if we knew where you lived</div>";
    }
    else {
        $streetnum ($_POST["streetnumber"]);
        if (!is_numeric($_POST["streetnumber"])) {
            $streetnumErr = "Invalid street number";
        }
    }

    if (empty ($_POST["city"])) {
        $cityErr = "City is required";
    }
    else {
        $city ($_POST["city"]);
        if (!is_string($_POST["city"])) {
            $cityErr = "Invalid city";
        }
    }

    if (empty ($_POST["zipcode"])) {
        $zipErr = "Zip code is required";
    }
    else {
        $zip ($_POST["zipcode"]);
        if (!is_numeric($_POST["zipcode"])) {
            $zipErr = "Invalid zip code";
        }
    }
}

echo $emailErr;


$totalValue = 0;

//whatIsHappening();

require 'form-view.php';