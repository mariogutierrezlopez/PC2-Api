<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class Controller
{
    public function getJugadores(Request $request){
        return json_encode("HOLA");
    }
}
