<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreUpdate;
use App\Services\PermissionService;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PermissionController extends Controller
{

    protected $service;

    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Permissions/Index',[
            'datos' => $this->service->getAll(),
            'filters' => Request::only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Permissions/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionStoreUpdate $request)
    {
        $data = $request->validated();

        $this->service->create($data);

        return redirect()->route('permissions.index')->with('message', 'Cadastro com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        if(!$datos = $this->service->findById($id))
            return redirect()->back();

        return Inertia::render('Admin/Permissions/Edit', [
            'datos' => $datos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PermissionStoreUpdate $request, $id)
    {
        if(!$datos = $this->service->findById($id))
            return redirect()->back();

        $data = $request->all();


        if(!$this->service->update($id, $data)){
            return back();
        }

        return redirect()->route('permissions.edit', $id)->with('message', 'Atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $plan = $this->service->findById($id);

        $this->service->delete($id);


        return redirect()->route('permissions.index')->with('message', 'Excluido com sucesso!');

    }
}
