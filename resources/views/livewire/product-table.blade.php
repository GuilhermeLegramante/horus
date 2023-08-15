<div>
    @include('pages.datatable')

    @livewire('product-form-modal')

    @livewire('measurement-unit-form-modal')

</div>
@push('scripts')
<script>
    window.livewire.on('showProductFormModal', () => {
        $('#product-form-modal').modal('show');
    });

    window.livewire.on('hideProductFormModal', () => {
        $('#product-form-modal').modal('hide');
    });

    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });

    window.livewire.on('showMeasurementUnitFormModal', () => {
        $('#measurementUnit-form-modal').modal('show');
    })

    window.livewire.on('hideMeasurementUnitFormModal', () => {
        $('measurementUnit-form-modal').modal('hide');
    });

</script>
@endpush
