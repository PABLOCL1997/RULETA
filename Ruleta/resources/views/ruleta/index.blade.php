
@extends('layouts.admin')
@section('contenido') 
<body>
    <form id="form1" runat="server">

    <div>
        <style>
         #canvasContainer {
            background-image: url(img/Muerte.png);
            background-repeat: no-repeat;  
            background-position: center;   
            width: 700px;                  
            height: 700px;
			cursor:pointer;
		
        }

        </style>

        <div class="container-fluid">

            <div class="row">
                <div class="col-3 text-center">  
				<h1>La Ruleta</h1>
                    <br />

                     <br />
                    <br />
                   <!-- <div class="card bg-warning">
  <div class="card-body">
  
                  <h4 class="card-title">Lista de elementos:</h4>  
                    
                    <textarea id="ListaElementos" class="form-control" rows="13">
@foreach ($laDatosView['premio'] as $item)
{{ $item->NOMBRE }}
@endforeach
	  </textarea>
<br />
                    <input type="button" onclick="leerElementos()" class="btn btn-danger btn-lg btn-block" value="Generar Ruleta"/><br />
      </div></div>-->
      
                </div>
                <div class="col-7 text-center">
				<br/>
                     <input id="bigButton" class="btn-block btn-lg btn btn-success " onclick="objRuleta.startAnimation(); this.disabled=true;" value="Girar" type="button"/>
                      <div id="canvasContainer" onclick="objRuleta.startAnimation();bigButton.disabled = true;">
     <canvas id='Ruleta' width='700' height='690'>
         
            Canvas not supported, use another browser.
        </canvas> 
        
            </div>
                </div>
                <div class="col-2">
                    				<br/>
                   

                </div>
            </div>
      

            </div>

     <script>
         var objRuleta;
         var winningSegment;
         var distnaciaX = 150;
         var distnaciaY = 50;
         var ctx ;
         function Mensaje() {
             winningSegment = objRuleta.getIndicatedSegment();
			 SonidoFinal();
             swal({
                 title: " ¡ "+winningSegment.text+" !",
               
                 imageUrl: "img/Muerte.png",
                 showCancelButton: true,
                 confirmButtonColor: "#e74c3c",
                 confirmButtonText: "Ok,Reiniciar",
                 cancelButtonText: "Quitar elemento",
                 closeOnConfirm: true,
                 closeOnCancel: true
             },
      function (isConfirm) {
          if (isConfirm) {
             
          } else {

              $('#ListaElementos').val($('#ListaElementos').val().replace(winningSegment.text,""));
              leerElementos();
              
          }
          objRuleta.stopAnimation(false);
          objRuleta.rotationAngle = 0;
          objRuleta.draw();
          DibujarTriangulo();
          bigButton.disabled = false;
      });

      }

         function DibujarTriangulo() {
             distnaciaX = 150;
             distnaciaY = 50;
             ctx = objRuleta.ctx;
             ctx.strokeStyle = 'navy';
             ctx.fillStyle = '#000000';
             ctx.lineWidth = 2;
             ctx.beginPath();
             ctx.moveTo(distnaciaX + 170, distnaciaY + 5);
             ctx.lineTo(distnaciaX + 230, distnaciaY + 5);
             ctx.lineTo(distnaciaX + 200, distnaciaY + 40);
             ctx.lineTo(distnaciaX + 171, distnaciaY + 5);
             ctx.stroke();
             ctx.fill();
         }

         function DibujarRuleta(ArregloElementos) {
             
               objRuleta = new Winwheel({
                 'canvasId': 'Ruleta',
                 'numSegments': ArregloElementos.length,
                 'outerRadius': 270,
                 'innerRadius': 80,
                 'segments':ArregloElementos,
                 'animation':
                 {
                     'type': 'spinToStop',
                     'duration':4,
                     'spins': 15,
					 'callbackFinished': 'Mensaje()',
                     'callbackAfter': 'DibujarTriangulo()' 
					 
                 }, 
				
             });
    
               DibujarTriangulo();
	  }
        function leerElementos() {
                  var ElementosRuleta= [];
	          /*Elementos.forEach(function (Elemento) {
                      if(Elemento){
                      ElementosRuleta.push({ 'fillStyle': "#" + ((1 << 24) * Math.random() | 0).toString(16), 'text': Elemento });
                  }
                  });*/
                  var premios = <?php echo json_encode($laDatosView['premio']); ?>;
                  premios.forEach(function (Elemento) {
                        if(Elemento && Elemento.NOMBRE){
                            console.log(Elemento);
                            ElementosRuleta.push({ 'fillStyle': "#" + ((1 << 24) * Math.random() | 0).toString(16), 'text': Elemento.NOMBRE });
                        }else{
                            alert("Error al obtener los premios");
                        }
                    });
                  DibujarRuleta(ElementosRuleta);
	     } 
         leerElementos();
		  var audio = new Audio('alarma.mp3');  // Create audio object and load desired file.
		function SonidoFinal()
			{
				audio.pause();
				audio.currentTime = 0;
				audio.play();
			}
 
</script>
    </div>
    </form>


</body>
@push ('scripts')
<script>

</script>
@endpush
@endsection
