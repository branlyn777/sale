
<!-- Required Js -->
<script src="{{ asset('template/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('template/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('template/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('template/js/config.js') }}"></script>
<script src="{{ asset('template/js/pcoded.js') }}"></script>

<!-- SweetAlert -->
<script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>

{{-- Metodo para confirmar a travez de una alerta --}}

<script>
    function confirm(id, title, text, icon, confirmButtonText)
    {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButtonText,
            cancelButtonText: 'No, cancelar',
            reverseButtons: true,
            }).then((result) => {
            if (result.isConfirmed)
            {
                window.livewire.emit('delete', id)
                Swal.close()
            }
        })
    }
</script>

@livewireScripts