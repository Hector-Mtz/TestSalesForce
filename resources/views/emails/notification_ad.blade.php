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
        <p style="font-weight:bold">Hola {{ $user_superior->name }} {{$user_superior->ap_paterno}} {{$user_superior->ap_materno}}</p>
        <p style="font-weight:bold">¡Nuevo prospecto asignado! 🔔</p>
        <p>Se ha asignado un nuevo prospecto a tu siguiente asesor:</p>
        <p>Nombre del usuario: {{ $asesor->name }} {{$asesor->ap_paterno}} {{$asesor->ap_materno}}</p>
        <p style="font-weight:bold">La información de dicho prospecto es la siguiente:</p>
        <p>Nombre: {{$prospecto->nombre}} {{$prospecto->apellidos}} </p>
        <p>Teléfono: {{$prospecto->telefono}} </p>
        <p>Correo electrónico: {{$prospecto->email}} </p>
        <p>
            A partir de este momento, se le asigno en Salesforce este prospecto a dicho asesor. Te recordamos darle el correcto seguimiento al asesor en turno.
         </p>
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