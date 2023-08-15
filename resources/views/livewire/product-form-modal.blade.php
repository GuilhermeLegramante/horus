<div>
    @include('partials.modals.form')

    @livewire('measurement-unit-select')
</div>
@push('scripts')

<script>
    window.livewire.on('showMeasurementUnitSelectModal', () => {
        $('#modal-select-measurementUnit').modal('show');
        Livewire.emit('measurementUnitSelectModal');
    });

    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });

</script>

@endpush
