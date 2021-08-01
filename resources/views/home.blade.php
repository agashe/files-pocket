@extends('layouts.master')

@section('content')
<div class="row mx-0">
    @if (count($folders) || count($files))
        @foreach ($folders as $folder)
            <div class="col-md-2 mt-2">
                <div class="card w-100 folder-card">
                    <div class="card-body text-center" onclick="$(this).find('#link')[0].click();">
                        <a href="{{ route('home', ['id' => $folder->id]) }}" class="d-none" id="link"></a>
                        <p class="h1 brand-color fa fa-folder"></p>

                        <p>
                            {{ $folder->name }}
                            <small class="d-block">{{ $folder->items_count . ' items' }}</small>
                        </p>

                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('folders.destroy', $folder->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-danger w-100" title="Delete" onclick="
                                    return confirm('Are you sure?') ? $(this).closest('div').find('form').submit() : false;
                                ">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($files as $file)
            <div class="col-md-2 mt-2">
                <div class="card w-100 file-card">
                    <div class="card-body text-center">
                        <p class="h1 brand-color fa fa-file"></p>

                        <p>
                            {{ $file->name }}
                            <small class="d-block">{{ $file->size }}</small>
                        </p>

                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ asset($file->path) }}" class="btn btn-primary w-100" title="Download" download="">
                                    <i class="fa fa-download"></i>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-danger w-100" title="Delete" onclick="
                                    return confirm('Are you sure?') ? $(this).closest('div').find('form').submit() : false;
                                ">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-info">
            Sorry no files!
        </p>
    @endif
</div>
@endsection
