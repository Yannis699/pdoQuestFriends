<?php

require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);

if(
    isset($_POST['firstname'])&&
    isset($_POST['lastname'])
)

{
    $data = array_map('trim', $_POST);

    $firstname = $data['firstname'];
    $lastname = $data['lastname'];

    $query = 'INSERT INTO friend(lastname, firstname) VALUES (:nom, :prenom)';
    $statement = $pdo->prepare($query);

    $statement->bindValue(':prenom', $firstname, PDO::PARAM_STR);
    $statement->bindValue(':nom', $lastname, PDO::PARAM_STR);

    $statement->execute();

    header('Location: /form.php');
    die();

}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   

<form  action=""  method="post">
    <p>
      <label  for="firstname">Firstname :</label>
      <input  type="text"  id="firstname"  name="firstname">
    </p>

    <p>
        <label for="lastname">Lastname :</label>
        <input type="text" id="lastname" name="lastname">
    </p>

    <p>
        <input type="submit" name="submit"></input>
    </p>

    <?php
        foreach($friends as $friend)
        {
            echo  '<li>' . $friend['firstname'] . " " . $friend['lastname'] . '<li>';
        }

   ?>
</body>
</head>