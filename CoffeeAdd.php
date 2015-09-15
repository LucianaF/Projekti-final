<?php
require './Controller/CoffeeController.php';
$coffeeController = new CoffeeController();

$title = "Shto Projekt te Ri";

if(isset($_GET["update"]))
{
    $coffee = $coffeeController->GetCoffeeById($_GET["update"]);
    
    $content ="<form action='' method='post'>
    <fieldset>
        <legend>Shto Projekt te Ri</legend>
        <label for='name'>Projekti: </label>
        <input type='text' class='inputField' name='txtName' value='$coffee->name'  /><br/>

        <label for='type'>Tipi: </label>
        <select class='inputField' name='ddlType'>
            <option value='%'>All</option>"
        .$coffeeController->CreateOptionValues($coffeeController->GetCoffeeTypes()).
        "</select><br/>

        <label for='price'>Koha: </label>
        <input type='text' class='inputField' name='txtPrice' value='$coffee->price'/><br/>

        <label for='roast'>Prioriteti: </label>
        <input type='text' class='inputField' name='txtRoast' value='$coffee->roast' /><br/>

        <label for='country'>Vendi: </label>
        <input type='text' class='inputField' name='txtCountry' value='$coffee->country' /><br/>

        <label for='image'>Skema: </label>
        <select class='inputField' name='ddlImage'>"
        .$coffeeController->GetImages().
        "</select></br>

        <label for='review'>Komente: </label>
        <textarea cols='70' rows='12' name='txtReview'>$coffee->review</textarea></br>

        <input type='submit' value='Prano'>
    </fieldset>
</form>";
}
 else 
{
    $content ="<form action='' method='post'>
    <fieldset>
        <legend>Shto Projekt te Ri</legend>
        <label for='name'>Projekti: </label>
        <input type='text' class='inputField' name='txtName' /><br/>

        <label for='type'>Tipi: </label>
        <select class='inputField' name='ddlType'>
            <option value='%'>All</option>"
        .$coffeeController->CreateOptionValues($coffeeController->GetCoffeeTypes()).
        "</select><br/>

        <label for='price'>Koha: </label>
        <input type='text' class='inputField' name='txtPrice' /><br/>

        <label for='roast'>Prioriteti: </label>
        <input type='text' class='inputField' name='txtRoast' /><br/>

        <label for='country'>Vendi: </label>
        <input type='text' class='inputField' name='txtCountry' /><br/>

        <label for='image'>Skema: </label>
        <select class='inputField' name='ddlImage'>"
        .$coffeeController->GetImages().
        "</select></br>

        <label for='review'>Komente: </label>
        <textarea cols='70' rows='12' name='txtReview'></textarea></br>

        <input type='submit' value='Prano'>
    </fieldset>
</form>";
}


if(isset($_GET["update"]))
{
    if(isset($_POST["txtName"]))
    {
        $coffeeController->UpdateCoffee($_GET["update"]);
    }
}
else
{
    if(isset($_POST["txtName"]))
    {
        $coffeeController->InsertCoffee();
    }
}

include './Template.php';
?>


