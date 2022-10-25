<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * Instância do modelo.
     */
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Método responsável por criar um novo registro.
     * @throws Exception
     */
    public function create(Model $model): Model
    {
        if (!$model->save())
            throw new Exception("Erro ao salvar o modelo no banco de dados");

        return $model;
    }

    /**
     * Método responsável por atualizar um registro já existente.
     * @throws Exception
     * @throws Throwable
     */
    public function update(Model $model): void
    {
        if (!$model->update())
            throw new Exception("Erro ao atualizar o modelo no banco de dados");
    }

    /**
     * Método responsável por retornar um registro pelo seu ID.
     */
    public function findOne(int $id): ?Model
    {
        return $this->model::query()->find($id);
    }

    /**
     * Método responsável por retornar um registro a partir
     * de array com um ou mais filtros.
     */
    public function findOneBy(array $criteria): ?Model
    {
        $keys = array_keys($criteria);
        $values = array_values($criteria);

        return $this->model::query()
            ->whereRowValues($keys, " = ", $values)
            ->first();
    }

    /**
     * Método responsável por retornar todos os registros.
     */
    public function findAll(string $orderBy = "id", int $limit = 10): Collection
    {
        return $this->model::query()
            ->orderBy($orderBy)
            ->limit($limit)
            ->get();
    }

    /**
     * Método responsável por retornar todos os registros
     * a partir de um array com um ou mais filtros.
     */
    public function findAllBy(array $criteria, string $orderBy = "id", int $limit = 10): Collection
    {
        $criteria = $this->clearFilterArray($criteria);

        if (empty($criteria)) {
            return $this->model::query()
                ->orderBy($orderBy)
                ->limit($limit)
                ->get();
        }

        $keys = array_keys($criteria);
        $values = array_values($criteria);

        return $this->model::query()
            ->whereRowValues($keys, " = ", $values)
            ->orderBy($orderBy)
            ->limit($limit)
            ->get();
    }

    /**
     * Método responsável por retornar todos os registros paginados
     * a partir de um array com um ou mais filtros.
     */
    public function paginate(array $criteria, string $orderBy = "id", int $limit = 10): LengthAwarePaginator
    {
        $criteria = $this->clearFilterArray($criteria);

        if (empty($criteria)) {
            return $this->model::query()
                ->orderBy($orderBy)
                ->paginate($limit);
        }

        $keys = array_keys($criteria);
        $values = array_values($criteria);

        return $this->model::query()
            ->whereRowValues($keys, " = ", $values)
            ->orderBy($orderBy)
            ->paginate($limit);
    }

    /**
     * Método responsável por retornar a quantidade de registros.
     */
    public function count(): int
    {
        return $this->model::query()->count();
    }

    /**
     * Método responsável por remover valores vazios do array.
     */
    protected function clearFilterArray(array $filters): array
    {
        $cleanFilters = [];
        foreach ($filters as $key => $filter) {
            if (!empty($filter)) {
                $cleanFilters[$key] = $filter;
            }
        }

        return $cleanFilters;
    }
}
