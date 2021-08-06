<?php
    // inicializavimas. pirmas apsilankymas puslapyje
    include("./visitorFunctions.php");
    init();
    include("./generateTable.php");

    // naujo objekto įrašymas į sesiją
    if(isset($_POST['name']) && !isset($_POST['visitorId'])){
        store();
    }
   // jei redagavimas, formos užpildymui
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['visitorId'])){
        $visitor = find();
    }
    // update
    if(isset($_POST['name']) && isset($_POST['visitorId'])){
        update();
    }

    // objekto trynimas
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['visitorId'])){
        destroy();
    }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Document</title>

</head>
<body>

    <form action="" method="post">
         <?= (isset($visitor)) ? '<input type="hidden" name="visitorId" value="'.$visitor['visitorId'].'">':""?>
        <input type="text" name="surname" value=<?=(isset($visitor)) ? $visitor['surname'] :""?>>
        <input type="text" name="name" value=<?=(isset($visitor)) ? $visitor['name'] :""?>>
        <input type="text" name="ticketPrice" value=<?=(isset($visitor)) ? $visitor['ticketPrice'] :""?>>
        <input type="date" name="date" value=<?=(isset($visitor)) ? $visitor['date'] :""?>>
        <button type="submit">atnaujinti</button>
    </form>

<?php


generateTable($_SESSION['visitors']);
?>


</body>
</html>