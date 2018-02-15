@extends('layouts.admin')

@section('title', 'Files')

@section('content')
        <div class="spacer-50"></div>
            <h2 class="center-text">Files</h2>
        <div class="spacer-20"></div>
        <div class="row">
            <!-- form open -->
                <div class="col-md-12">
                    <div class="col-md-7">
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                        {!! Form::select('Quarter', array('Q1' => 'Q1', 'Q2' => 'Q2','Q3' => 'Q3','Q4' => 'Q4'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-md-4">
                                        {!! Form::selectRange('number', 2000, 2018, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- form close -->
        </div>
        <div class="clearfix"></div>
        <div class="table-bg">
            <table class="table table-bordered">
                <thead>
                    <th>Centre ID</th>
                    <th>Name</th>
                    <th>Sector</th>
                    <th>Street Address</th>
                    <th>Mobile Number</th>
                    <th>#</th>
                </thead>
                <tbody>
                    <td>                   
                    <?php
                    
                        // echo Form::open(array('action' => 'FilesController@getDownload'));

                        $path = storage_path("docs/");
    
                        $fileArray = [];
                        foreach (glob($path."*.xlsx") as $filepath) {
                            $fileArray[] = substr($filepath, strrpos($filepath, '/') + 1);;

                        //     // if (file_exists($filepath)) {
                        //     //     header('Content-Description: File Transfer');
                        //     //     header('Content-Type: application/octet-stream');
                        //     //     header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
                        //     //     header('Expires: 0');
                        //     //     header('Cache-Control: must-revalidate');
                        //     //     header('Pragma: public');
                        //     //     header('Content-Length: ' . filesize($filepath));
                        //     //     readfile($filepath);
                        //     //     exit;
                        //     // }
                        }

                        for($i = 0; $i < count($fileArray);$i++){
                            echo "<a href='/getDownload/".$fileArray[$i]."' target='_blank'>File</a>\r\n";
                        }
                        
                    ?>
                    </td>
                </tbody>
            </table>
        </div>
@endsection
