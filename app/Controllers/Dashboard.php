<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public function dashboard()
    {

        $headers = array(
            'Content-Type: application/x-www-form-urlencoded'
        );

        $urlParameters  = "id=" . session('id');

        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL, "https://backend.chacota.cl/estadisticas");
        curl_setopt($ch, CURLOPT_URL, "https://172.16.21.112:3000/estadisticas/estadisticas");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlParameters);
        $response = curl_exec($ch);

        curl_close($ch);

        if ($response == null) {
            return false;
        }

        list($header, $body) = explode("\r\n\r\n", $response, 2);
        $result = json_decode($body, true);
        $result2 = explode(" ", $header, 60);

        if ($result2[1] == "404") {
            return false;
        } else {

            if ($result2[1] == "200") {

                $mesP = [];
                $mesD = [];

                $avanceP = [0];
                $avanceD = [0];

                $dias = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

                $FechaActual = date("Y-m-d");

                $diaSemana = $dias[date('N', strtotime(date("Y-m-d"))) - 1];

                switch ($diaSemana) {

                    case "Monday":
                        $monday = date("Y-m-d", strtotime($FechaActual . "- 0 days"));
                        break;
                    case "Tuesday":
                        $monday = date("Y-m-d", strtotime($FechaActual . "- 1 days"));
                        break;
                    case "Wednesday":
                        $monday = date("Y-m-d", strtotime($FechaActual . "- 2 days"));
                        break;
                    case "Thursday":
                        $monday = date("Y-m-d", strtotime($FechaActual . "- 3 days"));
                        break;
                    case "Friday":
                        $monday = date("Y-m-d", strtotime($FechaActual . "- 4 days"));
                        break;
                    case "Saturday":
                        $monday = date("Y-m-d", strtotime($FechaActual . "- 5 days"));
                        break;
                    case "Sunday":
                        $monday = date("Y-m-d", strtotime($FechaActual . "- 6 days"));
                        break;
                }

                $mondayAux = $monday;

                $monday = "'" . $monday . "'";

                if (isset($result['avance'])) {
                    for ($i = 0; $i < sizeof($result['avance']); $i++) {
                        if ($result['avance'][$i]['tipo_entrenamiento']['tipo'] == "Pronunciación")
                            $avanceP = $result['avance'][$i]['porcentaje'];
                        else
                            $avanceD = $result['avance'][$i]['porcentaje'];
                    }
                }

                if (isset($result['experiencia'])) {
                   
                    for ($i = 0; $i < sizeof($result['experiencia']); $i++) {
                        if ($result['experiencia'][$i]['tipo_entrenamiento']['tipo'] == "Pronunciación")
                            array_push($mesP, $result['experiencia'][$i]);
                        else
                            array_push($mesD, $result['experiencia'][$i]);
                    }
                }

                $month = date("m");
                $year = date("Y");
                $days = date('t');

                /* INICIO SEMANA ACTUAL */

                $semanaPronunciacion = [0, 0, 0, 0, 0, 0, 0];
                $semanaDialogo = [0, 0, 0, 0, 0, 0, 0];

                $fechaComoEntero = strtotime($mondayAux);

                $daymonday  = date("d", $fechaComoEntero);

                $daymonday = intval($daymonday);

                for ($i = $daymonday; $i <= $daymonday + 6; $i++) { //depende de la semana actual

                    if ($i < 9)
                        $fecha = $year . "-" . $month . "-0" . ($i);
                    else
                        $fecha = $year . "-" . $month . "-" . ($i);

                    if (isset($mesP[0])) {

                        for ($j = 0; $j < sizeof($mesP); $j++) {
                            if (isset($mesP[$j])) {

                                $matriz = explode("T", $mesP[$j]['fecha']);

                                if (strtotime($matriz[0]) == strtotime($fecha)) {

                                    $diaSemana = $dias[date('N', strtotime($fecha)) - 1];

                                    $experiencia = intval($mesP[$j]['experiencia']);

                                    switch ($diaSemana) {
                                        case "Monday":
                                            $semanaPronunciacion[0] =  $experiencia;
                                            break;
                                        case "Tuesday":
                                            $semanaPronunciacion[1] =  $experiencia;
                                            break;
                                        case "Wednesday":
                                            $semanaPronunciacion[2] =  $experiencia;
                                            break;
                                        case "Thursday":
                                            $semanaPronunciacion[3] =  $experiencia;
                                            break;
                                        case "Friday":
                                            $semanaPronunciacion[4] =  $experiencia;
                                            break;
                                        case "Saturday":
                                            $semanaPronunciacion[5] =  $experiencia;
                                            break;
                                        case "Sunday":
                                            $semanaPronunciacion[6] =  $experiencia;
                                            break;
                                    }
                                }
                            }
                        }
                    }

                   // if (isset($mesD.length)) {
                    
                    if (isset($mesD[0])) {
                        for ($j = 0; $j < sizeof($mesD); $j++) {

                            if (isset($mesD[$j])) {

                                $matrizD = explode("T", $mesD[$j]['fecha']);
                                if (strtotime($matrizD[0]) == strtotime($fecha)) {

                                    $diaSemana = $dias[date('N', strtotime($fecha)) - 1];

                                    $experiencia =  intval($mesD[$j]['acumulada_dia']);

                                    switch ($diaSemana) {
                                        case "Monday":
                                            $semanaDialogo[0] = $experiencia;
                                            break;
                                        case "Tuesday":
                                            $semanaDialogo[1] = $experiencia;
                                            break;
                                        case "Wednesday":
                                            $semanaDialogo[2] = $experiencia;
                                            break;
                                        case "Thursday":
                                            $semanaDialogo[3] = $experiencia;
                                            break;
                                        case "Friday":
                                            $semanaDialogo[4] = $experiencia;
                                            break;
                                        case "Saturday":
                                            $semanaDialogo[5] = $experiencia;
                                            break;
                                        case "Sunday":
                                            $semanaDialogo[6] = $experiencia;
                                            break;
                                    }
                                }
                            }
                        }
                    }
                }

                /* FIN SEMANA ACTUAL */

                $semanasP = [];
                $semanasD = [];
                $contSemanaActual = 0;
                $contP = 0;
                $contD = 0;
                $contSemanaActual = 0;
                $cont = 0;

                for ($j = 0; $j < $days; $j++) {

                    if ($j < 9)
                        $fecha = $year . "-" . $month . "-0" . ($j + 1);
                    else
                        $fecha = $year . "-" . $month . "-" . ($j + 1);

                    $diaSemana = $dias[date('N', strtotime($fecha)) - 1];

                    if ($diaSemana == "Monday") {

                        if ($cont == 0) {
                            $cont++;
                        } else {
                            $contSemanaActual++;
                            $contP = 0;
                            $contD = 0;
                        }
                    }

                    for ($k = 0; $k < sizeof($mesP); $k++) {
                        if (isset($mesP[$k])) {

                            $matriz = explode("T", $mesP[$k]['fecha']);
                            if (strtotime($matriz[0]) == strtotime($fecha)) {
                                $contP = $contP + $mesP[$k]['acumulada_dia'];
                            }
                        }
                    }

                    for ($k = 0; $k < sizeof($mesD); $k++) {
                        if (isset($mesD[$k])) {
                            $matrizD = explode("T", $mesD[$k]['fecha']);
                            if (strtotime($matrizD[0]) == strtotime($fecha))
                                $contD = $contD + $mesD[$k]['acumulada_dia'];
                        }
                    }

                    $semanasP[$contSemanaActual] = $contP;
                    $semanasD[$contSemanaActual] = $contD;
                }

                $estadisticas = [
                    'semanaPronunciacion' => $semanaPronunciacion,
                    'mesPronunciacion' => $semanasP,
                    'avancePronunciacion' => $avanceP,
                    'semanaDialogo' => $semanaDialogo,
                    'mesDialogo' => $semanasD,
                    'avanceDialogo' => $avanceD,
                    'logroDiarioPronunciacion' =>  $semanaPronunciacion[date('N') - 1],
                    'logroDiarioDialogo' => $semanaDialogo[date('N') - 1]
                ];

                $this->data['estadisticas'] = $estadisticas;

                return view('dashboard/dashboard', $this->data);
            } else {
                $msj = 'En este momento no podemos procesar su solicitud, intente luego!';
            }
        }
    }

    //crear o actualizar nota en cualquiera de los dos ejercicios (Diálogo o Pronunciación)
    public function setNote()
    {
        if ($this->request->isAJAX()) {

            $headers = array(
                'Content-Type: application/x-www-form-urlencoded'
            );

            $ch = curl_init();

            $tipoEval = 3;

            // tipo 1 dialogo
            // tipo 2 pronunciacion

            if ($this->request->getPost('tipo')  == 1)
                $tipoEval = 5;

            $urlParameters  = "id=" . session('id') . "&nota=" . $this->request->getPost('nota') . "&tipo=" . $this->request->getPost('tipo') . "&tipo_eval=" . $tipoEval;

            curl_setopt($ch, CURLOPT_URL, "https://172.16.21.112:3000/estadisticas/updateAchievement");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $urlParameters);
            $response = curl_exec($ch);

            curl_close($ch);

            if ($response == null) {
                return false;
            }

            list($header, $body) = explode("\r\n\r\n", $response, 2);

            $result = json_decode($body, true);
            $result2 = explode(" ", $header, 60);

            if ($result2[1] == "404") {
                //Data inválida;
            } else {

                if ($result2[1] == "200" || $result2[1] == "201") {
                    return json_encode(['success' => 'success', 'csrf' => csrf_hash(), 'data' => true]);
                } else {
                    //Error;
                }
            }
            return false;
        }
    }


    //crear o actualizar la experiencia en cualquiera de los dos ejercicios (Diálogo o Pronunciación)
    public function setExperience()
    {
        if ($this->request->isAJAX()) {

            $headers = array(
                'Content-Type: application/x-www-form-urlencoded'
            );

            $ch = curl_init();

            //$id  = "id=".session('id');

            $urlParameters  = "id=" . session('id') . "&experiencia=" . $this->request->getPost('experiencia') . "&tipo=" . $this->request->getPost('tipo');

            curl_setopt($ch, CURLOPT_URL, "https://172.16.21.112:3000/estadisticas/updateExperience");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $urlParameters);
            $response = curl_exec($ch);

            curl_close($ch);

            if ($response == null) {
                return false;
            }

            list($header, $body) = explode("\r\n\r\n", $response, 2);

            $result = json_decode($body, true);
            $result2 = explode(" ", $header, 60);

            if ($result2[1] == "404") {
                //Data inválida
            } else {

                if ($result2[1] == "200" || $result2[1] == "201") {
                    return json_encode(['success' => 'success', 'csrf' => csrf_hash(), 'data' => true]);
                    //return true;
                } else {
                    //Error;
                }
            }
            return false;
        }
    }
}
