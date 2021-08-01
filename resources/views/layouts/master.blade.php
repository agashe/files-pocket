<!DOCTYPE html>
<html lang="en">
<head>
    <title>FilesPocket</title>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- [Favicon] -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <!-- [Favicon] -->

    <!-- [CSS] -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- [CSS] -->
</head>
<body>
    <header class="mb-3 p-3 pb-5 border-bottom">
        <div class="row">
            <div class="col-md-2">
                <h4 class="logo logo-small"><span>Files</span>Pocket</h4>
            </div>
            <div class="col-md-7">
                <form action="{{ route('search') }}" method="GET" id="search-form">
                    <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Type something for search ..." value="{{ isset($keyword)? $keyword : '' }}">
                </form>
            </div>
            <div class="col-md-1">
                <button class="btn btn-info text-light w-100" title="Search"
                onclick="if ($('#keyword').val() != '') $('#search-form').submit();">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <div class="col-md-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle w-100" title="User"
                    type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i>
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li>
                            <a class="dropdown-item" role="button">
                                <i class="fa fa-book"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" role="button">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-none logout">@csrf</form>
                            <a class="dropdown-item" role="button" onclick="$('.logout').submit();">
                                <i class="fa fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-1">
                <a href="{{ route('home', optional(optional($currentFolder)->parent)->id) }}" 
                    class="btn btn-danger text-light w-100" id="back" title="Back">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
            <div class="col-md-1">
                <a href="{{ route('home') }}" class="btn btn-primary text-light w-100" title="Home">
                    <i class="fa fa-home"></i>
                </a>
            </div>
            <div class="col-md-6">
                <input type="text" name="current_path" class="form-control" value="{{ $path }}" title="Current Path" readonly>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary text-light w-100" title="Create Folder"
                data-bs-toggle="modal" data-bs-target="#create-folder">
                    <i class="fa fa-folder-plus"></i> Create Folder
                </button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary text-light w-100" title="Upload File"
                data-bs-toggle="modal" data-bs-target="#upload-file">
                    <i class="fa fa-file-upload"></i> Upload File
                </button>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    

    <!-- [Modals] -->
    <div class="modal fade" id="upload-file" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-file-upload"></i> Upload File
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('files.store') }}" method="POST" id="upload" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="folder_id" value="{{ $id }}">
                        <input type="file" name="file" class="form-control" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="$('#upload').submit();">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="create-folder" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-folder-plus"></i> Create New Folder
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('folders.store') }}" method="POST" id="create">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $id }}">
                        <input type="text" name="name" class="form-control" placeholder="Enter folder name" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="$('#create').submit();">Create</button>
                </div>
            </div>
        </div>
    </div>
    <!-- [Modals] -->
    
    <!-- [JS] -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @if(session()->has('success'))
        <script>
            toastr.success('{{ session("success") }}');
        </script>
    @endif
    <!-- [JS] -->
</body>
</html>
