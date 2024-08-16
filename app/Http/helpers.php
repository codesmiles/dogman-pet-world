<?php

use Illuminate\Support\Str;
function generateId()
{
   $value = mt_rand(0,100000);

    return $value;
}

function fetchImageUrl(string $path, array $options = [])
{
    return cloudinary()->getUrl($path, $options);
}
