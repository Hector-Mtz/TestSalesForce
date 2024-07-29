<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificacion de nuevo prospecto</title>
</head>
<body>
     <h1 class="title">Lead Manager Maderas</h1>
     <div class="image">
        <img style="margin-left: 10rem; margin-rigth:10rem;" width="350px" height="170px" src="{{asset('images/maderas_logo.png')}}" />
     </div>
     <div class="contenedor">
        <p>Estimado: {{ $asesor->name }} {{$asesor->ap_paterno}} {{$asesor->ap_materno}}</p>
        <p>Se te ha asignado el prospecto: {{$prospecto->nombre}} {{$prospecto->apellidos}} </p>
        <p>Número de celular: {{$prospecto->telefono}} </p>
        <p>Correo electrónico: {{$prospecto->email}} </p>
        <p>Ingresa al siguiente enlace para su seguimiento: <br/>
         </p>
         <a href="link">link</a>
        Saludos
     </div>
</body>
</html>
<style>
.title{
    font-size: 20px;
    text-align: center;
}
.image:{
    display: flex;
    justify-content: center;
    justify-items: center;
}
.contenedor{
    border-top: 10px;
    border-top: solid;
    border-top-color: #5562a3;
}
</style>