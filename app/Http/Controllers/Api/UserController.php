<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserController
{
    /**
     * Repositório de usuários.
     */
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Método responsável por criar um novo usuário.
     * @throws Exception
     */
    public function create(Request $request): Model
    {
        $postVars = $request->all();

        $validator = Validator::make($postVars, [
            "name" => "required|string|max:255",
            "lastname" => "required|string|max:255",
            "age" => "required|integer",
            "gender" => "required|string|max:1",
            "email" => "required|string|email|max:255",
            "password" => "required|string|min:8",
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first(), 400);
        }

        $user = new User();

        $user->name = $postVars["name"];
        $user->lastname = $postVars["lastname"];
        $user->age = $postVars["age"];
        $user->gender = $postVars["gender"];
        $user->email = $postVars["email"];
        $user->password = $postVars["password"];

        return $this->repository->create($user);
    }

    /**
     * Método responsável por criar um novo usuário.
     * @throws Throwable
     */
    public function update(Request $request, int $userId): Model
    {
        $postVars = $request->all();

        $validator = Validator::make($postVars, [
            "name" => "required|string|max:255",
            "lastname" => "required|string|max:255",
            "age" => "required|integer",
            "gender" => "required|string|max:1",
            "email" => "required|string|email|max:255",
            "password" => "required|string|min:8",
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first(), 400);
        }

        $user = $this->repository->findOne($userId);

        $user->name = $postVars["name"];
        $user->lastname = $postVars["lastname"];
        $user->age = $postVars["age"];
        $user->gender = $postVars["gender"];
        $user->email = $postVars["email"];
        $user->password = $postVars["password"];

        $this->repository->update($user);

        return $user;
    }

    /**
     * Método responsável por retornar um usuário pelo ID.
     * @throws Exception
     */
    public function findOne(int $userId): Model
    {
        $user = $this->repository->findOne($userId);

        if (!$user)
            throw new Exception("Usuário não foi encontrado", 404);

        return $user;
    }

    /**
     * Método responsável por retornar todos os usuários.
     */
    public function findAll(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->repository->paginate(["name" => "André"]);
    }
}
