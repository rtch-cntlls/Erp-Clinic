<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: `{{ session('success') }}`,
            confirmButtonColor: '#0d6efd',
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: `{{ session('error') }}`,
            confirmButtonColor: '#dc3545',
        });
    @endif
</script>
