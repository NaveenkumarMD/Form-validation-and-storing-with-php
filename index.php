<?php
$name = $branch = $college = $Address = $location = $age = $aadhar = $father = $mobile = $mail = "";
$namemessage = $branchmessage = $collegemessage = $Addressmessage = $locationmessage = $agemessage = $aadharmessage = $fathermessage = $mobilemessage = $mailmessage = "<img src='./working.png' class='imgcross'>";
$flag=true;

global $user,$password,$db;
$user="root";
$password='';
$db='form';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $branch = test_input($_POST["branch"]);
    $college = test_input($_POST["college"]);
    $mail = test_input($_POST["mail"]);
    $mobile = test_input($_POST["mobile"]);
    $Address = test_input($_POST["address"]);
    $location = test_input($_POST["location"]);
    $age = test_input($_POST["age"]);
    $aadhar = test_input($_POST["aadhar"]);

    validate($name, $branch, $college, $Address, $location, $age, $aadhar, $mobile, $mail);
}


function validate($name, $branch, $college, $Address, $location, $age, $aadhar, $mobile, $mail)
{
    // $values = get_defined_vars();
    // // Checking for empty values
    // // foreach ($values as $field) {
    // //     if (empty($field)) {
    // //         alert("Enter all the fields");
    // //         break;
    // //     }
    // // }

    // //text for name branch college location
    $text_regex = '/^[a-zA-Z ]*$/';
    global $namemessage, $branchmessage, $collegemessage, $locationmessage,$flag;
    if (preg_match($text_regex, $name) && !empty($name)) {
        $namemessage = "<img src='./right.png' class='img'>";
    } else {
        $namemessage = "<img src='./cross.png' class='imgcross'>";
        $flag=false;
        
    }
    if (preg_match($text_regex, $branch) && !empty($branch)) {
        $branchmessage = "<img src='./right.png' class='img'>";
    } else {
        $branchmessage = "<img src='./cross.png' class='imgcross'>";
        $flag=false;
    }
    if (preg_match($text_regex, $location) && !empty($location)) {
        $locationmessage = "<img src='./right.png' class='img'>";
    } else {
        $locationmessage = "<img src='./cross.png' class='imgcross'>";
        $flag=false;
    }
    if (preg_match($text_regex, $college) && !empty($college)) {
        $collegemessage = "<img src='./right.png' class='img'>";
    } else {
        $collegemessage = "<img src='./cross.png' class='imgcross'>";
        $flag=false;
    }


    //Mobile
    global $mailmessage, $mobilemessage, $Addressmessage;
    $Addressmessage = "<img src='./right.png' class='img'>";
    if (empty($Address)) {
        $Addressmessage = "<img src='./cross.png' class='imgcross'>";
        $flag=false;
    }
    if (preg_match('/^[6-9]\d{9}$/', $mobile) && !empty($mobile)) {
        $mobilemessage = "<img src='./right.png' class='img'>";
    } else {
        $mobilemessage = "<img src='./cross.png' class='imgcross'>";
        $flag=false;
    }
    if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mail) && !empty($mail)) {
        $mailmessage = "<img src='./right.png' class='img'>";
    } else {
        $mailmessage = "<img src='./cross.png' class='imgcross'>";
        $flag=false;
    }
    global $aadharmessage, $agemessage;
    if (preg_match("/^[0-9]+$/i", $age) && strlen($age) < 3 && !empty($age)) {
        $agemessage = "<img src='./right.png' class='img'>";
    } else {
        $agemessage = "<img src='./cross.png' class='imgcross'>";
        $flag=false;
    }
    if (preg_match("/^[0-9]+$/i", $aadhar) && strlen($aadhar)==12 && !empty($aadhar)) {
        $aadharmessage = "<img src='./right.png' class='img'>";
    } else {
        $aadharmessage = "<img src='./cross.png' class='imgcross'>";
        $flag=false;
    }
    //Mail
    //Aadhar mobile and age
    global $user,$db,$password;
    if($flag==true){
        echo $user;
        echo $password;
        echo $db;
        $connection=new mysqli('localhost',$user,$password,$db) or die("unable to connect");
        echo "Connecte";
        $query="INSERT INTO user VALUES('$name','$mail','$mobile','$branch','$college','$Address','$location','$age','$aadhar')";
        if($connection->query($query)==true){
            echo "record inserted";
        }
        else{
            echo "err".$connection->error;
        }
    }

}
function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function addtodb(){
    echo "<h1>Affeedgasahetah</h1>";
    alert("hllo");
    // header("Location:./index.html");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .img {
            width: 30px;
            height: 30px;
            margin-bottom: 10px;
            margin-left: 10px;
        }

        .imgcross {
            width: 30px;
            height: 30px;
            margin-left: 10px;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-middle">
        <div class="container py-3 border border-3 rounded my-5 shadow-lg ">
            <div class="h1 text-center text-success py-5">Validation-details</div>
            <div>
                <div class="h4 text-center py-2">Name:<?php echo "$namemessage"; ?></div>
                <div class="h4 text-center py-2">Branch:<?php echo "$branchmessage"; ?></div>
                <div class="h4 text-center py-2">College:<?php echo "$collegemessage"; ?></div>
                <div class="h4 text-center py-2">Location:<?php echo "$locationmessage"; ?></div>
                <div class="h4 text-center py-2">Mobile:<?php echo "$mobilemessage"; ?></div>
                <div class="h4 text-center py-2">Mail:<?php echo "$mailmessage"; ?></div>
                <div class="h4 text-center py-2">Address:<?php echo "$Addressmessage"; ?></div>
                <div class="h4 text-center py-2">Age:<?php echo "$agemessage"; ?></div>
                <div class="h4 text-center py-2">Aadhar:<?php echo "$aadharmessage"; ?></div>
            </div>



        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>