<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return view('documents.index');
    }

    public function show($id)
    {
        // Visa ett specifikt dokument
    }
}
