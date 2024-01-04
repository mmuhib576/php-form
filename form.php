<!--Assignment 4 Submitted by

    Syed Sirajul Hasan - 8836760
    Muhib Mohammed - 8859576
-->
<!DOCTYPE html>  
<html>  
<head>
<link rel="stylesheet" href="style.css">  
<style>  
.error {color: #FF0001;}  
</style>  
</head>  
<body>    
  
<?php  
// define variables to empty values  
$nameErr = $phoneErr = $emailErr =  $addressErr = $cityErr = $postcodeErr = $creditErr = $creditmonthErr = $credityearErr = $passwordErr = $confirmpasswordErr = "";  
$name = $phone = $email = $address = $city = $postcode = $province = $password = $confirmpassword = $credit = $creditMonth = $creditYear = $prod1 = $prod2 = $prod3 = "";  
  
//Input fields validation  
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{  
      
    //Name Validation  
    if (empty($_POST["name"])) 
    {  
         $nameErr = "Name cannot be empty";  
    } 
    else 
    {  
        $name = validate($_POST["name"]);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
            {  
                $nameErr = "Only alphabets and white space are allowed";  
            }  
    }
    
    //Phone Number Validation  
    if (empty($_POST["phone"])) 
    {  
        $phoneErr = "Phone Number cannot be empty";  
    } 
    else
    {  
        $phone = validate($_POST["phone"]);

        // check phone number contains only numbers
        if (!preg_match ("/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/", $phone) ) 
        {  
            $phoneErr = "Phone Number cannot contain characters";  
        } 
    } 
      
    //Email Validation   
    if (empty($_POST["email"])) 
    {  
        $emailErr = "Email cannot be empty";  
    } 
    else 
    {  
        $email = validate($_POST["email"]);

        // check that the e-mail address is according to the format  
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {  
            $emailErr = "Incorrect Email Format";  
        }  
    }    
      
    //City Validation  
    if (empty($_POST["city"])) 
    {  
        $cityErr = "City cannot be empty";  
    } 
    else 
    {  
        $city = validate($_POST["city"]);  
    }
    
    //Address Validation
    if (empty($_POST['address']))
    {  
        $addressErr = "Address cannot be empty";  
    }
    else 
    {  
        $address = validate($_POST["address"]);  
    }
  
    //Postcode Validation  
    if (empty($_POST['postcode']))
    {  
        $postcodeErr = "Postcode cannot be empty";  
    } 
    else 
    {  
        $postcode = validate($_POST["postcode"]);
        
        //check Postcode is correct...should be "A21B 2AB"
        if (!preg_match("/^[A-Z]{1,2}[0-9]{1,2}[A-Z]? [0-9][A-Z]{2}$/", $postcode))
            
        {  
            $postcodeErr = "Incorrect Post Code Format";  
        }
    }

    //Credit Number Validation
    if (empty($_POST['credit']))
    {  
        $creditErr = "Credit Card cannot be empty";  
    } 
    else 
    {  
        $credit = validate($_POST["credit"]);
        
        //check Credit Number is correct 
        if (!preg_match("/^\d{4}[\s.-]?\d{4}[\s.-]?\d{4}[\s.-]?\d{4}$/", $credit))
            
        {  
            $creditErr = "Incorrect Credit Card Number Format";  
        }
    }
     
    //Credit Card Expiry Month Validation
    if (empty($_POST['creditMonth']))
    {  
        $creditmonthErr = "Credit Card Expiry Month cannot be empty";  
    } 
    else 
    {  
        $creditMonth = validate($_POST["creditMonth"]);
         
        //check Credit Number is correct 
        if (!preg_match("/^(\D{3})$/", $creditMonth))
        {  
            $creditmonthErr = "Incorrect Credit Card Expiry Month Format";  
        }
    }

    //Credit Card Expiry Year Validation
    if (empty($_POST['creditYear']))
    {  
        $credityearErr = "Credit Card Expiry Year cannot be empty";  
    } 
    else 
    {  
        $creditYear = validate($_POST["creditYear"]);
         
        //check Credit Number is correct 
        if (!preg_match("/^(\d{4})$/", $creditYear))
        {  
            $credityearErr = "Incorrect Credit Card Expiry Year Format";  
        }
    }

    //Password & confirm password Validation.
    if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["confirmpassword"]))
    {
        $password = validate($_POST["password"]);
        
        if (strlen($_POST["password"]) <= '8') 
        {
            $passwordErr = "Your Password Must Contain At Least 8 Characters!";
        }
        elseif(!preg_match("#[0-9]+#",$password)) 
        {
            $passwordErr = "Your Password Must Contain At Least 1 Number!";
        }
        elseif(!preg_match("#[A-Z]+#",$password)) 
        {
            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        }
        elseif(!preg_match("#[a-z]+#",$password)) 
        {
            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }
    }
    elseif(!empty($_POST["password"]) && ($_POST["password"] != $_POST["confirmpassword"])) 
    {
        $passwordErr = "Please enter matching password";
        $confirmpasswordErr = "Please enter matching password";
    } 
    else 
    {
        $passwordErr = "Password cannot be empty";
    }

    $prod1 = $_POST['prod1'];
    $prod2 = $_POST['prod2'];
    $prod3 = $_POST['prod3'];
    $address = $_POST['address'];
}

