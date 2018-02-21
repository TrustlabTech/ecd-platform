@extends('layouts.admin')

@section('title', 'Files')

@section('content')
        <div class="spacer-50"></div>
            <h2 class="center-text">Files</h2>
        <div class="spacer-20"></div>
        <div class="row">
            <!-- form open -->
                <div class="col-md-12" id="search">
                    <div class="col-md-6 no-padding-left">
                    {!! Form::text('Searchbox',null,['placeholder' => 'Search for files']); !!}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-12 no-padding-right">
                                <div class="col-md-6 no-padding-right">
                                        {!! Form::select('Quarter', array('Q1' => 'Q1', 'Q2' => 'Q2','Q3' => 'Q3','Q4' => 'Q4')) !!}
                                </div>
                                <div class="col-md-6 no-padding-right">
                                        {!! Form::selectRange('Year', 2016, 2018) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- form close -->
        </div>
        <div class="clearfix"></div>
        <div class="table-bg" id="fileList">
            <table class="table table-bordered">
                <thead>
                    <th>Centre Name</th>
                    <th>Downloads</th>
                </thead>
                <tbody>
                    <?php
                    
                        // echo Form::open(array('action' => 'FilesController@getDownload'));

                        $xlsPath = storage_path("docs/spreadsheets/");
                        $pdfPath = storage_path("docs/pdfs/");

                        $xlsArray = [];
                        $pdfArray = [];

                        foreach (glob($xlsPath."*.xlsx") as $filepath) {
                            $xlsArray[] = substr($filepath, strrpos($filepath, '/') + 1);;
                        }

                        foreach (glob($pdfPath."*.pdf") as $filepath) {
                            $pdfArray[] = substr($filepath, strrpos($filepath, '/') + 1);
                        }   
                        
                    ?>
                    <tbody>
                    <?php for($i = 0; $i < count($xlsArray);$i++){ 
                        $filename = substr($xlsArray[$i], 0,strrpos($xlsArray[$i], '.'));
                        $pieces = explode("_", $filename);
                    ?>
                    <tr class="single-file hidden <?php echo $pieces[1]." ".$pieces[2];?>">
                        <td><?php   echo "<p>".$filename."</p>"; ?></td>
                        <td><?php   if(isset($xlsArray[$i])){ echo "<a href='/getDownload/".$xlsArray[$i]."' target='_blank'><img src='";?>{{ asset('img/xls.png') }}<?php echo "'/></a>\r\n";}
                                    if(isset($pdfArray[$i])){ echo "<a href='/getDownload/".$pdfArray[$i]."' target='_blank'><img src='";?>{{ asset('img/pdf.png') }}<?php echo "'/></a>\r\n";}
                         ?></td>
                    </tr> 
                    <?php } ?>
                </tbody>
                </tbody>
            </table>
        </div>
@endsection

@section('scripts')
    <script src="{{ elixir('js/files.js') }}"></script>
@endsection