<?php

function view(string $file): string
{
    return base_path("resources/views/{$file}.php");
}
function base_path($path = ''): string
{
    return __DIR__ . "/../../{$path}";
}

function public_path($path = ''): string
{
    return __DIR__ . "/../../public/{$path}";
}