<?php

//  constante d'environnement 
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "greatalumni_1");

//dsn de connection
$dsn = "mysql:dbname=" . DB_NAME . "; host=" . DB_HOST;

//maintenant on tante de se connecter  a la base de données
try {
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->exec("SET NAMES utf8");
    //on peut definir le mode de fetch par defaut comme suit:
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("");
}
         
//pour executer les requets esql;

    //    $db->query($sql); 
    //    $resul=$db;
    //        $userInfos=$resul->fetchAll();

    //        var_dump(userInfos["nom de la colonnne"]);