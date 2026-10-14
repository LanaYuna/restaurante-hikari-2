<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdmMenuController extends Controller
{
     public function index()
    {
        $categorias = Categoria::with('produtos')->get();

        return view('admin.menu', compact('categorias'));
    }
}
