<?php
    $peticion = file_get_contents("../json/sistemaInformacionPersonal.json");
    $_DATA = json_decode($peticion, true);
   
    $ordenarDatos = function($json){
        $ordenarAlfabeticamente = (array) null;
        $lista = (array) null;
        foreach ($json as $key => $value) {
            $ordenarAlfabeticamente[$value["id"]] = $value["value"];
        }
        asort($ordenarAlfabeticamente);
        foreach ($ordenarAlfabeticamente as $key => $value) {
            array_push($lista, (array)["id"=>$key, "value"=> $value]);
        }
        return $lista;
    };
    foreach ($_DATA as $identificador_del_json => $datos_del_json) {
        if($identificador_del_json == "tipo-de-documento"){
            foreach ($ordenarDatos($datos_del_json) as $key => $value) {
                $value = (object) $value;
                $plantilla->select .= "<option value='$value->id'>$value->value</option>";
            }
        }else if($identificador_del_json == "genero"){
            $plantilla->genero .= "<p>".ucfirst(str_ireplace("-", " ",$identificador_del_json))."</p>";
            foreach ($ordenarDatos($datos_del_json) as $key => $value) {
                $value = (object) $value;
                $plantilla->genero .= "<input type='radio' id='$value->id' name='$identificador_del_json' value='$value->value' required>";
                $plantilla->genero .= "<label for='$value->id'>$value->value</label>";
            }
        }else if($identificador_del_json == "estado-civil"){
            $plantilla->estadoCivil .= "<p>".ucfirst(str_ireplace("-", " ",$identificador_del_json))."</p>";
            foreach ($ordenarDatos($datos_del_json) as $key => $value) {
                $value = (object) $value;
                $plantilla->estadoCivil .= "<input type='radio' id='$value->id' name='$identificador_del_json' value='$value->value' required>";
                $plantilla->estadoCivil .= "<label for='$value->id'>$value->value</label>";
            }
        }
    }
    $obj->InformacionPersonal = $plantilla;


?>