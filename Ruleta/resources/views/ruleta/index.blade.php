@extends('layouts.admin')
@section('contenido')
<div class="p-4 code-to-copy" style="display: flex; align-items: center; justify-content: center;">
    <form id="form1" class="row g-3">
        <style>
            #canvasContainer {
                /*background-image: url(img/logo-sofia.jpg);
                  background-repeat: no-repeat;
                  background-position: center center;*/
                height: auto;
                cursor: pointer;
                margin: 0 auto;
                max-width: 100%;
            }

            #imagenCentro {
                position: absolute;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 40%;
                height: auto;
                border-radius: 50%;
            }

            @media (min-width: 992px) {
                #bigButton {
                    max-width: 80%;
                    width: 80%;
                }

                #Ruleta {
                    width: 80vw;
                    max-width: 700px;
                    height: 80vw;
                    max-height: 700px;
                }

                #imagenCentro {
                    top: 49.4%;
                    max-width: 145px;
                    max-height: 145px;
                }
            }

            /* Modo Telefono*/
            @media (max-width: 993px) {
                #bigButton {
                    max-width: 100%;
                    width: 100%;
                }

                #Ruleta {
                    width: 85vw;
                    max-width: 700px;
                    height: 85vw;
                    max-height: 700px;

                }

                #imagenCentro {
                    top: 49%;
                    max-width: 70px;
                    max-height: 70px;
                }
            }

            /*Pantalla Vertical Telefono mas pequeño 320x 380*/
            @media only screen and (min-width: 320px) and (max-width: 380px) {

                /* Aquí se definen los estilos para pantallas entre 768px y 1440px */
                #Ruleta {
                    width: 80vw;
                    max-width: 510px;
                    height: 80vw;
                    max-height: 510px;
                }

                #imagenCentro {
                    top: 48%;
                    max-width: 60px;
                    max-height: 60px;
                }
            }

            /*Pantalla Vertical Telefono mas pequeño 100px 320*/
            @media only screen and (min-width: 100px) and (max-width: 320px) {

                /* Aquí se definen los estilos para pantallas entre 768px y 1440px */
                #Ruleta {
                    width: 80vw;
                    max-width: 510px;
                    height: 80vw;
                    max-height: 510px;
                }

                #imagenCentro {
                    top: 48%;
                    max-width: 50px;
                    max-height: 50px;
                }
            }

            /* Estilos para tablets en modo horizontal */
            @media (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) {

                /* Aquí van los estilos que se aplicarán sólo en tablets en modo horizontal */
                #Ruleta {
                    width: 80vw;
                    max-width: 520px;
                    height: 80vw;
                    max-height: 520px;
                }

                #imagenCentro {
                    top: 49%;
                    max-width: 100px;
                    max-height: 100px;
                }
            }

            /*Pantalla Vertical*/
            @media only screen and (min-width: 768px) and (max-width: 1440px) {

                /* Aquí se definen los estilos para pantallas entre 768px y 1440px */
                #Ruleta {
                    width: 80vw;
                    max-width: 510px;
                    height: 80vw;
                    max-height: 510px;
                }

                #imagenCentro {
                    top: 49.2%;
                    max-width: 110px;
                    max-height: 110px;
                }
            }
        </style>
        <div class="col-md-12">
            <div class="row">
                <!--<div class="col-12 text-center" style="font-size: 13px; margin-top: -20px;">
                        <h1 style="font-size: 20px;">SOFIA TE PREMIA</h1>
                    </div>-->
                <div class="col-12 text-center" style="margin-top: -35px;" onclick="leerElementos()">

                    <div id="canvasContainer" class="mx-auto">
                        <canvas id='Ruleta' width='700%' height='690%'>
                            Canvas not supported, use another browser.
                        </canvas>
                        <img id="imagenCentro" src="img/logo-sofia.jpg" alt="Imagen en el centro de la ruleta">
                    </div>
                </div>
                <div class="col-12 text-center" style="margin-top: -20px;">
                    <div id="canvasContainer2" class="col-12 text-center" style="">
                        <input id="bigButton" style="background-color: #E30613;"
                            class="btn-block btn-lg btn btn-success" onclick="girarRuleta(); this.disabled=true;"
                            value="Girar" type="button" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="js/Winwheel.min.js"></script>
