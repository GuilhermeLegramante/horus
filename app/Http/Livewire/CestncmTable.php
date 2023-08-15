<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Components\Button;
use App\Http\Livewire\Traits\WithDatatable;
use App\Services\SessionService;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class CestncmTable extends Component
{
    use WithDatatable, WithPagination;

    public $entity;
    public $pageTitle;
    public $icon = 'fas fa-list';
    public $searchFieldsLabel = 'Código ou Descrição';
    public $hasForm = true;
    public $formModalEmitMethod = 'showCestncmFormModal';
    public $formType = 'modal';

    public $headerColumns = [
        ['field' => 'id', 'label' => 'Código', 'css' => 'text-center w-10'],
        ['field' => 'cest', 'label' => 'CEST', 'css' => 'text-center w-10'],
        ['field' => 'ncm', 'label' => 'NCM', 'css' => 'text-center w-10'],
        ['field' => 'description', 'label' => 'Descrição', 'css' => 'w-80'],
        ['field' => null, 'label' => 'Ações', 'css' => 'text-center'],
    ];

    public $bodyColumns = [
        ['field' => 'id', 'type' => 'string', 'css' => 'text-center'],
        ['field' => 'cest', 'type' => 'string', 'css' => 'text-center'],
        ['field' => 'ncm', 'type' => 'string', 'css' => 'text-center'],
        ['field' => 'description', 'type' => 'string', 'css' => 'pl-12px'],
    ];

    protected $repositoryClass = 'App\Repositories\CestncmRepository';

    public function mount()
    {
        $this->entity = 'cestncm';
        $this->pageTitle = 'CEST/NCM';

        SessionService::start();
    }

    public function rowButtons(): array
    {
        return [
            Button::create('Selecionar')
                ->method('showForm')
                ->class('btn-primary')
                ->icon('fas fa-search'),
        ];
    }

    public function render()
    {
        $repository = App::make($this->repositoryClass);

        $data = $repository->all($this->search, $this->sortBy, $this->sortDirection, $this->perPage);

        if ($data->total() == $data->lastItem()) {
            $this->emit('scrollTop');
        }

        $buttons = $this->rowButtons();

        return view('livewire.cestncm-table', compact('data', 'buttons'));
    }
}