<div>
    @include('pages.datatable')

    @livewire('costcenter-form-modal')
</div>
@push('scripts')
<script>
    window.livewire.on('showCostcenterFormModal', () => {
        $('#costcenter-form-modal').modal('show');
    });

    window.livewire.on('hideCostcenterFormModal', () => {
        $('#costcenter-form-modal').modal('hide');
    });

    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });
</script>
@endpush
