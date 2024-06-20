<?php

namespace App\DoctrineTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\Log;

class EnumType extends Type
{
    const NAME = 'enum'; // Unique name for the type.

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $defaultValue = "";
        if (isset($column['default'])) {
            $defaultValue = " DEFAULT '" . $column['default'] . "'";
        }

        // Map each element of the array to be wrapped in single quotes
        $quotedArray = array_map(function ($item) {
            return "'" . $item . "'";
        }, $column['allowed']);

        // Join the array elements into a string, separated by commas
        $string = implode(", ", $quotedArray);
        // Return the ENUM declaration with optional DEFAULT value.
        return "ENUM(" . $string . ")" . $defaultValue;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
