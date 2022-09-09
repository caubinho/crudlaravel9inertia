<?php

namespace App\Repositories\Eloquent;

use App\Models\Profile as Model;
use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Support\Facades\Request;

class ProfileRepository implements ProfileRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): array
    {
        $datos = $this->model->query()
            ->when(Request::input('search'),function($query, $search) {
                $query->where('name','like','%'.$search.'%')
                    ->OrWhere('description','like','%'.$search.'%');
            })->paginate(15)
            ->withQueryString();

        return $datos->toArray();
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
