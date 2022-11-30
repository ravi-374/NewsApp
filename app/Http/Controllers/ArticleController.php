<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index');
    }
}
