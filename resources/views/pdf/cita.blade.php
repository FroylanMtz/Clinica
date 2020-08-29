<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de cita No. {{ $id }} </title>

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
    
    <h1 class="text-center"> Reporte de cita No. {{ $id }} </h1>

    <div class="card border-light" style="max-width: 100%;">
      <div class="card-header"> <b> Información de la cita </b>  </div>
      <div class="card-body ">
        <br><br>
        <b> Fecha: </b> {{ $cita[0]->fecha }} <br>
        <b> Hora: </b> {{ $cita[0]->hora }} <br>
        <b> Detalles: </b> {{ $cita[0]->detalles }} <br>
      </div>
    </div>

    <div class="card border-dark " style="max-width: 100%;">
      <div class="card-header" style="background: white;"> <b> Paciente </b> </div>
      <div class="card-body text-dark ">
        <br><br>
        <b> Nombre: </b> {{$paciente[0]->nombre}} <br>
        <b> Apellido: </b> {{$paciente[0]->apellido}} <br>
        <b> Sexo: </b> {{$paciente[0]->sexo}} <br>
        <b> Edad: </b> {{$paciente[0]->edad}} <br>
        <b> Altura: </b> {{$paciente[0]->altura}} <br>
        <b> Peso: </b> {{$paciente[0]->peso}} <br>
      </div>
    </div>

    <div class="card border-dark " style="max-width: 100%;">
      <div class="card-header" style="background: white;"> <b> Analisis clinico </b> </div>
      <div class="card-body text-dark">
        <br><br>

        <b> Medico: </b> {{ $doctor[0]->name . ' ' . $doctor[0]->last_name}} <br>
        <b> Observacion del medico: </b> {{$cita[0]->observaciones}} <br>
        <b> Enfermedad: </b> {{ $enfermedad[0]->nombre }} <br>
        <b> Tipo de enfermedad: </b> {{ $enfermedad[0]->tipo }} <br>
        <b> Posible causa: </b> {{ $enfermedad[0]->causa }} <br>

      </div>
    </div>

    <div class="card border-dark " style="max-width: 100%;">
      <div class="card-header" style="background: white;"> <b> Medicamento </b> </div>
      <div class="card-body text-dark ">
      <br><br>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Presentacion</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  

                  
                  @php
                    foreach($medicamento as $med){
                      echo '<tr>';
                      echo '<td>' . $med->nombre . '</td>';
                      echo '<td>' . $med->presentacion . '</td>';
                      echo '<td>' . $med->detalles . '</td>';
                      echo '<td>' . $med->observaciones . '</td>';
                      echo '</tr>';
                    }

                  @endphp

                </tbody>
              </table>

      </div>
    </div>



  </body>
</html>