<?php 

namespace App\Utils;

use DateInterval;
use DateTime;
use Symfony\Component\Validator\Constraints\Time;

class Trajet {
    function __CONSTRUCT(){
    }   

    function calculTotalKM(array $RdvPlanning): ?array {
        $_total = array(
            "kmLibre" => 0,
            "kmPaye" => 0,
        );

        foreach ($RdvPlanning as $client){
            $_total["kmLibre"] = $_total["kmLibre"] + $client->getKmLibre();
            $_total["kmPaye"] = $_total["kmPaye"] + $client->getKmPaye();
        }

        if ($_total["kmLibre"] + $_total["kmPaye"] != 0) {
            $_total["kmPayePourcentage"] = round($_total["kmPaye"]*100 / ($_total["kmLibre"] + $_total["kmPaye"]),2);
        } else {
            $_total["kmPayePourcentage"]=0;
        }
        return $_total;
    }

    function calculTempsTravaille(array $RdvPlanning): ?string {
        $tothour = 0;
        foreach ($RdvPlanning as $client){
            $interval = date_diff($client->getHeureFin() , $client->getHeureDebut());
            $nbHour = $interval->format("%h");
            $nbMin = $interval->format("%i");
            $tothour = $tothour + ($nbHour*60) + $nbMin;       
        }
        return date('H:i', mktime(0,$tothour));
    }
}