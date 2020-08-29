@extends('layouts.app')

@section('content')

<div class="login-logo">
    <img src="{{asset('photos/logo.png')}}" alt="Opcion medica" class="brand-image-xl logo-xs" style="width:100px;"/>
    <img src="{{asset('photos/logo2.png')}}" alt="Opcion medica" class="brand-image-xs logo-xl ml-2" style="left: 32px; width:200px;" />
           
    


</div>

<div class="card">
                
    <div class="card-body login-card-body">
                <center> <h1> Iniciar sesión </h1> </center>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-left">Correo: </label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-left"> Contraseña </label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            
                            <div class="col-md-12 mt-2">
                                <center>
                                    <button type="submit"  class="btn btn-outline-primary btn-lg btn-block">
                                        Iniciar sesión
                                    </button>
                                </center>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
