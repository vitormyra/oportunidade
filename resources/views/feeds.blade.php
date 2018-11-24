<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        @for ($i = 0; $i < count($palavras); $i++)
            <p>Artigo {{ $i + 1 }} ({{ $titulos[$i] }})</p>
            <p>Palavra mais citada: {{ $palavras[$i] }}</p>
            <p>Quantidade de citações: {{ $quantidade[0] }}</p>
            <p>Quantidade de palavras nesse tópico: {{ count($paravrasPorTopico[$i]) }}</p>
            <br>
            <hr>

        @endfor

</body>
</html>