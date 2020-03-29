<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $obj = json_decode(file_get_contents('php://input'));
    $result = proccessFile($obj);
    rewriteFile($result);
    echo $result;
}

function proccessFile($content)
{
    $content->cifrado = mb_strtolower($content->cifrado);

    $chars = [];

    for ($i = 0; $i < strlen($content->cifrado); $i++) {
        array_push($chars, myDecode($content->cifrado[$i], $content->numero_casas));
    }
    $content->decifrado = implode($chars);
    $content->resumo_criptografico = sha1($content->decifrado);

    rewriteFile(json_encode($content));

    return json_encode($content);
}

function myDecode($char, $n)
{
    $number = ord($char);
    $start = 97;
    $end = 122;

    if ($number < $start && $number > $end) {
        return $char;
    }
    $numberResult = $number;

    while ($n > 0) {
        $numberResult--;
        if ($numberResult < $start) {
            $numberResult = $end;
        }
        $n--;
    }
    $charResult = chr($numberResult);
    return $number > $start && $number <= $end ? $charResult : $char;
}

function rewriteFile(string $content)
{
    $fp = fopen('answer.json', 'w');
    fwrite($fp, $content);

    fclose($fp);
}
