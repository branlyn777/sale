<div class="pc-content">
  <div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-xl-4 col-md-6">
      <div class="card bg-primary-dark dashnum-card text-white overflow-hidden">
        <span class="round small"></span>
        <span class="round big"></span>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="avtar avtar-lg">
                <i class="text-white ti ti-credit-card"></i>
              </div>
            </div>
            <div class="col-auto">
              <div class="btn-group">
                <a
                  type="button"
                  class="avtar bg-primary dropdown-toggle arrow-none"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="ti ti-dots"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><button class="dropdown-item" type="button">Import Card</button></li>
                  <li><button class="dropdown-item" type="button">Export</button></li>
                </ul>
              </div>
            </div>
          </div>
          <span class="text-white d-block f-34 f-w-500 my-2">1350 <i class="ti ti-arrow-up-right-circle opacity-50"></i></span>
          <p class="mb-0 opacity-50">Total Ventas</p>
        </div>
      </div>
    </div>
    <!-- [ sample-page ] end -->
</div>
</div>

  @section('javascript')
    <!-- Apex Chart -->
    <script src="template/js/plugins/apexcharts.min.js"></script>
    <script src="template/js/pages/dashboard-default.js"></script>
    <!-- [Page Specific JS] end -->
  @endsection