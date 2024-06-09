<?php

namespace App\Traits;

use App\Enums\MessageType;
use Illuminate\Support\Arr;

trait BaseEnumTrait
{
    /**
     * Get all values of the enum.
     *
     * @return array
     */
    public static function all(): array
    {
        $reflection = new \ReflectionClass(static::class);
        return array_values($reflection->getConstants());
    }

    public static function transList(): array
    {
        $reflection = new \ReflectionClass(static::class);
        return $reflection->getConstants();
    }

    /**
     * Get label from enum constant.
     *
     * @return string
     */
    public function label(): string
    {
        return ucfirst(strtolower(str_replace('_', ' ', $this->name)));
    }

    /**
     * Get the key (name) of a specific value.
     *
     * @param mixed $value
     * @return string|null
     */
    public static function getKey(mixed $value): ?string
    {
        $reflection = new \ReflectionClass(static::class);
        foreach ($reflection->getReflectionConstants() as $constant) {
            if ($constant->getValue() === $value) {
                return $constant->getName();
            }
        }
        return null;
    }

    public function toArray($item = null): array
    {
        return [
            'key' => $this->name,
            'value' => $this->value,
            'label' => $this->label()
        ];
    }

    public static function getAllToArray()
    {
        $reflection = new \ReflectionClass(static::class);
        return array_map(function (\ReflectionClassConstant $constant) {
            return $constant->getValue()->toArray();
        }, $reflection->getReflectionConstants());
    }

    public static function toSelectArray(): array
    {
        $reflection = new \ReflectionClass(static::class);
        return Arr::map($reflection->getReflectionConstants(), function (\ReflectionClassConstant $constant) {
            $val = $constant->getvalue();
            return $val->name;
        });
    }

    public function is($status): bool
    {
        return $this->value == $status || $this == $status;
    }

    public function isNot($status): bool
    {
        return !$this->is($status);
    }

    public function isOneOf($statuses): bool
    {
        return in_array($this->value, $statuses);
    }

    public static function getEnum($value): ?static
    {
        $reflection = new \ReflectionClass(static::class);
        foreach ($reflection->getReflectionConstants() as $constant) {
            if ($constant->getValue() == $value) {
                return $constant->getValue();
            }
        }
        return null;
    }

    public static function getEnumByKey($key): ?static
    {
        $reflection = new \ReflectionClass(static::class);
        foreach ($reflection->getReflectionConstants() as $constant) {
            if ($constant->getName() == $key) {
                return $constant->getValue();
            }
        }
        return null;
    }

    public static function getEnumByValue($value): ?static
    {
        $reflection = new \ReflectionClass(static::class);
        foreach ($reflection->getReflectionConstants() as $constant) {
            if ($constant->getValue() == $value) {
                return $constant->getValue();
            }
        }
        return null;
    }

    public static function getAllKeys(): array {
        $keys = [];
        foreach (static::cases() as $case) {
            $keys[] = $case->name;
        }
        return $keys;
    }

    public static function getAllValues(): array {
        $values = [];
        foreach (static::cases() as $case) {
            $values[] = $case->value;
        }
        return $values;
    }
}
