<div>
    @include('pages.datatable')

    @livewire('fakebalance-form-modal')
</div>
@push('scripts')
<script>
    window.livewire.on('showFakebalanceFormModal', () => {
        $('#fakebalance-form-modal').modal('show');
    });

    window.livewire.on('hideFakebalanceFormModal', () => {
        $('#fakebalance-form-modal').modal('hide');
    });

    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });
</script>
@endpush
