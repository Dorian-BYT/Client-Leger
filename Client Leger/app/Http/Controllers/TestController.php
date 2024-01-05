<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    // vérifie si la personne est bien connecté

    public function __construct()
    {
        $this->middleware('auth')->except('bar'); //pas besoin d'etre connecté pour voir la vue bar
    }

    public function foo()
    {
        return view('test.foo');
    }

    public function bar()
    {
        return view('test.bar');
    }
}
