<?php

use Illuminate\Support\Str;
function generateEmployeeId(): string
{
    return Str::random(10);
}
