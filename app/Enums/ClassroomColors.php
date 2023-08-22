<?php

namespace App\Enums;
enum ClassroomColors: string
{
    case RED = 'red-500';
    case ORANGE = 'orange-500';
    case YELLOW = 'yellow-500';
    case LIME = 'lime-500';
    case GREEN = 'green-500';
    case TEAL = 'teal-500';
    case BLUE = 'blue-500';
    case INDIGO = 'indigo-500';
    case PURPLE = 'purple-500';
    case FUCHSIA = 'fuchsia-500';
    case PINK = 'pink-500';
    case ROSE = 'rose-500';

    public function inPortuguese(): string
    {
        return match ($this) {
            self::RED => 'Vermelho',
            self::ORANGE => 'Laranja',
            self::YELLOW => 'Amarelo',
            self::LIME => 'Limão',
            self::GREEN => 'Verde',
            self::TEAL => 'Turquesa',
            self::BLUE => 'Azul',
            self::INDIGO => 'Índigo',
            self::PURPLE => 'Roxo',
            self::FUCHSIA => 'Fúcsia',
            self::PINK => 'Rosa',
            self::ROSE => 'Rosê',
        };
    }

    public static function random(): self
    {
        $count = count(self::cases()) - 1;

        return self::cases()[rand(0, $count)];
    }

    public function textColor(): string
    {
        return 'text-' . $this->value;
    }

    public function borderColor(): string
    {
        return 'border-' . $this->value;
    }

    public function bgColor(): string
    {
        return 'bg-' . $this->value;
    }

    public function ringColor(): string
    {
        return 'ring-' . $this->value;
    }
}
