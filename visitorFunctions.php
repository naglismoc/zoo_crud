


<?php

    function init(){
        session_start();
        if(!isset($_SESSION['visitors'])){
            $_SESSION['visitors'] = [];
            $_SESSION['visitorId'] = 1;

            $_SESSION['visitors'] = [];
            $_SESSION['visitorId'] = 1;
        }
    }

    function store(){
        $visitor = [];
        $visitor['visitorId'] = $_SESSION['visitorId'];
        $visitor['surname'] = $_POST['surname'];
        $visitor['name'] = $_POST['name'];
        $visitor['ticketPrice'] = $_POST['ticketPrice'];
        $visitor['date'] = $_POST['date'];

        $_SESSION['visitors'][] = $visitor;

        $_SESSION['visitorId']++;
        header("location:./visitors.php");
        die;
    }

    function update(){
        foreach ($_SESSION['visitors'] as $key => &$visitor) {

            if($visitor['visitorId'] == $_POST['visitorId']){

                $_SESSION['visitors'][$key]['surname'] = $_POST['surname'];
                $_SESSION['visitors'][$key]['name'] = $_POST['name'];
                $_SESSION['visitors'][$key]['ticketPrice'] = $_POST['ticketPrice'];
                $_SESSION['visitors'][$key]['date'] = $_POST['date'];
                header("location:./visitors.php");
                die;   
            }
        }
    }

    function destroy(){
        foreach ($_SESSION['visitors'] as $key => &$visitor) {
            if($visitor['visitorId'] == $_POST['visitorId']){
                unset($_SESSION['visitors'][$key]);
                header("location:./visitors.php");
                die;   
            }
        }
    }

    function find(){
        $visitor = [];
        foreach ($_SESSION['visitors'] as $key => $entry) {
           if($entry['visitorId'] == $_GET['visitorId']){
               $visitor = $entry;
               break; 
           }
        }
        return $visitor;
    }
?>