<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('produtos')->get();

        return view('menu', compact('categorias'));
    }

}