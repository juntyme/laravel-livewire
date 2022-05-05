<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseEdit extends Component
{
    // Carregar o Objeto
    public Expense $expense;

    public $description;
    public $amount;
    public $type;

    // Validações
    protected $rules = [
        'amount' => 'required',
        'type' => 'required',
        'description' => 'required'
    ];

    // Monta o Componente parecido com construct
    public function mount(/*Expense $expense*/)
    {
        $this->description = $this->expense->description;
        $this->amount = $this->expense->amount;
        $this->type = $this->expense->type;
    }

    public function updateExpense()
    {
        $this->validate();

        $this->expense->update([
            'amount' => $this->amount,
            'type' => $this->type,
            'description' => $this->description
        ]);

        session()->flash('message', 'Registro Atualizado com Sucesso!');
    }

    public function render()
    {
        return view('livewire.expense.expense-edit');
    }
}
