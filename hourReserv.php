<?php 
require 'db/db.php';

     if($_POST){
         
         $fecha=date("Y-m-d",strtotime($_POST["param"] ));
     
          $dbHours=$database->query("select time from tbtime where 
         tbtime.time not in(select tbreservations.reservationHour from tbreservations where tbreservations.date='".$fecha."');")->fetchAll(PDO::FETCH_ASSOC);
         
        //$dbPeople= $database->query("")->fetchAll(PDO::FETCH_ASSOC);
         
            createJSON($dbHours);
      
     }
/*------------this is a method that make the list of the hours to reserv-------------------*/
function createJSON($data){
        $len = count($data);
    
        for($i=0; $i<$len; $i++) {

            $item = new stdClass;
            $item->name = $data[$i]["time"];
            $items[] = $item;
        }
        echo json_encode($items);
    }

?>