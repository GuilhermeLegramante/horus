<?php

namespace App\Http\Livewire;

use App;
use App\Http\Livewire\Traits\Selects\WithProductSelect;
use App\Http\Livewire\Traits\WithForm;
use App\Http\Livewire\Traits\WithTabs;
use App\Services\Mask;
use Exception;
use Livewire\Component;

class EntryFormModal extends Component
{
    use WithForm, WithProductSelect, WithTabs;

    public $entity;
    public $pageTitle;
    public $icon = 'fas fa-list';
    public $method = 'store';
    public $formTitle;

    protected $repositoryClass = 'App\Repositories\EntryRepository';

    public $note;
    public $value = 0;
    public $quantity = 1;
    public $totalValue = 0;

    public $products = [];
    public $hideFooter = true;
    public $totalItemsValue = 0;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'products', 'edit' => true],
    ];

    protected $listeners = [
        'showEntryFormModal',
        'selectProduct',
    ];

    protected $validationAttributes = [
        'note' => 'Observação',
        'productId' => 'Produto',
        'quantity' => 'Quantidade',
    ];

    public function rules()
    {
        return [
            'productId' => ['required'],
            'quantity' => ['required'],
        ];
    }

    public function showEntryFormModal($id = null)
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
        $this->formTitle = strtoupper('DADOS DO(A) Entrada de Produto');
        $this->entity = 'entry';
        $this->pageTitle = 'Entrada de Produto';

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

        $this->note = $data->note;
    }

    public function customValidate()
    {
        if (count($this->products) == 0) {
            throw new Exception('Inclua ao menos 1 produto para finalizar a ação.');
        }
        return true;
    }

    public function customDeleteValidate()
    {
        return true;
    }

    public function addProduct()
    {
        $this->validate();

        $product = [];

        $product['id'] = $this->productId;
        $product['description'] = $this->productDescription;
        $product['value'] = Mask::money($this->value);
        $product['quantity'] = $this->quantity;
        $product['totalValue'] = Mask::money($this->value * $this->quantity);
        $product['note'] = $this->note;

        array_push($this->products, $product);

        $this->calcTotalProducts();

        // $this->reset('productId');
        // $this->reset('value');
        // $this->reset('quantity');
        // $this->reset('totalValue');
        // $this->reset('productDescription');
        // $this->reset('note');

        // $this->resetValidation();
    }

    public function deleteProduct($key)
    {
        unset($this->products[$key]);
        $this->calcTotalProducts();
    }

    public function calcTotalProducts()
    {
        $this->totalItemsValue = 0;
        foreach ($this->products as $product) {
            $value = Mask::removeMoneyMask($product['value']);
            $this->totalItemsValue = $this->totalItemsValue + ($value * $product['quantity']);
        }

        $this->totalItemsValue = Mask::money($this->totalItemsValue);
    }

    public function render()
    {
        return view('livewire.entry-form-modal');
    }
}