function validate($info) 
{  
  $info = trim($info);  
  $info = stripslashes($info);  
  $info = htmlspecialchars($info);  
  return $info;  
}  
?>  
<div class="container">  
<h2>&emsp;&emsp;&emsp;Fill your details and Place Your Order Here ...</h2>  
<span class = "error">&emsp;* means field is required (mandatory)</span>  
<br><br>  
<form id="forminfo" method="post" class ="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >

    <table>
        <h3>Your Information</h3>    
        <tr>
            <td>Name:</td> 
            <td><input type="text" name="name">  
                <span class="error">* <?php echo $nameErr; ?></span>
            </td>
        </tr>

        <tr>
            <td>Phone Number:</td>   
            <td><input type="text" name="phone">  
                <span class="error">* <?php echo $phoneErr; ?></span> 
            </td> 
        </tr>
  
        <tr>
            <td>E-mail:</td>   
            <td><input type="text" name="email">  
                <span class="error">* <?php echo $emailErr; ?></span> 
            </td> 
        </tr>

        <tr>
            <td>Password:</td>   
            <td><input type="password" name="password" placeholder="Password">  
                <span class="error">* <?php echo $passwordErr; ?></span> 
            </td> 
        </tr>

        <tr>
            <td>Confirm Password:</td>   
            <td><input type="password" name="confirmpassword" placeholder="Confirm Password"> 
            </td> 
        </tr>

        <tr>
            <td>Address:</td>   
            <td><input type="text" name="address">
            <span class="error">* <?php echo $addressErr; ?></span>
            </td> 
        </tr>

        <tr>
            <td>City:</td>   
            <td><input type="text" name="city">
            <span class="error">* <?php echo $cityErr; ?></span>
            </td> 
        </tr>

        <tr>
            <td>Postcode:</td>   
            <td><input type="text" name="postcode">  
                <span class="error">* <?php echo $postcodeErr; ?></span> 
            </td> 
        </tr>
        
        <tr>
            <td>Province:</td>   
            <td><select name="province">
                <option value="Alberta">Alberta</option>
                <option value="Ontario">Ontario</option>
                <option value="Quebec">Quebec</option>
                </select>
            </td> 
        </tr>

        <tr>
            <td>Quantity of Product 1:</td>   
            <td><input type="text" name="prod1">
            </td> 
        </tr>

        <tr>
            <td>Quantity of Product 2:</td>   
            <td><input type="text" name="prod2">
            </td> 
        </tr>

        <tr>
            <td>Quantity of Product 3:</td>   
            <td><input type="text" name="prod3"> 
            </td> 
        </tr>

        <tr>
            <td>Credit Card Number:</td>   
            <td><input type="text" name="credit" placeholder="xxxx-xxxx-xxxx-xxxx">  
                <span class="error">* <?php echo $creditErr; ?></span> 
            </td> 
        </tr>

        <tr>
            <td>Credit Card Expiry Month:</td>   
            <td><input type="text" name="creditMonth" placeholder="mon">  
                <span class="error">* <?php echo $creditmonthErr; ?></span> 
            </td> 
        </tr>

        <tr>
            <td>Credit Card Expiry Year:</td>   
            <td><input type="text" name="creditYear" placeholder="YYYY">  
                <span class="error">* <?php echo $credityearErr; ?></span> 
            </td> 
        </tr>

        <td>
            <input type = "submit" name = "submit" value = "Submit" class="button">
        </td>
    </table>
    
</form>  

