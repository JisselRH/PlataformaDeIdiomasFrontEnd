<?php

namespace App\Controllers;

class User extends BaseController
{

	public function login()
	{
		if ($this->request->isAJAX()) {

			$headers = array(
				'Content-Type: application/x-www-form-urlencoded'
			);

			$ch = curl_init();
			//curl_setopt($ch, CURLOPT_URL, "https://backend.chacota.cl/login");
			//https://idiomas.edutecno.cl/api/user/login

			$urlParameters  = "rut=".$this->request->getPost('rut')."&pass=".$this->request->getPost('pass');

			curl_setopt($ch, CURLOPT_URL, "https://idiomas.edutecno.cl/api/user/login");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $urlParameters);
			$response = curl_exec($ch);

			curl_close($ch);

			if ($response == null) {
				$msj = 'En este momento no podemos procesar su solicitud, intente luego!';
				echo $msj;
				return false;
			}

			list($header, $body) = explode("\r\n\r\n", $response, 2);

			//print($body);

			//print(json_decode($body));
			
			$result = json_decode($body, true);
			$result2 = explode(" ", $header, 60);

			//print($result2);

			$msj = '';
			if ($result2[1] == "404") {
				$msj = 'Rut o clave inválidos.';
			} else {
				
				if ($result2[1] == "200") {

					$usuario = array(
						'id' => $result[0]['id'],
						'rut' => $result[0]['rut'],
						'nombre' => $result[0]['nombre'],
						'apellido' => $result[0]['apellido'],
						'tipo' => $result[0]['tipo']
					);

					$this->setUserSession($usuario);

					return json_encode(['success' => 'success', 'csrf' => csrf_hash(), 'respuesta' => $usuario]);
				}else{
					$msj = 'En este momento no podemos procesar su solicitud, intente luego!';
				}
				
			}
			echo $msj;
			return false;
		}
		
	}


	private function setUserSession($user)
	{

		$session = session();

		session()->set($user);

		return true;
	}

	public function logout()
	{
		session()->destroy();
		return view('welcome.html');
	}

}