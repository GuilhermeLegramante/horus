<div>
    <ul wire:ignore.self class="nav nav-tabs" role="tablist">
        <li wire:click='setActiveTab(1)' class="nav-item">
            <a class="nav-link {{ ($activeTab == 1) ? 'active' : '' }}" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true"><strong>INCLUIR PRODUTO</strong></a>
        </li>
        <li wire:click='setActiveTab(2)' class="nav-item">
            <a class="nav-link {{ ($activeTab == 2) ? 'active' : '' }}" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false"><strong> LISTA DE PRODUTOS</strong></a>
        </li>
    </ul>
    <div wire:ignore.self class="tab-content p-4" id="custom-content-below-tabContent">
        <div class="tab-pane fade {{ ($activeTab == 1) ? 'active show' : '' }}" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
            <div class="row">
                @include('partials.inputs.select-modal', [
                'columnSize' => 12,
                'label' => 'Produto*',
                'method' => 'showProductSelectModal',
                'model' => 'productId',
                'description' => $productDescription,
                'modelId' => $productId,
                'cleanFields' => 'productId,productDescription',
                ])
            </div>

            <div class="row">
                @include('partials.inputs.number', [
                'columnSize' => 6,
                'label' => 'Quantidade*',
                'model' => 'quantity',
                ])
                @include('partials.inputs.number', [
                'columnSize' => 6,
                'label' => 'Valor Unitário',
                'model' => 'value',
                ])
            </div>
            <div class="row">
                @include('partials.inputs.textarea', [
                'columnSize' => 12,
                'rows' => 3,
                'maxLength' => 5000,
                'label' => 'Observação',
                'model' => 'note',
                ])
            </div>
            <br>

            <p class="mt-3"><small>*campos obrigatórios</small></p>
        </div>
        <div class="tab-pane fade {{ ($activeTab == 2) ? 'active show' : '' }}" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
            <table class="table-bordered table-striped w-100 pd-10px">
                <thead>
                    <tr>
                        <th class="p-1 text-center">Item</th>
                        <th class="p-1 w-40">Descrição</th>
                        <th class="p-1 text-center">Quantidade</th>
                        <th class="p-1 text-right">Valor Unitário</th>
                        <th class="p-1 text-right">Saldo Total</th>
                        <th class="p-1 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $item)
                    <tr>
                        <td class="p-1 align-middle text-center">
                            {{ $key + 1 }}
                        </td>
                        <td class="p-1 align-middle">
                            {{ $item['description'] }}
                        </td>
                        <td class="p-1 align-middle text-center">
                            {{ $item['quantity'] }}
                        </td>
                        <td class="p-1 align-middle text-right">
                            {{ $item['value'] }}
                        </td>
                        <td class="p-1 align-middle text-right">
                            {{ number_format(number_format(str_replace(',', '.', str_replace('.', '', $item['value'])), 2, '.', '') * $item['quantity'],2,',','.') }}
                        </td>
                        <td class="align-middle text-center">
                            <div class="input-group ml-3">
                                <button title="Remover Item" wire:click="deleteProduct({{ $key }})" class="btn btn-danger btn-xs mr-1">
                                    <i class="fas fa-trash-alt"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="align-middle text-right pr-12px">
                            <strong>VALOR TOTAL DA ENTRADA</strong>
                        </td>
                        <td class="align-middle text-right">
                            <strong>{{ $totalItemsValue }}</strong>
                        </td>
                        <td class="align-middle">
                        </td>
                    </tr>
            </table>

        </div>
        <div class="modal-footer">
            @if($activeTab == 1)
            <a href="" data-dismiss="modal" class="btn btn-outline-primary btn-sm" wire:loading.class="disabled">
                <i class="fas fa-times" aria-hidden="true"></i>
                <strong> CANCELAR &nbsp;</strong>
            </a>
            <button wire:click.prevent="addProduct()" wire:key="" type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-sm">
                <strong> ADICIONAR PRODUTO À LISTA &nbsp;</strong>
                <i class="fas fa-plus" aria-hidden="true"></i>
            </button>
            @else
            <a href="" data-dismiss="modal" class="btn btn-outline-primary btn-sm" wire:loading.class="disabled">
                <i class="fas fa-times" aria-hidden="true"></i>
                <strong> CANCELAR &nbsp;</strong>
            </a>
            <button wire:click.prevent="{{ $isEdition == null ? 'store' : 'update' }}" wire:key="{{ $isEdition ? 'store' : 'update' }}" type="submit" wire:loading.attr="disabled" class="btn btn-primary btn-sm">
                <strong> FINALIZAR INCLUSÃO &nbsp;</strong>
                <i class="fas fa-save" aria-hidden="true"></i>
            </button>
            @endif
        </div>
    </div>
</div>
