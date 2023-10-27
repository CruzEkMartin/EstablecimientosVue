<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png" />
  <title>Sistema - Lector QR con PHP y MySQL :: URIAN VIERA</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo_camara.css') }} " />

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  <style>
    .navbar {
      height: 55px;
      background-color: #2196F3;
      color: #fff;
      border: none;
    }
  </style>

</head>

<body id="mimin" class="dashboard">
    <nav class="navbar navbar-fixed-top mb-5">
      <h2>Lector de Códigos QR con PHP y MySQL</h2>
    </nav>
  
  
    <div class="container">
      <div class="row justify-content-md-center mb-5">
        <div class="col-md-12 panel">
          <div class="col-md-12 panel-heading bg_lightgrey">
            <h4 class="text-center" style="color:#333;font-weight: bold; ">
              REGISTRO DE VISITANTES&nbsp;
            </h4>
          </div>
        </div>
  
        <div class="col-md-6">
          <!--Iniciando la camara-->
          <div class="contenedor_camara">
            <div class="text-center" id="loadingMessage">
              🎥 No se puede acceder a la transmisión de video (asegúrese de
              tener una cámara web habilitada)
            </div>
            <canvas id="canvas" hidden></canvas>
            <div class="mb-4" id="output" hidden>
              <div id="outputMessage">Aún no se ha detectado código QR</div>
              <div hidden>
                <b>Código:</b> <span id="outputData"></span>
              </div>
            </div>
          </div>
          <!--fin-->
        </div>
  
  
        <div class="col-md-6 mb-5">
          <div id="resultado">
  
          </div>
        </div>
      </div>
  
  
    </div>
    <!--fin del container-->
  

    

  <div style="position: fixed;top: -60px;">
    <audio controls id="sonido_qr" style="width: 0px !important;height: 0px !important;">
      <source src="{{ asset('sonido/beep.mp3') }}" type="audio/mpeg">
    </audio>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{ asset('js/qr/jsQR.js') }}"></script>
  <script src="{{ asset('js/scanear_qr.js') }}"></script>


</body>

</html>
