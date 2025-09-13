<?php

enum Measurement: int
{
    case KG = 1;
    case LITER = 2;
    case GRAM = 3;
    case MILLILITER = 4;

    public function toString(): string
    {
        return match ($this) {
            self::KG => 'kg',
            self::LITER => 'L',
            self::GRAM => 'g',
            self::MILLILITER => 'ml',
        };
    }

    public static function fromInt(int $value): null|self
    {
        return self::tryFrom($value);
    }
}
