<?php


function check_login($conm)
{

//Controleren of de sessiewaarde bestaat
if(isset($_SESSION['user_id']))
{
    //check of de user echt echt is
    $id = $_SESSION['user_id'];
    $query = "select * from users where user_id = $id limitt 1";

    $result = mysqli_query($con,&query);
    if($result && mysqli_num_rows($result) > 0)
    {

            //als hij/zij echt is return user data
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }

    }

    //Doorverwijzen naar inloggen
    header("Location: login.php");
    die;
}

function random_num($length)
{

    $text = "";
    if($length < 5)
    {
        $length = 5;
    }

    $len = rand(4,$length);

    for ($i=0; $i < $len; $i++){
        # code...

        $text .= rand(0,9);

    }
    

    return $text;
}