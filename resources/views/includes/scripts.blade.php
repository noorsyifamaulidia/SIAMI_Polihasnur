@livewireScripts
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('plugins/datepicker3/datepicker3.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<script>
    $(function() {
        $('.select2').select2()
        $('[data-toggle="tooltip"]').tooltip()
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        })
        $('.mypicker').datepicker({
            format: "mm-yyyy",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true,
            todayHighlight: true,
        })
    })
</script>
