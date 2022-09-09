<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\DetailPlanStoreUpdate;
use App\Services\DetailPlanService;
use App\Services\PlanService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DetailPlanController extends Controller
{
    protected $service, $plan;

    public function __construct(DetailPlanService $service, PlanService $plan)
    {
        $this->service = $service;
        $this->plan = $plan;

    }

    public function index($idPlan)
    {

        if (!$plan = $this->plan->findById( $idPlan)){
           return redirect()->back();
        };

        $details = $this->service->getAll($idPlan);

        return Inertia::render('Admin/Plans/DetailPlan/Index', [
                'plan' => $plan,
                'details' => $details
             ]);
    }

    public function create($idPlan)
    {

        if (!$plan = $this->plan->findById( $idPlan)){
            return redirect()->back();
        };

        return Inertia::render('Admin/Plans/DetailPlan/Create', [
            'plan' => $plan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(DetailPlanStoreUpdate $request, $idPlan)
    {


        if (!$plan = $this->plan->findById( $idPlan)){
            return redirect()->back();
        };

//        $data = $request->validated();
//        $data['plan_id'] = $plan->id;

        $plan->details()->create($request->validated());



        return redirect()->route('detail.plan.index', $plan->id)->with('message', 'Cadastro com sucesso!');

    }

    public function edit($idPlan, $idDetail)
    {

        $plan = $this->plan->findById($idPlan);

        $detail = $this->service->findById($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return Inertia::render('Admin/Plans/DetailPlan/Edit', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DetailPlanStoreUpdate $request, $idPlan, $idDetail)
    {

        $plan = $this->plan->findById( $idPlan);
        $detail = $this->service->findById($idDetail);

        if (!$plan || !$detail) {
            return redirect()->route('detail.plan.edit', $idPlan)->with('error', 'Erro ao Alterar');
        };

        $this->service->update($idDetail, $request->all());

        return redirect()->route('detail.plan.index', $idPlan )->with('message', 'Atualizado com sucesso!');


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($idPlan, $idDetail)
    {

       $plan = $this->plan->findById( $idPlan);
       $detail = $this->service->findById($idDetail);

        if (!$plan || !$detail) {
            return redirect()->route('detail.plan.index', $idPlan)->with('error', 'Erro ao exlcuir');
        };



        $this->service->delete($detail->id);

        return redirect()->route('detail.plan.index', $idPlan)->with('message', 'Excluido com sucesso!');
    }
}
