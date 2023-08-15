<div>
    @include('partials.modals.form')

    @livewire('product-select')

</div>
@push('scripts')
<script>
    window.livewire.on('hideEntryFormModal', () => {
        $('#{{ $entity }}-form-modal').modal('hide');
    });

    window.livewire.on('showProductSelectModal', () => {
        $('#modal-select-product').modal('show');
        Livewire.emit('productSelectModal');
    });

</script>
@endpush
