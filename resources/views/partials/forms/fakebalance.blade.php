<div class="row">
    @include('partials.inputs.text', [
    'columnSize' => 12,
    'label' => 'Descrição do Produto*',
    'model' => 'description',
    ])
</div>
<div class="row">
    @include('partials.inputs.number', [
    'columnSize' => 12,
    'label' => 'Saldo Anterior do Estoque',
    'model' => 'previousBalance',
    ])
</div>
<div class="row">
    @include('partials.inputs.number', [
    'columnSize' => 12,
    'label' => 'Entradas',
    'model' => 'entries',
    ])
</div>
<div class="row">
    @include('partials.inputs.number', [
    'columnSize' => 12,
    'label' => 'Saídas Balcão',
    'model' => 'outputs',
    ])
</div>
<div class="row">
    @include('partials.inputs.number', [
    'columnSize' => 12,
    'label' => 'Estoque Atual',
    'model' => 'currentStock',
    ])
</div>
<div class="row">
    @include('partials.inputs.number', [
    'columnSize' => 12,
    'label' => 'Vendas (Manual)',
    'model' => 'manualSales',
    ])
</div>
<div class="row">
    @include('partials.inputs.number', [
    'columnSize' => 12,
    'label' => 'Saldo Balcão',
    'model' => 'counterBalance',
    ])
</div>
<p><small>*campos obrigatórios</small></p>
