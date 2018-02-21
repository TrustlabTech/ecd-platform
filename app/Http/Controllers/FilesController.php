<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Interfaces\CentreRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;

use Auth;

class FilesController extends Controller
{

    public function __construct(CentreRepositoryInterface $centreRepository)
    {
        $this->centre = $centreRepository;
        $this->middleware('auth');

        $this->EISendpoint = env('API_V2_CREATE_DID_ENDPOINT', 'http://api.amply.tech/eis');
    }

    public function index()
    {
        return view('files.list', ['centres' => $this->centre->paginate(100), 'search' => false]);
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
        if (strpos($filename, 'pdf') !== false) {
            $path = storage_path("docs/pdfs/".$filename);    
            $headers = array(
                  'Content-Type: application/pdf',
                );
    
            return response()->download($path, $filename, $headers);
        } else {
            $path = storage_path("docs/spreadsheets/".$filename);    
            $headers = array(
                  'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                );
    
            return response()->download($path, $filename, $headers);
        }
    }

}
