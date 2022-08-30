<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function phpinfo;

class UserController
{
    /**
     * Método responsável por retornar um usuário pelo ID.
     * @param int $userId
     * @return array
     */
    public function findOne(int $userId): array
    {
        return [
            "id"       => $userId,
            "name"     => "André",
            "lastname" => "Oliveira"
        ];
    }

    /**
     * Método responsável por retornar todos os usuários.
     * @param Request $request
     * @return array
     */
    public function findAll(Request $request): array
    {
        return [
            [
                "id"       => 1,
                "name"     => "André",
                "lastname" => "Oliveira"
            ],
            [
                "id"       => 2,
                "name"     => "Luis",
                "lastname" => "Souza"
            ]
        ];
    }
}
