{{-- Jquery --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="{{ asset('jquery.js') }}"></script>
{{-- JS assets --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sidebar_toggle.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script> --}}
{{-- <script src="{{ asset('js/chart.js') }}"></script> --}}
{{-- <script src="{{ asset('js/assets/charts/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/assets/charts/chart-bar-demo.js') }}"></script> --}}
<script src="{{ asset('js/simple-datatables.js') }}"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
{{-- select2 --}}
<script src="{{ asset('js/select2.min.js') }}"></script>
{{-- sweet alert 2 --}}
<script src="{{ asset('js/sweetalert2.js') }}"></script>
{{-- data table --}}

{{-- flatpicker --}}
<script src="{{ asset('js/flatpickr.js') }}"></script>

{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script> --}}
<script>
    // $(document).ready(function(){
    flatpickr('.date_picker', {
        dateFormat: 'd-m-Y', //'YYYY-MM-DD',
    });
    // });
</script>
