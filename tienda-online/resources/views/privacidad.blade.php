@extends('layouts.masterusers')

@section('content')
<div class="container my-5">
    <h1>Política de Privacidad</h1>
    <p class="lead">En LuxuryParfum valoramos tu privacidad y nos comprometemos a proteger tus datos personales.</p>
    <h3>Información Recolectada</h3>
    <p>Podemos recopilar tu nombre, correo electrónico, dirección, número de teléfono y preferencias de compra.</p>
    <h3>Uso de la Información</h3>
    <p>La información que recopilamos se utiliza para procesar tus pedidos, mejorar nuestra oferta y proporcionarte una experiencia personalizada.</p>
    <h3>Compartir la Información</h3>
    <p>No vendemos ni compartimos tus datos con terceros no autorizados. Podemos compartir información con proveedores que nos ayuden a brindar nuestros servicios, siempre bajo acuerdos de confidencialidad.</p>
    <h3>Seguridad</h3>
    <p>Contamos con medidas de seguridad para proteger tus datos contra accesos no autorizados.</p>
    <h3>Contacto</h3>
    <p>Si tienes preguntas sobre esta política, <a href="{{ route('contacto') }}">contáctanos</a>.</p>
</div>
@endsection
