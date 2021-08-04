<?php
    // inicializavimas. pirmas apsilankymas puslapyje
    session_start();
    if(!isset($_SESSION['zoo'])){
        $_SESSION['zoo'] = [];
        $_SESSION['id'] = 1;
    }
    // naujo objekto įrašymas į sesiją
    if(isset($_POST['name']) && !isset($_POST['id'])){
        $animal = [];
        $animal['id'] = $_SESSION['id'];
        $animal['species'] = $_POST['species'];
        $animal['name'] = $_POST['name'];
        $animal['age'] = $_POST['age']; 

        $_SESSION['zoo'][] = $animal;

        $_SESSION['id']++;
        header("location:./");
        die;
    }
    // update

    if(isset($_POST['name']) && isset($_POST['id'])){

        foreach ($_SESSION['zoo'] as $key => &$animal) {

            if($animal['id'] == $_POST['id']){

                $_SESSION['zoo'][$key]['species'] = $_POST['species'];
                $_SESSION['zoo'][$key]['name'] = $_POST['name'];
                $_SESSION['zoo'][$key]['age'] = $_POST['age'];
                header("location:./");
                die;   
            }
        }
    }
    // objekto trynimas
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
        foreach ($_SESSION['zoo'] as $key => &$animal) {
            if($animal['id'] == $_POST['id']){
                unset($_SESSION['zoo'][$key]);
                header("location:./");
                die;   
            }
        }
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
<?php
 if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
     $animal = [];
     foreach ($_SESSION['zoo'] as $key => $entry) {
        if($entry['id'] == $_GET['id']){
            $animal = $entry;
            break; 
        }
     }
     ?>
    <form action="" method="post">
        <input type="hidden" name="id" value=<?=$animal['id']?>>
        <input type="text" name="species" value=<?=$animal['species']?>>
        <input type="text" name="name" value=<?=$animal['name']?>>
        <input type="text" name="age" value=<?=$animal['age']?>>
        <button type="submit">atnaujinti</button>
    </form>

<?php }else{ ?>

    <form action="" method="post">
        <input type="text" name="species">
        <input type="text" name="name">
        <input type="text" name="age">
        <button type="submit">pridėti</button>
    </form>

<?php } ?>

<table class="table">
  <tr>
    <th>id</th>
    <th>Gyvūno rūšis</th>
    <th>Gyvūno vardas</th>
    <th>Gyvūno amžius</th>
    <th>edit</th>
    <th>delete</th>
  </tr>
  <?php foreach ($_SESSION['zoo'] as $animal) { ?>
    <tr>
        <td><?=$animal['id']?></td>
        <td><?=$animal['species']?></td>
        <td><?=$animal['name']?></td>
        <td><?=$animal['age']?></td>
        <td>
           <a href="?id=<?=$animal['id']?>"> 
               <div class="btn btn-primary">redaguoti</div>
            </a>
        </td>
        <td>
            <form action="" method="post">
                <input type="hidden" name="id" value=<?=$animal['id']?>>
                <input class="btn btn-danger" type="submit" value="trinti">
            </form>
        </td>
    </tr> 
 <?php } ?>
</table>

</body>
</html>