<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de pago {{ $id }} </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }
 
        body {
            margin: 3cm 2cm 2cm;
        }
 
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2.2cm;
            background-color: #6190e8;
            color: white;
            /*text-align: center;*/
            line-height: 30px;
        }
 

    </style>

  </head>
  <body>

    <header>
        <img src="{{asset('photos/logo.png')}}" alt="Opcion medica" class="brand-image mt-2 ml-5" style="width:80px;">
        <img src="{{asset('photos/logo2.png')}}" alt="Opcion medica" class="brand-image mt-2 " style="width:200px;">
    </header>
    
    <h1 class="text-center"> Reporte de pago # {{ $id }} </h1>

    <div class="card border-light" style="max-width: 100%;">
      <div class="card-header"> <b> Información de la cita </b>  </div>
      <div class="card-body ">
        <br><br>

        <b> Medico: </b> {{ $doctor[0]->name . ' ' . $doctor[0]->last_name }} <br>
        <b> Correo: </b> {{ $doctor[0]->email }} <br>
        <b> Fecha: </b> {{ $cita[0]->fecha }} <br>
        <b> Hora: </b> {{ $cita[0]->hora }} <br>
        <b> Detalles: </b> {{ $cita[0]->detalles }} <br>
      </div>
    </div>

    <div class="card border-dark " style="max-width: 100%;">
      <div class="card-header" style="background: white;"> <b> Pago </b> </div>
      <div class="card-body text-dark ">
      <br><br>
        <b>Fecha del pago: </b> {{ $pago[0]->fecha }} <br>
        <b>Detalles: </b> {{ $pago[0]->detalles }} <br>
        <b>Tipo de pago: </b> {{ $pago[0]->tipo }} <br>
        <b>Total: $ </b> {{$pago[0]->total }} <br>
      </div>
    </div>


  </body>
</html>