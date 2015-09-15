<script>
//Display a confirmation box when trying to delete an object
function showConfirm(id)
{
    // build the confirmation box
    var c = confirm("Jeni i sigurte qe doni ta fshini?");
    
    // if true, delete item and refresh
    if(c)
        window.location = "CoffeeOverview.php?delete=" + id;
}
</script>

<?php
require ("Model/CoffeeModel.php");

//Contains non-database related function for the Coffee page
class CoffeeController {

    function CreateOverviewTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Id</b></td>
                    <td><b>Projekti</b></td>
                    <td><b>Tipi</b></td>
                    <td><b>Koha</b></td>
                    <td><b>Prioriteti</b></td>
                    <td><b>Vendi</b></td>
                </tr>";

        $coffeeArray = $this->GetCoffeeByType('%');

        foreach ($coffeeArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td><a href='CoffeeAdd.php?update=$value->id'>Modifiko</a></td>
                        <td><a href='#' onclick='showConfirm($value->id)'>Fshi</a></td>
                        <td>$value->id</td>
                        <td>$value->name</td>
                        <td>$value->type</td>    
                        <td>$value->price</td> 
                        <td>$value->roast</td>
                        <td>$value->country</td>   
                    </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }

    function CreateCoffeeDropdownList() {
        $coffeeModel = new CoffeeModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Kerkoni Tipin e Projektit: 
                    <select name = 'types' >
                        <option value = '%' >Te gjitha</option>
                        " . $this->CreateOptionValues($this->GetCoffeeTypes()) .
                "</select>
                     <input type = 'submit' value = 'Kerko' />
                    </form>";

        return $result;
    }

    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }

    function CreateCoffeeTables($types) {
        $coffeeModel = new CoffeeModel();
        $coffeeArray = $coffeeModel->GetCoffeeByType($types);
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($coffeeArray as $key => $coffee) {
            $result = $result .
                    "<table class = 'coffeeTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$coffee->image' /></th>
                            <th width = '75px' >Projekti: </th>
                            <td>$coffee->name</td>
                        </tr>
                        
                        <tr>
                            <th>Tipi: </th>
                            <td>$coffee->type</td>
                        </tr>
                        
                        <tr>
                            <th>Koha: </th>
                            <td>$coffee->price</td>
                        </tr>
                        
                        <tr>
                            <th>Prioriteti: </th>
                            <td>$coffee->roast</td>
                        </tr>
                        
                        <tr>
                            <th>Vendi: </th>
                            <td>$coffee->country</td>
                        </tr>
                        
                        <tr>
                             <th>Koment: </th>
                            <td colspan='2' >$coffee->review</td>
                        </tr>                      
                     </table>";
        }
        return $result;
    }

    //Returns list of files in a folder.
    function GetImages() {
        //Select folder to scan
        $handle = opendir("Images/Coffee");

        //Read all files and store names in array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }

        closedir($handle);

        //Exclude all filenames where filename length < 3
        $imageArray = array();
        foreach ($images as $image) {
            if (strlen($image) > 2) {
                array_push($imageArray, $image);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }

    //<editor-fold desc="Set Methods">
    function InsertCoffee() {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $roast = $_POST["txtRoast"];
        $country = $_POST["txtCountry"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];

        $coffee = new CoffeeEntity(-1, $name, $type, $price, $roast, $country, $image, $review);
        $coffeeModel = new CoffeeModel();
        $coffeeModel->InsertCoffee($coffee);
    }

    function UpdateCoffee($id) {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $roast = $_POST["txtRoast"];
        $country = $_POST["txtCountry"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];

        $coffee = new CoffeeEntity($id, $name, $type, $price, $roast, $country, $image, $review);
        $coffeeModel = new CoffeeModel();
        $coffeeModel->UpdateCoffee($id, $coffee);
    }

    function DeleteCoffee($id) 
    {
        $coffeeModel = new CoffeeModel();
        $coffeeModel->DeleteCoffee($id);
    }

    //</editor-fold>
    //<editor-fold desc="Get Methods">
    function GetCoffeeById($id) {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->GetCoffeeById($id);
    }

    function GetCoffeeByType($type) {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->GetCoffeeByType($type);
    }

    function GetCoffeeTypes() {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->GetCoffeeTypes();
    }

    //</editor-fold>
}
?>
