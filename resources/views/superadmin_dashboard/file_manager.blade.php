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


                            @foreach ($breadcrumbs as $breadcrumb)
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                            @endforeach
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
                                        value="{{ $path }}">
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
                                    <form action="/search-directory" method="GET">
                                    <div class="input-group input-group-lg"> <span
                                            class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>



                                                    <input
                                                        type="text"
                                                        name="query"
                                                        class="form-control"
                                                        placeholder="Enter file or folder name"
                                                        required
                                                        value="{{ request('query') }}"
                                                    />

                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                </div>
                            </div>

                            <!--end row-->
                            <h5 class="py-3">Folders</h5>
                            <div style="min-height: 350px;" class="fol">

                                <div class="row mt-3">



                                    @foreach ($folders as $folder)

                                        <div class="col-12 col-lg-4">
                                            <a href="{{ url('/admin/file-manager?path=' . $folder['path']) }}">
                                                <div class="card shadow border radius-15">
                                                    <div class="card-body">
                                                        <a href="{{ url('/admin/file-manager?path=' . $folder['path']) }}">
                                                        <div class="d-flex align-items-center">
                                                            <div class="font-30 text-primary">
                                                                 <i class='bx bxs-folder'></i>

                                                            </div>
                                                            <div class="user-groups ms-auto">
                                                                <img src="/assets/images/avatars/avatar-1.png"
                                                                    width="35" height="35" class="rounded-circle"
                                                                    alt="" />
                                                                <img src="/assets/images/avatars/avatar-2.png"
                                                                    width="35" height="35" class="rounded-circle"
                                                                    alt="" />
                                                            </div>
                                                            <div class="user-plus">+</div>
                                                        </div>

                                                    </a>
                                                        {{-- <h6 class="mb-0 text-primary">{{ basename($folder) }}</h6> --}}
                                                        <div class="folder-edit">
                                                            <!-- Input for the new folder name -->
                                                            <input type="text" class="form-control folder-name-input d-none" value="{{ basename($folder['name']) }}" />

                                                            <!-- Input for the current folder path -->
                                                            <input type="hidden" class="form-control folder-old-name-input" value="{{ $folder['path'] }}" />

                                                            <!-- Display folder name -->
                                                            <h6 class="mb-0 text-primary folder-name-text">{{ basename($folder['path']) }}</h6>

                                                            <!-- Save button -->
                                                            <button class="btn btn-sm btn-primary save-folder-name d-none">Save</button>
                                                        </div>

                                                        <small>{{\App\Helpers\Helpers::formatSizeUnits($folder['size'])}}</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                    @endforeach

                                    @foreach ($files as $file)
                                        <div class="col-12 col-lg-4">
                                            <a href="{{ url('/admin/file-manager?path=' . $file['name']) }}">

                                                <div class="card shadow-none border radius-15">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div class="font-30 text-danger"><i class='bx bxs-file'></i>
                                                            </div>
                                                            <div class="user-groups ms-auto d-none">
                                                                <img src="assets/images/avatars/avatar-1.png"
                                                                    width="35" height="35" class="rounded-circle"
                                                                    alt="" />
                                                                <img src="assets/images/avatars/avatar-2.png"
                                                                    width="35" height="35" class="rounded-circle"
                                                                    alt="" />
                                                            </div>

                                                        </div>
                                                        <h6 class="mb-0 text-primary">{{ basename($file['name']) }}</h6>
                                                        <small>{{\App\Helpers\Helpers::formatSizeUnits($file['size'])}}</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach



                                </div>



                            </div>
                                    <!-- Upload File -->
                                    <div style="width: 330px" class="file mx-auto">

                                        <form action="{{ url('/file-manager/upload-file') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file" class="form-control mb-2" required>
                                            <input type="hidden" name="path" value="{{ $path }}">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary">Upload File</button>
                                            </div>
                                        </form>

                                    </div>
                            <!--end row-->
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Recent Files</h5>
                                </div>
                                <div class="ms-auto"><a href="javascript:;" class="btn btn-sm btn-outline-secondary">View
                                        all</a>
                                </div>
                            </div>
                            <div style="height: 200px;" class="table-responsive mt-3">
                                <table class="table table-striped table-hover table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name <i class='bx bx-up-arrow-alt ms-2'></i>
                                            </th>
                                            <th>Members</th>
                                            <th>Last Modified</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($files as $file)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div><i class='bx bxs-file-pdf me-2 font-24 text-danger'></i>
                                                        </div>
                                                        <div class="font-weight-bold text-danger">{{ basename($file['name']) }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Only you</td>
                                                <td>Sep 3, 2019</td>
                                                <td><i class='bx bx-dots-horizontal-rounded font-24'></i>
                                                </td>
                                            </tr>
                                        @endforeach




                                    </tbody>
                                </table>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->


    {{-- <div class="d-none">
        <h2>File Manager</h2>

        <!-- Breadcrumbs -->
        <nav>
            @foreach ($breadcrumbs as $breadcrumb)
                <a href="{{ url('/admin/file-manager?path=' . $breadcrumb['path']) }}">{{ $breadcrumb['name'] }}</a> /
            @endforeach
        </nav>

        <!-- Folders -->
        <h3>Folders</h3>
        <ul>
            @foreach ($folders as $folder)
                <li><a href="{{ url('/admin/file-manager?path=' . $folder) }}">{{ basename($folder) }}</a></li>
            @endforeach
        </ul>

        <!-- Files -->
        <h3>Files</h3>
        <ul>
            @foreach ($files as $file)
                <li>{{ basename($file) }}</li>
            @endforeach
        </ul>

        <!-- Create Folder -->


        <!-- Upload File -->
        <form action="{{ url('/file-manager/upload-file') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required>
            <input type="hidden" name="path" value="{{ $path }}">
            <button type="submit">Upload File</button>
        </form>
    </div> --}}

    {{-- <file-manager-component
idkey={{$idKey}}
foldername={{$folderName}}

></file-manager-component> --}}



<script>
document.addEventListener("DOMContentLoaded", function () {
    const folderCards = document.querySelectorAll(".folder-edit");

    folderCards.forEach((folderCard) => {
        const folderNameText = folderCard.querySelector(".folder-name-text");
        const folderNameInput = folderCard.querySelector(".folder-name-input");
        const folderOldNameInput = folderCard.querySelector(".folder-old-name-input");
        const saveButton = folderCard.querySelector(".save-folder-name");

        // Make the folder name editable
        folderNameText.addEventListener("click", () => {
            folderNameText.classList.add("d-none");
            folderNameInput.classList.remove("d-none");
            saveButton.classList.remove("d-none");
        });

        // Handle the save button click
        saveButton.addEventListener("click", () => {
            const newName = folderNameInput.value.trim();
            const oldPath = folderOldNameInput.value.trim();

            if (newName && newName !== folderNameText.textContent) {
                // Send an AJAX request to rename the folder
                fetch('/api/save-folder-name', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',

                    },
                    body: JSON.stringify({
                        oldPath: oldPath,
                        newName: newName,
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            folderNameText.textContent = newName;
                            folderNameText.classList.remove("d-none");
                            folderNameInput.classList.add("d-none");
                            saveButton.classList.add("d-none");
                        } else {
                            alert(data.error || "An error occurred while renaming the folder.");
                        }
                    })
                    .catch((error) => {
                        alert("An error occurred: " + error);
                    });
            }
        });
    });
});

</script>

@endsection
