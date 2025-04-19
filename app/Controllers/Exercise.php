<?php

namespace App\Controllers;

class Exercise extends BaseController
{
    public function select()
    {
        //return view('exercise/select.html');
        $data['help'] = lang('Help.select');


        return view('exercise/select', $data);
        //return view('exercise/select.html', $data);
    }

    public function create()
    {
        $data['help'] = lang('Help.context');
        return view('exercise/create/context', $data);
    }

    public function words()
    {
        $data['help'] = lang('Help.wordslist');
        return view('exercise/create/words', $data);
    }

    public function character()
    {
        $data['help'] = lang('Help.character');
        return view('exercise/create/character', $data);
    }

    public function saveImage()
    {
        $url = $_POST["url"];
        $character = $_POST["name"];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);

        curl_close($ch);
        $url_insert = getcwd() . "/filesimages"; //Carpeta donde subiremos nuestros archivos

        //print_r($url_insert . "\n\n\n");
        $characterclean = trim($character);

        //Ruta donde se guardara el archivo, usamos str_replace para reemplazar los "\" por "/"
        $url_target = str_replace('\\', '/', $url_insert) . '/'.$characterclean.'.png';


        //Si la carpeta no existe, la creamos
        if (!file_exists($url_insert)) {
            mkdir($url_insert, 0777, true);
        };


        if ($response == null) {
            return false;
        }


        list($header, $body) = explode("\r\n\r\n", $response, 2);

        $result2 = explode(" ", $header, 60);

        $miarchivo = fopen($url_target, "w+");
        
        //verificar si existe archivo
        fputs($miarchivo, $body);

        fclose($miarchivo);

        if ($result2[1] == "404") {
            //Data inválida
        } else {

            if ($result2[1] == "200" || $result2[1] == "201") {
                return json_encode(['data' => $url_target]);
                //return true;
            } else {
                //Error;
            }
        }
        return false;
    }

    public function menu()
    {
        $data['help'] = lang('Help.menu');
        return view('exercise/menu', $data);
    }

    public function practiceWords()
    {
        $data['help'] = lang('Help.words');
        return view('exercise/practice/words', $data);
    }

    public function practicePhrases()
    {
        $data['help'] = lang('Help.phrases');
        return view('exercise/practice/phrases', $data);
    }

    public function practiceDialogIntro()
    {
        $data['help'] = lang('Help.character');
        return view('exercise/practice/dialogintro', $data);
    }

    public function practiceDialog()
    {
        $data['help'] = lang('Help.dialog');
        return view('exercise/practice/dialog', $data);
    }

    public function practiceDialogResults()
    {
        $data['help'] = lang('Help.results');
        return view('exercise/practice/dialogResults', $data);
    }
}
