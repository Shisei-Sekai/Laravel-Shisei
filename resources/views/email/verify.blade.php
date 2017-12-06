<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verifica tu email</h2>

<div>
    ¡Gracias por crear una cuenta en Shisei Sekai, {{$name}}!.
    Para poder logearte y acceder al foro, necesitarás verificar tu email a través de
    este link.
    {{ URL::to('confirm/' . $confirmationCode) }}.<br/>

</div>

</body>
</html>