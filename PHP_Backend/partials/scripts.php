 <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>
      <!-- DataTables  & Plugins -->
<script src="assets/DataTables/datatables/jquery.dataTables.min.js"></script>
<script src="assets/DataTables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/DataTables/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/DataTables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/DataTables/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/DataTables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/DataTables/jszip/jszip.min.js"></script>
<script src="assets/DataTables/pdfmake/pdfmake.min.js"></script>
<script src="assets/DataTables/pdfmake/vfs_fonts.js"></script>
<script src="assets/DataTables/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/DataTables/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/DataTables/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
$(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded',()=>{
const modals = document.querySelectorAll('.modal');
modals.forEach(modal => {
  modal.addEventListener('show.bs.modal',event =>{
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const targetInputId = modal.getAttribute('data-target-input');
    if(targetInputId){
      const input = modal.querySelector(`#${targetInputId}`);
      if(input) input.value=id;
    }
  });
});
  });
</script>