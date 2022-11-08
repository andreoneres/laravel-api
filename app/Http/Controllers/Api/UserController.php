<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Exception;
use Throwable;

class UserController
{
    /**
     * Instância do modelo de usuários.
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Método responsável por criar um novo usuário.
     */
    public function create(CreateRequest $request): User
    {
        return $this->user->create($request->validated());
    }

    /**
     * Método responsável por criar um novo usuário.
     * @throws Throwable
     */
    public function update(UpdateRequest $request, int $userId): User
    {
        $data = $request->validated();

        $user = $this->findOne($userId);

        $user->update($data);

        return $user;
    }

    /**
     * Método responsável por retornar um usuário pelo ID.
     * @throws Exception
     */
    public function findOne(int $userId): User
    {
        $user = $this->user->query()->find($userId);

        if (!$user)
            throw new Exception("User not found", 404);

        return $user;
    }

    /**
     * Método responsável por retornar todos os usuários.
     */
    public function findAll(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->user->query()->paginate(10);
    }
}
