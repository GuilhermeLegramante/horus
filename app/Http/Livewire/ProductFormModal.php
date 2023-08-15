<?php

namespace App\Http\Livewire;

use App;
use App\Http\Livewire\Traits\Selects\WithMeasurementUnitSelect;
use App\Http\Livewire\Traits\WithForm;
use App\Repositories\ProductRepository;
use App\Services\ArrayHandler;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductFormModal extends Component
{
    use WithForm,
    WithMeasurementUnitSelect,
        WithFileUploads;

    public $entity;
    public $pageTitle;
    public $icon = 'fas fa-barcode';
    public $method = 'store';
    public $formTitle;

    protected $repositoryClass = 'App\Repositories\ProductRepository';

    public $description;
    public $code;
    public $barcode;
    public $weight;
    public $storedFiles = [];
    public $costPrice;
    public $tag;
    public $tags = [];

    public $product = [];

    public $activeTab = 1;

    public $images = [];

    // Controle do campo input:file que não limpa o cache sozinho
    public $iteration = 1;

    protected $inputs = [
        ['field' => 'recordId', 'edit' => true],
        ['field' => 'description', 'edit' => true, 'type' => 'string'],
        ['field' => 'measurementUnitId', 'edit' => true],
        ['field' => 'code', 'edit' => true, 'type' => 'string'],
        ['field' => 'barcode', 'edit' => true, 'type' => 'string'],
        ['field' => 'weight', 'edit' => true],
        ['field' => 'images', 'edit' => true, 'type' => 'file'],
        ['field' => 'storedFiles', 'edit' => true],
        ['field' => 'tags', 'edit' => true],
    ];

    protected $listeners = [
        'showProductFormModal',
        'selectMeasurementUnit',
    ];

    protected $validationAttributes = [
        'description' => 'Descrição',
        'code' => 'Código',
        'barcode' => 'Código de Barras',
        'measurementUnit' => 'Unidade de Medida',
    ];

    public $filter = [];

    public function rules()
    {
        return [
            'description' => ['required'],
        ];
    }

    public function showProductFormModal($id = null)
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
        $this->formTitle = strtoupper('DADOS DO(A) ' . 'Produto');
        $this->entity = 'product';
        $this->pageTitle = 'Produto';

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
        $this->code = $data->code;
        $this->barcode = $data->barcode;
        $this->weight = $data->weight;
        $this->storedFiles = ArrayHandler::jsonDecodeEncode($data->images);

        if (isset($data->measurementUnitId)) {
            $this->selectMeasurementUnit($data->measurementUnitId);
        }

        $repository = new ProductRepository();

        $this->product = ArrayHandler::jsonDecodeEncode($repository->findById($data->id));

        if (isset($data->tags)) {
            foreach ($data->tags as $value) {
                array_push($this->tags, $value->tag);
            }
        }
    }

    public function deleteFile($imageId)
    {
        $repository = new ProductRepository();

        $repository->deleteImage($imageId);

        $repository = new ProductRepository();
        $product = $repository->findById($this->recordId);
        $this->product = ArrayHandler::jsonDecodeEncode($product);

        $this->storedFiles = ArrayHandler::jsonDecodeEncode($product->images);
    }

    public function updatedTag()
    {
        array_push($this->tags, $this->tag);
        $this->tag = '';
    }

    public function removeTag($key)
    {
        unset($this->tags[$key]);
    }

    public function customValidate()
    {
        return true;
    }

    public function customDeleteValidate()
    {
        return true;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updatedBarcode()
    {
        // $this->description = 'TEXAS BURGER GRANEL';

        // $this->selectMeasurementUnit(1);

        // $repository = new ProductRepository();

        // $product = $repository->findById(1);

        // $this->product = ArrayHandler::jsonDecodeEncode($product);

        // $this->storedFiles = ArrayHandler::jsonDecodeEncode($product->images);
    }

    public function render()
    {
        return view('livewire.product-form-modal');
    }
}
