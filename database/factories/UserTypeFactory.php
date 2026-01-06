<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserTypeFactory extends Factory {
    protected $userTypes = [
        'ADMINISTRADOR',
        'VENDEDOR',
        'OPERAÇÃO ASSISTIDA',
    ];
    
    protected static $i = 0;

    public function definition(): array {
        $currentType = $this->userTypes[static::$i % count($this->userTypes)];
        static::$i++;

        return [
            'type' => $currentType,
        ];
    }
}
