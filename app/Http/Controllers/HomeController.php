<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->query("fullscreen")) {
            return view('index', [
                'welcome' => 'Hola Soy Guetza, tu acompañante virtual, gracias por escribir, puedes escribir \"hola\" para comenzar',
                ]);
        }

        return view('welcome');
    }
}
