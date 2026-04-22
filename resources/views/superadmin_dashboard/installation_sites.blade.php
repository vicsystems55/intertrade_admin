@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="page-title">Installation Sites Map</h1>
                <p class="text-muted">Track and manage solar and cold chain installation locations across Nigeria</p>
            </div>
            <div class="col-md-4 text-end">
                <button id="exportBtn" class="btn btn-success btn-lg me-2">
                    <i class="bx bx-download"></i> Export Map
                </button>
                <button id="fullscreenBtn" class="btn btn-primary btn-lg">
                    <i class="bx bx-fullscreen"></i> Fullscreen
                </button>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="row">
            <!-- Sidebar Controls -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <!-- Statistics -->
                        <h5 class="card-title mb-3">Statistics</h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="card border-left border-success">
                                    <div class="card-body">
                                        <p class="text-muted small mb-1">Total Installations</p>
                                        <h3 class="text-success" id="totalCount">0</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card border-left border-warning">
                                    <div class="card-body">
                                        <p class="text-muted small mb-1">Solar Projects</p>
                                        <h3 class="text-warning" id="solarCount">0</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card border-left border-info">
                                    <div class="card-body">
                                        <p class="text-muted small mb-1">Cold Chain Projects</p>
                                        <h3 class="text-info" id="coldChainCount">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <hr>
                        <h5 class="card-title mb-3">Filter by Type</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="projectFilter" id="filterAll" value="all" checked>
                            <label class="form-check-label" for="filterAll">Show All</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="projectFilter" id="filterSolar" value="solar">
                            <label class="form-check-label" for="filterSolar">
                                <span class="badge bg-success" style="display: inline-block; width: 12px; height: 12px; border-radius: 50%;"></span>
                                Solar Projects
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="projectFilter" id="filterColdChain" value="cold_chain">
                            <label class="form-check-label" for="filterColdChain">
                                <span class="badge bg-info" style="display: inline-block; width: 12px; height: 12px; border-radius: 50%;"></span>
                                Cold Chain Projects
                            </label>
                        </div>

                        <!-- Legend -->
                        <hr>
                        <h5 class="card-title mb-3">Legend</h5>
                        <div class="mb-2">
                            <span class="badge bg-success" style="display: inline-block; width: 12px; height: 12px; border-radius: 50%;"></span>
                            <small>Solar Installation</small>
                        </div>
                        <div>
                            <span class="badge bg-info" style="display: inline-block; width: 12px; height: 12px; border-radius: 50%;"></span>
                            <small>Cold Chain Installation</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map and Upload Section -->
            <div class="col-lg-9">
                <!-- Map Container -->
                <div class="card shadow-lg mb-4" id="mapContainer" style="height: 600px;">
                    <div id="map" style="width: 100%; height: 100%;"></div>
                </div>

                <!-- Upload Section -->
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Update Locations via Excel</h5>
                        <p class="text-muted mb-3">Upload an Excel file with installation data. Required columns: Project Name, Location Name, Latitude, Longitude, Project Type</p>

                        <!-- Upload Area -->
                        <div class="upload-area" id="uploadArea" style="border: 2px dashed #007bff; border-radius: 8px; padding: 40px; text-align: center; cursor: pointer; background-color: #f8f9fa; transition: all 0.3s;">
                            <input type="file" id="excelFile" accept=".xlsx,.xls,.csv" style="display: none;"/>
                            <div>
                                <i class="bx bx-cloud-upload" style="font-size: 48px; color: #007bff;"></i>
                                <p class="mt-3 mb-1"><strong>Click to upload or drag and drop</strong></p>
                                <p class="text-muted small">XLSX, XLS or CSV (max. 10MB)</p>
                            </div>
                        </div>

                        <!-- Upload Progress -->
                        <div id="uploadProgress" class="mt-3" style="display: none;">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-dark"><strong>Uploading...</strong></small>
                                <small class="text-muted" id="uploadPercent">0%</small>
                            </div>
                            <div class="progress">
                                <div id="uploadBar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                            </div>
                        </div>

                        <!-- Upload Status Messages -->
                        <div id="uploadStatus" class="mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Toast -->
<div id="loadingToast" class="toast position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" style="display: none; z-index: 1050;">
    <div class="toast-body bg-dark text-white">
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        <span id="toastText">Loading...</span>
    </div>
</div>

<!-- Success Toast -->
<div id="successToast" class="toast position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" style="display: none; z-index: 1050;">
    <div class="toast-body bg-success text-white">
        <i class="bx bx-check me-2"></i>
        <span id="successText">Success!</span>
    </div>
</div>

<!-- Error Toast -->
<div id="errorToast" class="toast position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" style="display: none; z-index: 1050;">
    <div class="toast-body bg-danger text-white">
        <i class="bx bx-x me-2"></i>
        <span id="errorText">Error!</span>
    </div>
</div>


@endsection
<style>
    #mapContainer {
        border-radius: 8px;
        overflow: hidden;
    }

    /* Leaflet CSS overrides */
    .leaflet-container {
        background-color: #f1f5f9;
    }

    .leaflet-control-attribution {
        background-color: rgba(15, 23, 42, 0.8) !important;
        padding: 8px 10px;
        border-radius: 6px;
        margin: 10px;
        font-size: 11px;
    }

    .leaflet-control-zoom {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .leaflet-control-zoom a {
        background-color: white;
        color: #1e293b;
        font-weight: bold;
        font-size: 18px;
        border-radius: 6px;
    }

    .leaflet-control-zoom a:hover {
        background-color: #f1f5f9;
    }

    /* Upload area styles */
    .upload-area:hover {
        background-color: #e7f1ff;
        border-color: #0056b3;
    }

    .upload-area.dragover {
        background-color: #e7f1ff;
        border-color: #0056b3;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .border-left {
        border-left: 4px solid !important;
    }

    .border-success {
        border-left-color: #28a745 !important;
    }

    .border-warning {
        border-left-color: #ffc107 !important;
    }

    .border-info {
        border-left-color: #17a2b8 !important;
    }
</style>


