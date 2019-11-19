<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaintingRepository;

class PaintingController extends Controller
{
    protected $repository;

    public function __construct(PaintingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paintings = $this->repository->all();

        if(!$paintings){
            return view('auth.api.login');
        }

        return view('painting.index',compact('paintings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painting.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $created = $this->repository->create($request->except('_token'));

        if(!$created){
            flash('Ocurrio un error al crear el cuadro, intenta nuevamente.')->error();
            return redirect()->route('cuadros.index');
        }
        flash('Se creo el cuadro con exito!')->success();
        return redirect()->route('cuadros.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $painting = $this->repository->find($id);
        return view('painting.update', compact('painting'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $updated = $this->repository->update($request->except('_token'),$id);

        if(!$updated){
            if($updated->error){
                $message = $updated->message;
                flash('Ocurrio un error al editar el cuadro, intenta nuevamente.')->error();
                return redirect()->route('cuadros.edit',$id)->withErrors($message);
            }
            flash('Ocurrio un error al editar el cuadro, intenta nuevamente.')->error();
            return redirect()->route('cuadros.edit',$id);

        }


        flash('Se edito el cuadro con exito!')->success();
        return redirect()->route('cuadros.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       $deleted =  $this->repository->delete($id);

        if(!$deleted){
            flash('Ocurrio un error al eliminar el cuadro, intenta nuevamente.')->error();
            return redirect()->route('cuadros.index');
        }
        flash('Se elimino el cuadro con exito!')->success();
        return redirect()->route('cuadros.index');
    }
}
