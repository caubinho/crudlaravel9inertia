<?php

namespace App\Repositories;

interface ProfileRepositoryInterface
{
    public function getAll(): array;
    public function findById(string $id): object | null;
    public function create(array $data): object;
    public function update(string $id, array $data): object | null;
    public function delete(string $id): bool;
}
