@extends('layout.template')


@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
            z-index: 0;
            margin-bottom: 20px;
        }
    </style>
@endsection


@section('content')
    <div id="map"></div>

    <!-- Modal Create Point -->
    <div class="modal fade" id="CreatePointModal" tabindex="-1" aria-labelledby="CreatePointLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="CreatePointLabel">Create Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label fw-semibold">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter point name..." required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-3 col-form-label fw-semibold">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Add description..."></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="geom_point" class="col-sm-3 col-form-label fw-semibold">Geometry (WKT)</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="geom_point" name="geom_point" rows="2" readonly></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image_point" class="col-sm-3 col-form-label fw-semibold">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="image_point" name="image"
                                    onchange="previewImage(event, 'image-point-preview')">
                                <div class="mt-3 text-center">
                                    <img id="image-point-preview" class="img-thumbnail"
                                        style="max-width: 100%; display: none;" alt="Preview">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Create Polyline -->
    <div class="modal fade" id="CreatePolylineModal" tabindex="-1" aria-labelledby="CreatePolylineLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="CreatePolylineLabel">Create Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label fw-semibold">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter polyline name..." required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-3 col-form-label fw-semibold">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Add description..."></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="geom_polyline" class="col-sm-3 col-form-label fw-semibold">Geometry (WKT)</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="2" readonly></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image_polyline" class="col-sm-3 col-form-label fw-semibold">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="image_polyline" name="image"
                                    onchange="previewImage(event, 'image-polyline-preview')">
                                <div class="mt-3 text-center">
                                    <img id="image-polyline-preview" class="img-thumbnail"
                                        style="max-width: 100%; display: none;" alt="Preview">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Create Polygon -->
    <div class="modal fade" id="CreatePolygonModal" tabindex="-1" aria-labelledby="CreatePolygonLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="CreatePolygonLabel">Create Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polygons.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label fw-semibold">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter polygon name..." required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-3 col-form-label fw-semibold">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Add description..."></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="geom_polygon" class="col-sm-3 col-form-label fw-semibold">Geometry (WKT)</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="2" readonly></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image_polygon" class="col-sm-3 col-form-label fw-semibold">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="image_polygon" name="image"
                                    onchange="previewImage(event, 'image-polygon-preview')">
                                <div class="mt-3 text-center">
                                    <img id="image-polygon-preview" class="img-thumbnail"
                                        style="max-width: 100%; display: none;" alt="Preview">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script src="https://unpkg.com/@terraformer/wkt"></script>


    <script>
        var map = L.map('map').setView([-7.766582427240689, 110.37497699483326], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            console.log(drawnJSONObject);
            console.log(objectGeometry);

            if (type === 'polyline') {
                console.log("Create " + type);

                $('#geom_polyline').val(objectGeometry);

                // Modal Bootstrap
                $('#CreatePolylineModal').modal('show');

            } else if (type === 'polygon' || type === 'rectangle') {
                console.log("Create " + type);

                $('#geom_polygon').val(objectGeometry);

                // Modal Bootstrap
                $('#CreatePolygonModal').modal('show');

            } else if (type === 'marker') {
                console.log("Create " + type);

                $('#geom_point').val(objectGeometry);

                // Modal Bootstrap
                $('#CreatePointModal').modal('show');

            } else {
                console.log('__undefined__');
            }

            drawnItems.addLayer(layer);
        });

        // GeoJSON Points
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Nama : " + feature.properties.name + "<br>" +
                    "Deskripsi : " + feature.properties.description + "<br>" +
                    "Koordinat : " + feature.geometry.coordinates + "<br>" +
                    "Dibuat : " + feature.properties.created_at + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.images +
                    "'width='200' alt=''>";
                layer.on({
                    click: function(e) {
                        point.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        point.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        // GeoJSON Polylines
        var polyline = L.geoJson(null, {
            /* Style polyline */
            style: function(feature) {
                return {
                    color: "#3388ff",
                    weight: 3,
                    opacity: 1,
                };
            },
            onEachFeature: function(feature, layer) {
                var popupContent = "Kelas Jalan: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Koordinat: " + feature.geometry.coordinates + "<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +
                    "Panjang: " + feature.properties.length_km.toFixed(5) + " km" + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.images +
                    "'width='200' alt=''>";;
                layer.on({
                    click: function(e) {
                        polyline.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polyline.bindTooltip(feature.properties.name, {
                            sticky: true,
                        });
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });

        // GeoJSON Polygons
        var polygon = L.geoJson(null, {
            /* Style polygon */
            style: function(feature) {
                return {
                    color: "#3388ff",
                    fillColor: "#3388ff",
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.2,
                };
            },
            onEachFeature: function(feature, layer) {
                var popupContent = "Nama : " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Koordinat: " + feature.geometry.coordinates + "<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +
                    "Luas : " + feature.properties.area_hectare.toFixed(3) + " Ha" + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.images +
                    "'width='200' alt=''>";
                layer.on({
                    click: function(e) {
                        polygon.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polygon.bindTooltip(feature.properties.name, {
                            sticky: true,
                        });
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });

        function previewImage(event, id) {
            const img = document.getElementById(id);
            if (event.target.files.length > 0) {
                img.src = URL.createObjectURL(event.target.files[0]);
                img.style.display = "block";
            } else {
                img.style.display = "none";
            }
        }
    </script>
@endsection
