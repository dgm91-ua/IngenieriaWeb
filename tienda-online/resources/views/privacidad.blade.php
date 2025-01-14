@extends('layouts.masterusers')

@section('title', 'Política de Privacidad | LuxuryParfum')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Política de Privacidad</h1>
    <p class="lead">
        En <strong>LuxuryParfum</strong>, tu privacidad es uno de nuestros pilares fundamentales. Trabajamos para proteger tus datos personales y asegurarnos de que tu experiencia de compra sea segura y confiable.
    </p>

    <h3>1. Información que Recopilamos</h3>
    <p>
        Cuando utilizas nuestro sitio o realizas una compra, podemos solicitar datos como tu nombre, dirección de correo electrónico, dirección postal, número de teléfono y preferencias de compra. Esta información nos permite procesar tus pedidos y mejorar los productos y servicios que te ofrecemos.
    </p>

    <h3>2. Uso de la Información</h3>
    <p>
        Utilizamos los datos que recopilamos para:
    </p>
    <ul>
        <li>Procesar y gestionar tus pedidos de forma eficiente.</li>
        <li>Personalizar tu experiencia de navegación y recomendaciones de productos.</li>
        <li>Brindarte un mejor servicio de atención al cliente.</li>
        <li>Enviarte noticias, ofertas o información relevante sobre nuestros productos (siempre con tu consentimiento previo).</li>
    </ul>

    <h3>3. Compartir la Información</h3>
    <p>
        <strong>LuxuryParfum</strong> no vende, alquila ni intercambia tus datos personales con terceros. Únicamente compartimos información con proveedores y socios de confianza que nos ayudan a operar nuestro sitio web y ofrecerte un servicio de calidad. Todos ellos están sujetos a contratos de confidencialidad que garantizan la protección de tus datos.
    </p>

    <h3>4. Seguridad</h3>
    <p>
        Aplicamos medidas de seguridad adecuadas para proteger tus datos contra el acceso no autorizado, alteración, divulgación o destrucción. Entre ellas, se incluyen protocolos de cifrado y sistemas de monitoreo de la información.
    </p>

    <h3>5. Tus Derechos y Opciones</h3>
    <p>
        Tienes derecho a acceder, rectificar o eliminar la información personal que tengamos sobre ti. Asimismo, puedes solicitar la limitación o la oposición a su tratamiento, así como ejercer tu derecho a la portabilidad de datos cuando corresponda.
    </p>

    <h3>6. Cambios en la Política de Privacidad</h3>
    <p>
        Podremos actualizar nuestra Política de Privacidad ocasionalmente para reflejar mejoras o cambios en nuestras prácticas. Te recomendamos revisar esta sección periódicamente.
    </p>

    <h3>7. Contacto</h3>
    <p>
        Si tienes preguntas, comentarios o inquietudes sobre esta política, o deseas ejercer tus derechos, por favor <a href="{{ route('contacto') }}">contáctanos</a>. Estaremos encantados de ayudarte.
    </p>

    <p class="mt-4">
        Al utilizar nuestro sitio, aceptas los términos descritos en esta Política de Privacidad. Agradecemos tu confianza y trabajamos constantemente para proteger tu información.
    </p>
</div>
@endsection