<?php  
    if(isset($_POST['submit'])) 
    { 
        if($nameErr == "" && $emailErr == "" && $addressErr == "" && $postcodeErr == "" && $passwordErr == "" && $confirmpasswordErr == "" && $cityErr == "" && $phoneErr == "" &&  $creditErr == "" && $creditmonthErr == "" && $credityearErr == "") 
        {
            define('Shawarma', 6);
            define('Lemonade', 2);
            define('Dessert', 3);
            $totalqty = 0;
            $totalamount = 0.00;
            $totalqty = (int)$prod1 + (int)$prod2 + (int)$prod3;
            $totalamount = (int)$prod1 * Shawarma + (int)$prod2 * Lemonade + (int)$prod3 * Dessert; 
            if($totalamount >= 10)
                {

                    echo "<h3 color = #00FF001> <b>You have sucessfully placed your order.</b> </h3>";

                    echo "<h2>&emsp;&emsp;Invoice:</h2>";

                    //Basic Details displayed
                    echo "<h3>Your Details</h3>";  
                    echo "&emsp;&emsp;&emsp;Name: " .$name;  
                    echo "<br>";
                    echo "&emsp;&emsp;&emsp;Phone No: " .$phone;  
                    echo "<br>";   
                    echo "&emsp;&emsp;&emsp;Email: " .$email;  
                    echo "<br>";
                    $province = $_POST['province'];  
                    echo "&emsp;&emsp;&emsp;Address: " .$address."," .$city."," .$province."," .$postcode.".";
                    echo "<br>";

                    //Payment Details displayed
                    echo "<h3>Your Payment Details:</h3>";
                    echo "&emsp;&emsp;&emsp;Credit Card Number: " .$credit;
                    echo "<br>";
                    echo "&emsp;&emsp;&emsp;Credit Card Expiry Month: " .$creditMonth;
                    echo "<br>";
                    echo "&emsp;&emsp;&emsp;Credit Card Expiry Year: " .$creditYear;
                    echo "<br>";

                    //Order Details displayed
                    echo "<h3>Your Order Details</h3>";
                    echo "<h4>&emsp;&emsp;&emsp;Items Ordered:</h4>";
                    echo "&emsp;&emsp;&emsp;Special Shawarma: " .$prod1 ."item(s)";
                    echo "<br>";
                    echo "&emsp;&emsp;&emsp;Lemonade: " .$prod2 ."item(s)";
                    echo "<br>";
                    echo "&emsp;&emsp;&emsp;Arabian Dessert: " .$prod3 ."item(s)";
                    echo "<br>";                     
                    echo "<p>&emsp;&emsp;&emsp;Total Number of Items ordered: ".$totalqty."<br />";
                    echo "&emsp;&emsp;&emsp;Total before tax: $".number_format($totalamount,2)."<br />";
                    
                    //different tax rates for different provinces
                    $province = $_POST['province'];
                    switch ($province) 
                    {
                        case 'Alberta':
                            $tax = 0.9;  
                            // local sales tax is 9% in Alberta
                            $totalamount = $totalamount * (1 + $tax);
                            echo "&emsp;&emsp;&emsp;Total including tax: $".number_format($totalamount,2)."</p>";
                            echo "&emsp;&emsp;&emsp;*Local sales tax is 9% in Alberta";
                            break;
                        case 'Ontario':
                            $tax = 0.13;  
                            // local sales tax is 13% in Ontario
                            $totalamount = $totalamount * (1 + $tax);
                            echo "&emsp;&emsp;&emsp;Total including tax: $".number_format($totalamount,2)."</p>";
                            echo "&emsp;&emsp;&emsp;*Local sales tax is 13% in Ontario";
                            break;
                    case 'Quebec':
                            $tax = 0.10;  
                            // local sales tax is 10% in Quebec
                            $totalamount = $totalamount * (1 + $tax);
                            echo "&emsp;&emsp;&emsp;Total including tax: $".number_format($totalamount,2)."</p>";
                            echo "&emsp;&emsp;&emsp;*Local sales tax is 10% in Quebec";
                    default:
                            break;
                    }
                }
            else 
            {  
            echo "<h3>&emsp;&emsp;&emsp; <b>Minimum purchase should be worth more than or equal to $10.</b> </h3>";  
            }
        }
        else
        {
            echo "<h3>&emsp;&emsp;&emsp; <b>You didn't filled up the form correctly.</b> </h3>";
        }
    } 
?>

</div>
</body>  
</html>  