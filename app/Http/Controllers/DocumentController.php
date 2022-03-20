<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Storage;
use File;

class DocumentController extends Controller
{
    public function create_document(){
        
        Storage::cloud()->put('test.txt', 'Storage 1');
        dd('created');
    }
}
