<!-- jQuery 3 -->
<script src="{{asset('backend/vendor_components/jquery-3.3.1/jquery-3.3.1.js')}}"></script>

<!-- fullscreen -->
<script src="{{asset('backend/vendor_components/screenfull/screenfull.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('backend/vendor_components/jquery-ui/jquery-ui.js')}}"></script>

<!-- popper -->
<script src="{{asset('backend/vendor_components/popper/dist/popper.min.js')}}"></script>

<!-- Bootstrap 4.0-->
<script src="{{asset('backend/vendor_components/bootstrap/dist/js/bootstrap.js')}}"></script>

<!-- toast -->
<script src="{{asset('backend/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js')}}"></script>

<!-- Slimscroll -->
<script src="{{asset('backend/vendor_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<!-- Data Table-->
<script src="{{asset('backend/vendor_components/datatable/datatables.min.js')}}"></script>

<!-- FastClick -->
<script src="{{asset('backend/vendor_components/fastclick/lib/fastclick.js')}}"></script>
<!-- CrmX Admin App -->
<script src="{{asset('backend/js/template.js')}}"></script>
<!-- CrmX Admin for demo purposes -->
{{--<script src="{{asset('backend/js/demo.js')}}"></script>--}}

<script src="{{ asset('js/app.js') }}" defer></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script>
    function warningToast(message, heading = 'Warning') {
        $.toast({
            heading: heading,
            text: message,
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        });
    }

    function successToast(message, heading = 'Success') {
        $.toast({
            heading: heading,
            text: message,
            position: 'top-right',
            loaderBg: '#38c172',
            icon: 'success',
            hideAfter: 3500,
            stack: 6
        });
    }

    function infoToast(message, heading = 'Info') {
        $.toast({
            heading: heading,
            text: message,
            position: 'top-right',
            loaderBg: '#6cb2eb',
            icon: 'info',
            hideAfter: 3500,
            stack: 6
        });
    }

    function primaryToast(message, heading = 'Message') {
        $.toast({
            heading: heading,
            text: message,
            position: 'top-right',
            loaderBg: '#3490dc',
            icon: 'info',
            hideAfter: 3500,
            stack: 6
        });
    }

    function dangerToast(message, heading = 'Danger') {
        $.toast({
            heading: heading,
            text: message,
            position: 'top-right',
            loaderBg: '#e3342f',
            icon: 'danger',
            hideAfter: 3500,
            stack: 6
        });
    }

    let tableConfig = {
        responsive: true,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 5, 10, 25, 50, 100, -1 ],
            [ '5 rows', '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
        ],
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: ['copy', 'excel', 'pdf', 'csv' ]
            },
            'print',
            'pageLength'
        ],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        }
    };

    $('.datatable').DataTable(tableConfig);
</script>

