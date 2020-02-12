<?php

declare(strict_types = 1);

/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/



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

$food = [
    ['name' => 'Pesto Mozzarella', 'price' => 3],
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Ham & Cheese', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5],
    ['name' => 'Steve Steak Sausages, eggs n ham', 'price' => 6]
];

$drank = [
    ['name' => 'Coke', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => '7up', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 2],
    ['name' => 'Ice-tea Green', 'price' => 3],
    ['name' => 'Smelly Nelly', 'price' => 5]
];

//food & drank schwitz
$products = $drank;
if (isset($_GET["food"])) {
    if ($_GET["food"] == 1) {
        $products = $food;
    }
    else {
        $products = $drank;
    }
}


$totalValue = 0;
/*foreach ($_POST['price'] as $value) {
    $totalValue += (int)$value;
}*/

$emailErr = $streetErr = $streetnumErr = $cityErr = $zipErr = null;
$email = $street = $streetnum = $city = $zip = null;


//EMAIL VALIDATION
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "<div class='alert alert-danger'>Don't forget to enter your e-mail address!</div>";
    }
    else {
        $email = ($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "<div class='alert alert-danger'>Hey, that doesn't even look like an email address!</div>";
        }
    }

//ADDRESS VALIDATION
    if (empty($_POST["street"])) {
        $streetErr = "<div class='alert alert-danger'>We won't be able to deliver a meal without knowing a nice street name.</div>";
    }
    else {
        $street = ($_POST["street"]);
        if (!is_string($_POST["street"])) {
            $streetErr = "<div class='alert alert-danger'>Sorry, I'm not sure that's legit.</div>";
        }
        else {
            $_SESSION['street'] = $street;
        }
    }

    if (empty($_POST["streetnumber"])) {
        $streetnumErr = "<div class='alert alert-danger'>It'd be a lot easier if we knew where you lived</div>";
    }
    else {
        $streetnum = ($_POST["streetnumber"]);
        if (!is_numeric($_POST["streetnumber"])) {
            $streetnumErr = "<div class='alert alert-danger'>That can't possibly be a number...</div>";
        }
        else {
            $_SESSION['streetnumber'] = $streetnum;
        }
    }

    if (empty($_POST["city"])) {
        $cityErr = "<div class='alert alert-danger'>Yo what your ends be?</div>";
    }
    else {
        $city = ($_POST["city"]);
        if (!is_string($_POST["city"])) {
            $cityErr = "<div class='alert alert-danger'>That really your ends? NAH B! At least enter one that exists</div>";
        }
        else {
            $_SESSION['city'] = $city;
        }

    }

    if (empty ($_POST["zipcode"])) {
        $zipErr = "<div class='alert alert-danger'>Hey we need your zip for some reason</div>";
    }
    else {
        $zip = ($_POST["zipcode"]);
        if (!is_numeric($_POST["zipcode"])) {
            $zipErr = "<div class='alert alert-danger'>That's not even a number. Try again with a real zip code ya shithead.</div>";
        }
        else {
            $_SESSION['zip'] = $zip;
        }
    }
}

if ($_SESSION['email'] || $_SESSION['street'] || $_SESSION['streetnumber'] || $_SESSION['city'] || $_SESSION['zip']) {
    $email = $_SESSION['email'];
    $street = $_SESSION['street'];
    $streetnum = $_SESSION['streetnumber'];
    $city = $_SESSION['city'];
    $zip = $_SESSION['zip'];
}

//COUNTDOWN
/*$twoHours = time() + (0 * 0 * 2 * 0);
var_dump($twoHours);*/

$delivery = "Delivery: normal";
if (empty($_POST['express'])) {
    $delivery = "Delivery: normal";
}
else {
    $delivery = "Delivery: much speedy";
}

if ($delivery == "Delivery: normal" ) {
    $delivery = $delivery."If your order hasn't arrived by". date('h.i.s A', strtotime('+ 2 hours')). "you may come over and slap one of our employees";
}
elseif ($delivery == "Delivery; much speedy") {
    $delivery = $delivery."If your order hasn't arrived by". date('h.i.s A', strtotime('+ 45 minutes')). "you can set our business on fire";
}


//whatIsHappening();

require 'form-view.php';