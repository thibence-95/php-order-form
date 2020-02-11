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

$emailErr = $streetErr = $streetnumErr = $cityErr = $zipErr = null;
$street = $streetnum = $city = $zip = null;



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
        $street = ($_POST["street"]);
        if (!is_string($_POST["street"])) {
            $streetErr = "<div class='alert alert-danger'>Sorry, I don't know where that is.</div>";
        }
    }

    if (empty ($_POST["streetnumber"])) {
        $streetnumErr = "<div class='alert alert-danger'>It'd be a lot easier if we knew where you lived</div>";
    }
    else {
        $streetnum = ($_POST["streetnumber"]);
        if (!is_numeric($_POST["streetnumber"])) {
            $streetnumErr = "<div class='alert alert-danger'>That can't be a number...</div>";
        }
    }

    if (empty ($_POST["city"])) {
        $cityErr = "<div class='alert alert-danger'>Yo what your ends be?</div>";
    }
    else {
        $city = ($_POST["city"]);
        if (!is_string($_POST["city"])) {
            $cityErr = "<div class='alert alert-danger'>That really your ends?</div>";
        }
    }

    if (empty ($_POST["zipcode"])) {
        $zipErr = "<div class='alert alert-danger'>Hey we need your zip for some reason</div>";
    }
    else {
        $zip = ($_POST["zipcode"]);
        if (!is_numeric($_POST["zipcode"])) {
            $zipErr = "<div class='alert alert-danger'>That's not even a number. Try again with a real zipcode you piece of shit.</div>";
        }
    }
}
echo $email;
echo $emailErr;
echo $street;
echo $streetErr;
echo $streetnum;
echo $zip;
echo $zipErr;


$totalValue = 0;
/*foreach ($_POST['price'] as $value) {
    $totalValue += (int)$value;
}*/

//whatIsHappening();

require 'form-view.php';