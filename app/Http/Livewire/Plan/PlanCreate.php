<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use App\Services\PagSeguro\Plan\PlanCreateService;
use Livewire\Component;

class PlanCreate extends Component
{
    public array $plan = [];

    protected $rules = [
        'plan.name' => 'required',
        'plan.description' => 'required',
        'plan.price' => 'required',
        'plan.slug' => 'required'
    ];

    public function createPlan()
    {
        $this->validate();
        $plan = $this->plan;

        $planCreate = new PlanCreateService();
        $planPagSeguroReference =  $planCreate->makeRequest($plan);

        $plan['reference'] = $planPagSeguroReference;

        Plan::create($plan);

        $this->plan = [];

        session()->flash('message', 'Plano Criado com Sucesso');
    }

    public function render()
    {
        return view('livewire.plan.plan-create');
    }
}