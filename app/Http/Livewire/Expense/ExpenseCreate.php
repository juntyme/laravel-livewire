<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseCreate extends Component
{
    public $amount = '0.00';
    public $type;
    public $description;

    protected $rules = [
        'amount' => 'required',
        'type' => 'required',
        'description' => 'required'
    ];

    public function createExpense()
    {
        // Validação
        $this->validate();

        auth()->user()->expenses()->create([
            'amount' => $this->amount,
            'type' => $this->type,
            'description' => $this->description,
            'user_id' => 1
        ]);

        /// Session alerta
        session()->flash('message', 'Registro Criado com Sucesso');

        // Limpar Campos
        $this->amount = $this->type = $this->description = null;
    }

    public function render()
    {
        return view('livewire.expense.expense-create');
        // Carregar com Layout personalizado
        // return view('livewire.expense.expense-create')->layout('ok');
    }
}
