<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Http\Livewire\Components\Button;
use App\Http\Livewire\Traits\WithDatatable;
use Livewire\Component;
use App\Services\SessionService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;


class FakebalanceTable extends Component
{
    use WithDatatable, WithPagination;

    public $entity;
    public $pageTitle;
    public $icon = 'fas fa-list';
    public $searchFieldsLabel = 'Código ou Descrição';
    public $hasForm = true;
    public $formModalEmitMethod = 'showFakebalanceFormModal';
    public $formType = 'modal';

    public $headerColumns = [
        ['field' => 'id', 'label' => 'Código', 'css' => 'text-center w-10'],
        ['field' => 'description', 'label' => 'Descrição', 'css' => 'w-80'],
        ['field' => null, 'label' => 'Ações', 'css' => 'text-center'],
    ];

    public $bodyColumns = [
        ['field' => 'id', 'type' => 'string', 'css' => 'text-center'],
        ['field' => 'description', 'type' => 'string', 'css' => 'pl-12px'],
    ];

    protected $repositoryClass = 'App\Repositories\FakebalanceRepository';

    public function mount()
    {
        $this->entity = 'fakebalance';
        $this->pageTitle = 'Saldo do Estoque';

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

        return view('livewire.fakebalance-table', compact('data', 'buttons'));
    }
}
