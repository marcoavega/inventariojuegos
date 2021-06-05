<?php
$template = '
<article class="">
<h2 class="">id: %s</h2>
<h3 class="">Sus datos de usuario son: </h3>
<p class="">Nombre: <b>%s</b></p>
<p class="">Password: <b>%s</b></p>
<p class="">Perfil de usuario tiene un nivel de: <b>%s</b></p>
</article>
';
printf(
    $template,
    $_SESSION['id_usuario'],
    $_SESSION['nombre'],
    $_SESSION['password'],
    $_SESSION['permisos']
);