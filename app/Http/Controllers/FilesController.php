<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;

use Auth;

class FilesController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return view('files.list');
    }

    public function search(Request $request)
    {
        $phrase = trim($request->get('p'));
        if ($phrase === "") {
            return redirect()->route('files.index');
        }
        $files = $this->file->search($phrase);

        return view('files.list', ['centres' => $files, 'search' => true, 'phrase' => $phrase]);
    }

    public function getDownload($filename)
    {
        $path = storage_path("docs/Jono's ECD Centre Q42016.xlsx");    
        $headers = array(
                  'Content-Type: application/pdf',
                );
    
        return response()->download($path, $filename.'.xlsx', $headers);
    }

}
