<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Expediente No. {{ $id }} </title>

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
    
    <h1 class="text-center"> Expediente No. {{ $id }} </h1>

  </body>
</html>