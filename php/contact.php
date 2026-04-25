<?php
    $array = array("prenom" => "" , "nom" => "", "email" => "", "telephone" => "", "message" =>"", "prenomError" => "", "nomError" => "", "emailError" => "", "telephoneError" => "", "messageError" => "", "isSuccess" => false);
    //$emailTo = "bamahadiou@gmail.com";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $array["prenom"]    = verifyInput($_POST["prenom"]);
        $array["nom"]       = verifyInput($_POST["nom"]);
        $array["email"]     = verifyInput($_POST["email"]) ;
        $array["telephone"] = verifyInput($_POST["telephone"]);
        $array["message"]   = verifyInput($_POST["message"]);
        $array["isSuccess"] = true;
        //$mailText = "";

        if(empty($array["prenom"]))
        {
            $array["prenomError"] = "Verifier votre prenom";
            $array["isSuccess"]   = false;
        }/* 
        else{
            $mailText .= "Firstname : {$array["prenom"]}\n";
        } */
        if(empty($array["nom"]))
        {
            $array["nomError"] = "Verifier votre nom";
            $array["isSuccess"] = false;
        }/* 
        else{
            $mailText .= "Name : {$array["nom"]}\n";
        } */
        if(!isPhone($array["telephone"]))
        {
            $array["telephoneError"] = "des chiffres et des espaces sont seulement permis...";
            $array["isSuccess"] = false;
        }/* 
        else{
            $mailText .= "Telephone : {$array["telephone"]}\n";
        } */
        if(!isEmail($array["email"]) )
        {
            $array["emailError"] = "votre email est invalide";
            $array["isSuccess"] = false;
        }/* 
        else{
            $mailText .= "Email : {$array["email"]}\n";
        } */
        if(empty($array["message"]))
        {
            $array["messageError"] = "Verifier votre message";
            $array["isSuccess"] = false;
        }/* 
        else{
            $mailText .= "Message : {$array["message"]}\n";
        } */
     /* 
        if($array["isSuccess"]){
                $header = "from: {$array["prenom"]} {$array["nom"]} <{$array["email"]}>\r\nReply-to: {$array["email"]}";
                mail($emailTo,"Un message de votre cv en ligne",$mailText,$header);
            } */
        echo json_encode($array, JSON_PRETTY_PRINT);//permet de renvoyer le tableau au fichier json
        
    }

    // bind function
    function isPhone($val){
        return preg_match("/^[0-9 ]*$/", $val);
    }
        function isEmail($val){
            return filter_var($val,FILTER_VALIDATE_EMAIL);
        }
        function  verifyInput($var)
        {
              $var = trim($var);
              $var = stripslashes($var);
              $var = htmlspecialchars($var);
                return $var;
        }
        
?>
