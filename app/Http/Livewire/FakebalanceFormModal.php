<?php

namespace App\Http\Livewire;

use App;
use App\Http\Livewire\Traits\WithForm;
use Livewire\Component;

class FakebalanceFormModal extends Component
{
    use WithForm;

    public $entity;
    public $pageTitle;
    public $icon = 'fas fa-list';
    public $method = 'store';
    public $formTitle;

    protected $repositoryClass = 'App\Repositories\FakebalanceRepository';

    public $description;
    public $previousBalance;
    public $entries;
    public $outputs;
    public $currentStock;
    public $manualSales;
    public $counterBalance;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'description', 'edit' => true, 'type' => 'string'],
        ['field' => 'previousBalance', 'edit' => true, 'type' => 'number'],
        ['field' => 'entries', 'edit' => true, 'type' => 'number'],
        ['field' => 'outputs', 'edit' => true, 'type' => 'number'],
        ['field' => 'currentStock', 'edit' => true, 'type' => 'number'],
        ['field' => 'manualSales', 'edit' => true, 'type' => 'number'],
        ['field' => 'counterBalance', 'edit' => true, 'type' => 'number'],
    ];

    protected $listeners = [
        'showFakebalanceFormModal',
    ];

    protected $validationAttributes = [
        'description' => 'Descrição do Produto',
    ];

    public function rules()
    {
        return [
            'description' => ['required'],
        ];
    }

    public function showFakebalanceFormModal($id = null)
    {
        if (isset($id)) {
            $this->method = 'update';

            $this->isEdition = true;

            $repository = App::make($this->repositoryClass);

            $data = $repository->findById($id);

            if (isset($data)) {
                $this->setFields($data);
            }
        }
    }

    public function mount($id = null)
    {
        $this->formTitle = strtoupper('DADOS DO(A) Saldo do Estoque');
        $this->entity = 'fakebalance';
        $this->pageTitle = 'Saldo do Estoque';

        if (isset($id)) {
            $this->method = 'update';

            $this->isEdition = true;

            $repository = App::make($this->repositoryClass);

            $data = $repository->findById($id);

            if (isset($data)) {
                $this->setFields($data);
            }
        }
    }

    public function setFields($data)
    {
        $this->recordId = $data->id;

        $this->description = $data->description;
        $this->previousBalance = $data->previousBalance;
        $this->entries = $data->entries;
        $this->outputs = $data->outputs;
        $this->currentStock = $data->currentStock;
        $this->manualSales = $data->manualSales;
        $this->counterBalance = $data->counterBalance;
    }

    public function customValidate()
    {
        return true;
    }

    public function customDeleteValidate()
    {
        return true;
    }

    public function render()
    {
        return view('livewire.fakebalance-form-modal');
    }
}
