<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreUpdate;
use App\Http\Requests\StoreImage;
use App\Models\Post;
use App\Models\User;
use App\Services\UploadFile;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PostController extends Controller
{

    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Posts/Index',[
            'datos' => Post::query()
                ->when(Request::input('search'),function($query, $search) {
                    $query->where('title','like','%'.$search.'%')
                        ->OrWhere('body','like','%'.$search.'%');
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
        return Inertia::render('Admin/Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostStoreUpdate $request)
    {

        $post = $request->user()
                    ->posts()
                    ->create($request->all());

        return redirect()->route('posts.index')->with('message','Cadastro com sucesso');
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $post = Post::find($id);



        return Inertia::render('Admin/Posts/Edit', [
            'datos' => $post,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostStoreUpdate $request, $id)
    {
        $post = Post::find($id);

       $post->update($request->all());

        return redirect()->route('posts.index')->with('message','Alterado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$post = $this->post->find($id))
            return redirect()->back();

        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Excluido com sucesso!');
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
