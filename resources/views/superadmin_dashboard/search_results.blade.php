@extends('layouts.app')
@section('content')
    <!--start page wrapper -->
    <div class="page-content">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Applications</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/admin/file-manager"><i class="bx bx-home-alt"></i></a>
                            </li>



                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-grid">
                                <form action="{{ url('/file-manager/create-folder') }}" method="POST">
                                    @csrf
                                    <input class="form-control mb-2" type="text" name="name" placeholder="Folder Name"
                                        required>
                                    <input class="form-control mb-2" type="hidden" name="path"
                                        value="">
                                    <button type="submit" class="btn btn-primary">+ Create Folder</button>
                                </form>
                            </div>
                            <h5 class="my-3">My Drive</h5>
                            <div class="fm-menu">
                                <div class="list-group list-group-flush"> <a href="javascript:;"
                                        class="list-group-item py-1"><i class='bx bx-folder me-2'></i><span>All
                                            Files</span></a>
                                    <a href="javascript:;" class="list-group-item py-1"><i
                                            class='bx bx-devices me-2'></i><span>My Devices</span></a>
                                    <a href="javascript:;" class="list-group-item py-1"><i
                                            class='bx bx-analyse me-2'></i><span>Recents</span></a>
                                    <a href="javascript:;" class="list-group-item py-1"><i
                                            class='bx bx-plug me-2'></i><span>Important</span></a>
                                    <a href="javascript:;" class="list-group-item py-1"><i
                                            class='bx bx-trash-alt me-2'></i><span>Deleted Files</span></a>
                                    <a href="javascript:;" class="list-group-item py-1"><i class='bx bx-file me-2'></i>
                                        <span>Documents</span></a>
                                    <a href="javascript:;" class="list-group-item py-1"><i
                                            class='bx bx-image me-2'></i><span>Images</span></a>
                                    <a href="javascript:;" class="list-group-item py-1"><i
                                            class='bx bx-video me-2'></i><span>Videos</span></a>
                                    <a href="javascript:;" class="list-group-item py-1"><i
                                            class='bx bx-music me-2'></i><span>Audio</span></a>
                                    <a href="javascript:;" class="list-group-item py-1"><i
                                            class='bx bx-beer me-2'></i><span>Zip Files</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-0 text-primary font-weight-bold">45.5 GB <span class="float-end text-secondary">50
                                    GB</span></h5>
                            <p class="mb-0 mt-2"><span class="text-secondary">Used</span><span
                                    class="float-end text-primary">Upgrade</span>
                            </p>
                            <div class="progress mt-3" style="height:7px;">
                                <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="mt-3"></div>
                            <div class="d-flex align-items-center">
                                <div class="fm-file-box bg-light-primary text-primary"><i class='bx bx-image'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">Images</h6>
                                    <p class="mb-0 text-secondary">1,756 files</p>
                                </div>
                                <h6 class="text-primary mb-0">15.3 GB</h6>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div class="fm-file-box bg-light-success text-success"><i class='bx bxs-file-doc'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">Documents</h6>
                                    <p class="mb-0 text-secondary">123 files</p>
                                </div>
                                <h6 class="text-primary mb-0">256 MB</h6>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div class="fm-file-box bg-light-danger text-danger"><i class='bx bx-video'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">Media Files</h6>
                                    <p class="mb-0 text-secondary">24 files</p>
                                </div>
                                <h6 class="text-primary mb-0">3.4 GB</h6>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div class="fm-file-box bg-light-warning text-warning"><i class='bx bx-image'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">Other Files</h6>
                                    <p class="mb-0 text-secondary">458 files</p>
                                </div>
                                <h6 class="text-primary mb-0">3 GB</h6>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div class="fm-file-box bg-light-info text-info"><i class='bx bx-image'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0">Unknown Files</h6>
                                    <p class="mb-0 text-secondary">57 files</p>
                                </div>
                                <h6 class="text-primary mb-0">178 GB</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div style="min-height: 800px;" class="card">
                        <div class="card-body">
                            <div class="fm-search">
                                <div class="mb-0">
                                    <div class="input-group input-group-lg"> <span
                                            class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
                                        <input type="text" class="form-control" placeholder="Search the files">
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <h2>Search Results for "{{ $searchTerm }}"</h2>

                                @if(empty($files) && empty($directories))
                                    <p>No files or folders matched your query.</p>
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($directories as $directory)
                                                <tr>
                                                    <td>
                                                        <div class="font-30 text-primary">
                                                            <i class='bx bxs-folder'></i>

                                                       </div>
                                                    </td>
                                                    <td>{{ $directory }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach($files as $file)
                                                <tr>
                                                    <td>
                                                        <div class="font-30 text-primary">
                                                            <i class='bx bxs-file'></i>

                                                       </div>
                                                    </td>
                                                    <td>{{ $file }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                <a href="{{ url('/admin/file-manager') }}" class="btn btn-secondary">Back to Search</a>
                            </div>






                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>



@endsection
