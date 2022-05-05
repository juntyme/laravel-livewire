<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseCreate extends Component
{
    use WithFileUploads;

    public $amount = '0.00';
    public $type;
    public $description;
    public $photo;
    public $expenseDate;

    protected $rules = [
        'amount' => 'required',
        'type' => 'required',
        'description' => 'required',
        'photo' => 'image|nullable'
    ];

    public function createExpense()
    {
        // Validação
        $this->validate();

        if ($this->photo) {
            $this->photo =  $this->photo->store('expenses-photos', 'public');
        }

        auth()->user()->expenses()->create([
            'amount' => $this->amount,
            'type' => $this->type,
            'description' => $this->description,
            'user_id' => 1,
            'photo' => $this->photo ?? null,
            'expense_date' => $this->expenseDate
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
