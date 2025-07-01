<?php

namespace Processton\Client\Controllers;

class AppsIndexController extends Controller
{

    public function index()
    {

        $panels = filament()->getPanels();

        return view('client::apps',[
            'panels' => $panels
        ]);
    }

}
