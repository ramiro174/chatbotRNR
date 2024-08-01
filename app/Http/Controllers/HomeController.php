<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->query("chat")) {
            return view('welcome');
        }
        return view('index', [
            'welcome' => 'Hola Soy Yolo, tu acompañante virtual, gracias por escribir, puedes escribir \"hola\" para comenzar',
        ]);
    }
}
