@extends('layouts.app')

@section('styles')
    <!-- Load Leaflet from CDN-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Esri Leaflet Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css" />

    <!-- Dropzone --> 
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">
            Registrar Establecimiento
        </h1>

        <div class="row mt-5 justify-content-center">
            <form action="{{ route('establecimiento.store') }}" method="POST" class="col-md-9 col-xs-12 card card-body" enctype="multipart/form-data">
                @csrf
                <fieldset class="border p-4">
                    <legend class="float-none w-auto px-3 text-primary">Nombre, Categoría e Imagen Principal</legend>

                    <div class="form-group">
                        <label for="nombre">Nombre Establecimiento</label>
                        <input type="text" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                            placeholder="Nombre Establecimiento" name="nombre" value="{{ old('nombre') }}">

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="categoria">Categoría</label>
                        <select name="categoria_id" id="categoria"
                            class="form-control @error('categoria') is-invalid @enderror">
                            <option value="" selected disabled>-- Seleccione --</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria->id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('categoria')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-group mt-3">
                        <label for="imagen_principal">Imagen Principal</label>
                        <input type="file" id="imagen_principal"
                            class="form-control @error('imagen_principal') is-invalid @enderror"
                            placeholder="imagen_principal" name="imagen_principal" value="{{ old('imagen_principal') }}">

                        @error('imagen_principal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </fieldset>


                <fieldset class="border p-4 mt-3">
                    <legend class="float-none w-auto px-3 text-primary">Ubicación:</legend>

                    <div class="form-group mt-3">
                        <label for="formbuscador">Coloca la dirección del Establecimiento</label>
                        <input type="text" id="formbuscador" class="form-control"
                            placeholder="Calle del Establecimiento">

                        <p class="text-secondary mt-5 mb-3 text-center">El asistente colocará una dirección estimada o mueve
                            el pin al lugar correcto</p>

                    </div>

                    <div class="form-group mt-3">
                        <div id="mapa" style="height: 400px"></div>
                    </div>

                    <p class="informacion">Confirma que los siguientes campos son correctos</p>

                    <div class="form-group mt-3">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" class="form-control @error('direccion') is-invalid @enderror"
                            placeholder="Dirección" name="direccion" value="{{ old('direccion') }}">

                        @error('direccion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="colonia">Colonia</label>
                        <input type="text" id="colonia" class="form-control @error('colonia') is-invalid @enderror"
                            placeholder="Colonia" name="colonia" value="{{ old('colonia') }}">

                        @error('colonia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input type="hidden" id="lat" name="lat" value="{{ old('lat') }}">
                    <input type="hidden" id="lng" name="lng" value="{{ old('lng') }}">

                </fieldset>

                <fieldset class="border p-4 mt-3">

                    <legend class="float-none w-auto px-3 text-primary">Información Establecimiento:</legend>

                    <div class="form-group mt-3">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                            placeholder="Teléfono Establecimiento" name="telefono" value="{{ old('telefono') }}">

                        @error('telefono')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-group mt-3">
                        <label for="apertura">Hora Apertura:</label>
                        <input type="time" class="form-control @error('apertura') is-invalid @enderror" id="apertura"
                            name="apertura" value="{{ old('apertura') }}">

                        @error('apertura')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="cierre">Hora Cierre:</label>
                        <input type="time" class="form-control @error('cierre') is-invalid @enderror" id="cierre"
                            name="cierre" value="{{ old('cierre') }}">

                        @error('cierre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </fieldset>


                <fieldset class="border p-4 mt-3">
                    <legend class="float-none w-auto px-3 text-primary">Información Establecimiento:</legend>

                    <div class="form-group mt-3">
                        <label for="imagenes">Imagenes</label>

                        <div id="dropzone" class="dropzone form-control"></div>
                    </div>

                </fieldset>



                <input type="hidden" id="uuid" name="uuid" value="{{ Str::uuid()->toString() }}">

                <input type="submit" class="btn btn-primary mt-3 d-block" value="Registrar Establecimiento">

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>

@endsection
