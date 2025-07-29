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

    
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <!-- Buttons Extension JS -->
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

  <!-- JSZip & pdfmake (for Excel/PDF export support) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<!-- Id fetching JS For deleting -->
<script>
  document.addEventListener('DOMContentLoaded', () =>{
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
<!-- Scripts for Datatable Buttons -->
<script>
  $(document).ready(function () {
    $('#dataTable').DataTable({
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'csvHtml5',
          text: 'Export CSV',
          className: 'btn btn-outline-primary me-1'
        },
        {
          extend: 'excelHtml5',
          text: 'Export Excel',
          className: 'btn btn-outline-success me-1'
        },
        {
          extend: 'print',
          text: 'Print',
          className: 'btn  btn-outline-secondary'
        }
      ],
      pageLength: 10,
      lengthChange: false,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search..."
      }
    });
  });
</script>

<!-- Scripts for Fetching Banks Types And Momo Number -->

<script>
  const paymentTypeInput = document.getElementById('paymentType');
  const bankSelectDiv1 = document.getElementById('bank_select');

  paymentTypeInput.addEventListener('input', function () {
    if (this.value.toLowerCase() === 'bank') {
      bankSelectDiv1.style.display = 'block';
    } else {
      bankSelectDiv1.style.display = 'none';
    }
  });

  const paymentType = document.getElementById("paymentType");
  const bankSelectDiv2 = document.getElementById("bank_select");
  const mtnInputDiv = document.getElementById("mtn_input");

  paymentType.addEventListener("input", function () {
    const value = this.value.trim().toLowerCase();

    bankSelectDiv2.style.display = value === "bank" ? "block" : "none";
    mtnInputDiv.style.display = value === "mtn mobile money" ? "block" : "none";
  });
</script>
