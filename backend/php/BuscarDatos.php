<?php
    $peticion = file_get_contents("php://input");
    $_DATA = json_decode($peticion, true);
    $nombreFile = (string) "../json/".$_SERVER['HTTP_FILE'];
    if(file_exists($nombreFile)){
        $json = json_decode(file_get_contents($nombreFile), true);
        $bandera = (boolean) true;
        $head = (string) null;
        $body = (string) null;
        foreach ($json as $data) {
            foreach ($data as $N => $value) {
                if($bandera){
                    $head .= "<tr>";
                }
                $body .= "<tr>";
                foreach ($value as $id => $val) {
                    if($bandera){/// id del json
                        $head .= "<th>".ucfirst(str_ireplace("-", " ",$id))."</th>";
                    }
                    $body .= "<td>$val</td>";
                }
                if($bandera){
                    $head .= "</tr>";
                    $bandera = !$bandera;
                }
                $body .= "</tr>";
            }
        }
        $obj = (object) [
            "body" => $body,
            "head" => $head
        ];
        echo json_encode($obj, JSON_PRETTY_PRINT);
    }
?>