<?php

namespace App\Repositories\Eloquent;

use App\Models\DetailPlan as Model;
use App\Repositories\DetailPlanRepositoryInterface;



class DetailPlanRepository implements DetailPlanRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(string $idPlan): array | null
    {
        $plan = $this->model->where('plan_id', $idPlan)->get();

        return $plan->toArray();
    }

    public function findById(string $id): object|null
    {
        return $this->model->find($id);
    }
    public function create(array $data): object
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): object|null
    {
        if(!$user = $this->findById($id)){
            return null;
        }

        $user->update($data);

        return $user;
    }

    public function delete(string $id): bool
    {
        if(!$user = $this->findById($id))
            return false;

        return $user->delete();
    }
}
