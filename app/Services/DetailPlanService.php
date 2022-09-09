<?php

namespace App\Services;

use App\Repositories\DetailPlanRepositoryInterface;

class DetailPlanService
{
    private DetailPlanRepositoryInterface $repository;

    public function __construct(DetailPlanRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $idPlan ): array | null
    {
        return $this->repository->getAll(
            idPlan: $idPlan,
        );

    }

    public function findById(string $id): object|null
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): object
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): object|null
    {
        return $this->repository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
