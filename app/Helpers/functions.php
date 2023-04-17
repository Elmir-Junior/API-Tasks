<?php


use Illuminate\Support\Str;

function removePriceMask(string $price): string
{
    return Str::of($price)->replace(['R$', ' ', '.'], '')->replaceLast(',', '.');
}

function formatPhone(string $number): string
{
    return "(" . substr($number, 0, 2) . ")" . substr($number, 2, -4) . "-" . substr($number, -4);
}

function formatDate(string $date): string
{ 
    $day = substr($date, 0, 2);
    $month = substr($date, 3, 2);
    $year = substr($date, 6, 4);

    return "$year-$month-$day";
}

function formatCpf(string $cpf): string
{
    $mask = '###.###.###-##';

    $str = str_replace(" ", "", $cpf);

    for ($i = 0; $i < strlen($str); $i++) {
        $mask[strpos($mask, "#")] = $str[$i];
    }

    return $mask;
}