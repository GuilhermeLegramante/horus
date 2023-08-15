<div>
    @include('pages.datatable')

    @livewire('entry-form-modal')
</div>
@push('scripts')
<script>
    window.livewire.on('showEntryFormModal', () => {
        $('#entry-form-modal').modal('show');
    });

    window.livewire.on('hideEntryFormModal', () => {
        $('#entry-form-modal').modal('hide');
    });

    window.livewire.on('scrollTop', () => {
        $(window).scrollTop(0);
    });
</script>
@endpush
