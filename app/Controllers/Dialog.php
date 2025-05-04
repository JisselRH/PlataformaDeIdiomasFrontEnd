<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

helper('training_session');

class Dialog extends BaseController
{
    public function __construct()
    {
    }

    public function dialogExcercise()
    {
        return view('dialog/excercise');
    }

    public function audioDialog()
    {
        $headers = array(
            'Content-Type: multipart/form-data'
        );

        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL, "https://backend.chacota.cl/login");
        //curl_setopt($ch, CURLOPT_URL, "http://localhost:8081/texttospeech");
        curl_setopt($ch, CURLOPT_URL, "http://172.16.21.112:3000/texttospeech");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('text' => $this->request->getPost('text')));
        $response = curl_exec($ch);

        curl_close($ch);

        list($header, $body) = explode("\r\n\r\n", $response, 2);

        if ($response == null) {
            //$msj = 'En este momento no podemos procesar su solicitud, intente luego!';
            return false;
        } else {

            return json_encode(['success' => 'success', 'csrf' => csrf_hash(), 'response' => true]);
        }

       
    }
}
