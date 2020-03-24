<?php
loadCodification();
proccessFile();

function loadCodification()
{
    $ch = curl_init('https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=45296e6a02a3341dde66779908ee84ec021c6af8');
    $fp = fopen('answer.json', 'w');

    try {
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    } catch (Exception $e) {
        print_r($e->getMessage());
    }
}

function proccessFile()
{
    $content = json_decode(file_get_contents('answer.json'), false);

    $content->cifrado = mb_strtolower($content->cifrado);

    var_dump($content);
    $chars = [];

    for ($i = 0; $i < strlen($content->cifrado); $i++) {
        array_push($chars, myDecode($content->cifrado[$i], $content->numero_casas));
    }
    $content->decifrado = implode($chars);
    var_dump($content);
    // rewriteFile(json_encode($content));
}

function myDecode($char, $n)
{
    $number = ord($char);
    $start = 97;
    $end = 122;

    if ($number < $start && $number > $end) {
        return $char;
    }
    $numberResult = chr($number - $n);

    $diference = 122 - 97;
    $balance = $number % $start;
    exit('Balance ' . $balance);
    return $number > $start && $number <= $end ? $numberResult : $char;
}

function rewriteFile(string $content)
{
    $fp = fopen('answer.json', 'w');
    fwrite($fp, $content);

    fclose($fp);
}
