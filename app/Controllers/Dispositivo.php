<?php

namespace App\Controllers;

class Dispositivo extends BaseController
{
    function test()
    {


        $agent = $this->request->getUserAgent();

        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
            //return view('dashboard/browser');
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
            //return view('dashboard/mobile');
        } else {
            $currentAgent = 'Unidentified User Agent';
            //return view('dashboard/browser-tablet');
        }
        
        echo $currentAgent;
        
        //echo $agent->getPlatform();
        
    }
}
