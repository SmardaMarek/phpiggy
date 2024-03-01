<?php

function dd(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}
function e(mixed $value): string
{
    return htmlspecialchars((string)$value);
}
