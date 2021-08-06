


<?php

    function init(){
        session_start();
        if(!isset($_SESSION['zoo'])){
            $_SESSION['zoo'] = [];
            $_SESSION['id'] = 1;
        }
    }

    function store(){
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

    function update(){
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

    function destroy(){
        foreach ($_SESSION['zoo'] as $key => &$animal) {
            if($animal['id'] == $_POST['id']){
                unset($_SESSION['zoo'][$key]);
                header("location:./");
                die;   
            }
        }
    }

    function find(){
        $animal = [];
        foreach ($_SESSION['zoo'] as $key => $entry) {
           if($entry['id'] == $_GET['id']){
               $animal = $entry;
               break; 
           }
        }
        return $animal;
    }
?>