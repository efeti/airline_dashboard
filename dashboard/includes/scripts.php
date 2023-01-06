<!-- Scripts Start -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
<script src="<?php echo DASHBOARD_URL ?>/js/script.js"></script>
<script src="<?php echo DASHBOARD_URL ?>/js/dark-mode-switch.min.js"></script>
<script src="<?php echo DASHBOARD_URL ?>/js/login.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.1/datatables.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        if ($('#airplane').length) {
            console.log('here');
            $('#airplane').DataTable({
                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                    $(nRow).attr('id', aData[0]);
                },
                'serverSide': true,
                'processing': true,
                'paging': false,
                'info': false,
                'ordering': false,
                'order': [],

                'ajax': {
                    'url': '<?php echo DASHBOARD_URL ?>/fetch_data.php',
                    'type': 'post',
                },
                'fnCreateRow': function(nRow, aData, iDataIndex) {
                    $(nRow).attr('id', aData[0]);
                },
                'columnDefs': [{
                    'target': [0, 5],
                    'orderable': false,
                }]
            });
        }
    });
</script>

<script>
    function pop_flash_message() {
        let message = localStorage.getItem('flash_message');
        localStorage.removeItem('flash_message');
        return message;
    }

    function should_flash($message) {
        localStorage.setItem('flash_message', $message);
    }

    (function($) {
        $(function() {
            //check if flash message
            let flash_messaage = pop_flash_message();
            if (flash_messaage && $('#flash-box').length) {
                $('#flash-box').html(flash_messaage);
            }
        });
    })(jQuery)
</script>


<!-- Scripts End -->