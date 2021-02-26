<?php
$stat;
switch (connection_status()) {
    case CONNECTION_NORMAL:
        $stat = 'true';
        break;
    case CONNECTION_ABORTED:
        $stat = 'false';
        break;
    case CONNECTION_TIMEOUT:
        $stat = 'false';
        break;
    case (CONNECTION_ABORTED & CONNECTION_TIMEOUT):
        $stat = 'false';
        break;
    default:
        $stat = 'false';
        break;
}
if ($stat == "true") :
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<?php
else :
?>
    Wla
<?php
endif;
?>