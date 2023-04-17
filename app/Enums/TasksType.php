<?php

namespace App\Enums;

use App\Traits\EnumMethods;

enum TasksType: int
{
    use EnumMethods;

    case TIPO = 1;
    case TIPO2 = 2;
    public function name(): string
    {
        return match ($this) {
            static::TIPO => 'TIPO 1',
            static::TIPO2 => 'TIPO 2'
        };
    }
}
