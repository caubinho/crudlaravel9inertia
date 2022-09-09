<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImage;
use App\Http\Requests\UserStoreUpdate;
use App\Models\User;
use App\Services\UploadFile;
use Inertia\Inertia;
use App\Services\UserService;
use Illuminate\Support\Facades\Request;


class UserController extends Controller
{

    protected $service;

    public function __construct(UserService $service)
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

        return Inertia::render('Admin/Users/Index',[
            'datos' => User::query()
                ->when(Request::input('search'),function($query, $search) {
                    $query->where('name','like','%'.$search.'%')
                        ->OrWhere('email','like','%'.$search.'%');
                })->paginate(15)
                ->withQueryString(),
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
        return Inertia::render('Admin/Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreUpdate $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);
        $this->service->create($data);


        return redirect()->route('users.index')->with('message', 'Cadastro com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        if(!$datos = $this->service->findById($id))
            return redirect()->back();

        return Inertia::render('Admin/Users/Show', [
            'datos' => $datos,
        ]);
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

        return Inertia::render('Admin/Users/Edit', [
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
    public function update(UserStoreUpdate $request, $id)
    {
        if(!$datos = $this->service->findById($id))
            return redirect()->back();

        $data = $request->all();

        if(!$request->password){
            unset($data['password']);
        }else{
            $data['password'] = bcrypt($data['password']);
        }

        if(!$this->service->update($id, $data)){
            return back();
        }

        return redirect()->route('users.index')->with('message', 'Atualizado com sucesso!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()->route('users.index')->with('message', 'Excluido com sucesso!');
    }

    public function changeImage($id)
    {
        if( !$datos = $this->service->findById($id))
            return back();

        return Inertia::render('Admin/Users/Image', [
           'datos' => $datos
        ]);
    }

    public function uploadFile(StoreImage $request, UploadFile $uploadFile, $id)
    {

        if(request()->hasFile('image')){
            $path = $uploadFile->store($request->image, 'users');

            if(!$this->service->update($id, ['image' => $path ])){
                return back();
            }
        }

        return redirect()->route('users.change.image', $id )->with('message', 'Imagem alterada com sucesso!');
    }
}