<script src="js/TweenMax.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script>
    var objRuleta;
    var winningSegment;
    var distnaciaX = 150;
    var distnaciaY = 50;
    var ctx;
    /*var imagen = new Image();
     imagen.src = 'img/icono-flecha-ruleta.png';
     imagen.onload = function() {
       ctx.drawImage(imagen, distnaciaX + 166, distnaciaY , 90, 50);
     };*/
    var giros = 0;
    var detenerse = 10;

    function contar() {
        // Iniciar la animación
        objRuleta.startAnimation();
    }

    function Mensaje() {
        winningSegment = objRuleta.getIndicatedSegment();
        //SonidoFinal();
        //alert(winningSegment.text);
        swal({
                title: " ¡    Felidades por tu premio    ! " + winningSegment.text + "",

                imageUrl: "img/logo-sofia.jpg",
                showCancelButton: true,
                confirmButtonColor: "#e74c3c",
                confirmButtonText: "Guardar Premio",
                cancelButtonText: "Reintentar",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location.href = '/cliente_premiado/create';
                } else {
                    alert("¿Estas Seguro de reintentar tu turno?");
                    $('#ListaElementos').val($('#ListaElementos').val().replace(winningSegment.text, ""));
                    leerElementos();

                }
                objRuleta.stopAnimation(false);
                objRuleta.rotationAngle = 0;
                objRuleta.draw();
                DibujarTriangulo();
                bigButton.disabled = false;
            }
        );

    }

    function DibujarTriangulo() {
        distanciaX = 150;
        distanciaY = 10;
        ctx = objRuleta.ctx;

        // Agregar sombra
        ctx.shadowOffsetX = 2;
        ctx.shadowOffsetY = 2;
        ctx.shadowBlur = 2;
        ctx.shadowColor = "rgba(0, 0, 0, 0.5)";

        // Dibujar triángulo
        ctx.fillStyle = '#fedd00'; // amarillo
        ctx.beginPath();
        ctx.moveTo(distanciaX + 170, distanciaY + 5);
        ctx.lineTo(distanciaX + 230, distanciaY + 5);
        ctx.lineTo(distanciaX + 200, distanciaY + 40);
        ctx.lineTo(distanciaX + 170, distanciaY + 5);
        ctx.closePath();
        ctx.fill();
        ctx.strokeStyle = '#E30613'; // rojo
        ctx.lineWidth = 12;
        ctx.lineJoin = 'round';
        ctx.stroke();
    }

    function DibujarRuleta(ArregloElementos) {
        objRuleta = new Winwheel({
            'canvasId': 'Ruleta',
            'numSegments': ArregloElementos.length,
            'outerRadius': 300,
            'innerRadius': 80,
            'segments': ArregloElementos,
            'animation': {
                'type': 'spinToStop',
                'duration': 4,
                'spins': 15,
                'callbackFinished': 'Mensaje()',
                'callbackAfter': 'DibujarTriangulo()',
                'stopAngle': 0
            },
            'strokeStyle': '#E30613', // Color de borde de la ruleta
            'lineWidth': 10, // Grosor de borde de la ruleta
        });

        DibujarTriangulo();
    }

    function premioGanador() {
        var premios = <?php echo json_encode($laDatosView['premio']); ?>;
        var conteoPremios = {};
        var limiteEntrega = {};
        for (var i = 0; i < premios.length; i++) {
            var premio = premios[i].NOMBRE;
            if (conteoPremios[premio] == null) {
                conteoPremios[premio] = premios[i].CANTIDAD_ENTREGADO_DIARIO;
            }
            if (limiteEntrega[premio] == null) {
                limiteEntrega[premio] = premios[i].CANTIDAD_MAX_SALIDAS;
            }
        }
        var ganador = premios[Math.floor(Math.random() * premios.length)];
        while (conteoPremios[ganador] >= limiteEntrega[ganador]) {
            ganador = premios[Math.floor(Math.random() * premios.length)];
        }
        conteoPremios[ganador]++;
        console.log(ganador);
        return ganador;
    }

    function girarRuleta() {
        // Generar un número aleatorio entre 1 y 90 para stopAngle
        //var stopAngle = Math.floor(Math.random() * 90) + 1;

        // Actualizar el valor en el objeto de la ruleta
        //objRuleta.animation.stopAngle = stopAngle;
        var premio = premioGanador();
        var segmentos = premio.length; // número de segmentos
        var segmento = premio.ID_PREMIO - 1; // ajustar el índice base a 0
        var rangoInicio = segmento * 90 + 1;
        var rangoFin = (segmento + 1) * 90;

        var stopAngle = Math.floor(Math.random() * (rangoFin - rangoInicio + 1)) + rangoInicio;
        // Generar dos números aleatorios
        /* var randomNumber1 = Math.floor(Math.random() * 90) + 1;
         var randomNumber2 = Math.floor(Math.random() * 90) + 180;
         
         // Elegir uno de los dos números aleatorios
         var stopAngle = Math.random() < 0.5 ? randomNumber1 : randomNumber2 + 1;*/


        objRuleta.animation.stopAngle = stopAngle;
        // Iniciar la animación
        objRuleta.startAnimation();
    }

    function esImpar(num) {
        return num % 2 === 1;
    }

    function leerElementos() {
        var ElementosRuleta = [];
        var colores = ['#FFD300', '#E30613'];

        var colorIndex = 0;
        var premios = <?php echo json_encode($laDatosView['premio']); ?>;
        var esNumPar = esImpar(premios.length);
        if (esNumPar) {
            colores = ['#FEDD00 ', '#E30613', '#fff'];
        }
        // Mezclar la lista de colores de forma aleatoria
        colores.sort(function() {
            return 0.5 - Math.random()
        });

        // Recorrer la lista de segmentos
        for (var i = 0; i < premios.length; i++) {
            var color = colores[i % colores.length]; // Seleccionar un color de la lista basado en el índice
            // Agregar el segmento a la ruleta con el color correspondiente
            ElementosRuleta.push({
                'fillStyle': color,
                'text': premios[i].NOMBRE,
                'textFontFamily': 'Arial',
                'textFontSize': 20,
                'textAlignment': 'inner',
                'textFillStyle': '#f5f5f5' // Color de texto blanco
            });
        }
        DibujarRuleta(ElementosRuleta);
    }
    leerElementos();
    var audio = new Audio('alarma.mp3'); // Create audio object and load desired file.
    function SonidoFinal() {
        audio.pause();
        audio.currentTime = 0;
        audio.play();
    }
</script>
@push('scripts')
    <script></script>
@endpush
@endsection
