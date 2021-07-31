@extends('layouts.master')

@section('content')
<div class="container mx-1">
    <div class="row">
        <div class="col-md-2">
            <div class="card w-100 folder-card">
                <div class="card-body text-center">
                    <p class="h1 brand-color fa fa-folder"></p>

                    <p>
                        Folder name
                        <small class="d-block">1KB</small>
                    </p>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="" class="btn btn-danger w-100" title="Delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card w-100 file-card">
                <div class="card-body text-center">
                    <p class="h1 brand-color fa fa-file"></p>

                    <p>
                        File name
                        <small class="d-block">1KB</small>
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="" class="btn btn-primary w-100" title="Download" download="">
                                <i class="fa fa-download"></i>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="" class="btn btn-danger w-100" title="Delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
