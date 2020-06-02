<?php
if (!defined('WEB_ROOT')) {
    exit;
}
$simpanan = AppKatalog::getAllRowsWithStatus('tb_simpanan',1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="form-row align-items-center">
              <div class="col-auto">
                <h4 class="mr-4">Periode</h4>
              </div>
              <div class="col-auto">
                <label class="sr-only" for="tawal-laporan_simpanan">Tanggal</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Tanggal</div>
                  </div>
                  <input type="text" class="form-control input-tanggal" id="tawal-laporan_simpanan" name="tawal-laporan_simpanan" value="<?php echo $tglnow;?>" data-zdp_readonly_element="false">
                </div>
              </div>
              <div class="col-auto">
                <label class="sr-only" for="takhir-laporan_simpanan">S.D</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">S.D</div>
                  </div>
                  <input type="text" class="form-control input-tanggal" id="takhir-laporan_simpanan" name="takhir-laporan_simpanan" value="<?php echo $tglnow;?>" data-zdp_readonly_element="false">
                </div>
              </div>
              <div class="col-auto">
                <button type="button" class="btn btn-info" id="filter-laporan_simpanan">Filter</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-sm" id="tb-laporan_simpanan">
                <thead>
                  <tr>
                    <th class="text-center">Anggota</th>
                    <?php foreach($simpanan as $col){ ?>
                    <th class="text-center">
                      <?php echo $col['nama']; ?>
                    </th>
                    <?php } ?>
                    <th class="text-center">Penarikan</th>
                    <th class="text-center">Total</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Total</th>
                    <?php for($j=0;$j<count($simpanan);$j++){ ?>
                    <th>&nbsp;</th>
                    <?php } ?>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function() {
  let param = 'laporan_simpanan'
  fetch_data(param, today, today)

  $('#filter-' + param).click(function(e) {
    e.preventDefault()
    let awal = $('#tawal-' + param).val()
    let akhir = $('#takhir-' + param).val()
    $('#tb-' + param).DataTable().destroy()
    fetch_data(param, awal, akhir)
  })

  function fetch_data(table, awal, akhir) {
    let judul = 'Laporan Simpanan Anggota per : ' + akhir
    let datatable = $('#tb-' + table).DataTable({
      dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>t<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"p>>',
      autoWidth: false,
      processing: true,
      serverside: true,
      ajax: {
        url: service_url + 's_laporan.php',
        type: 'POST',
        data: {
          token: 'laporan',
          param: table,
          awal: awal,
          akhir: akhir
        }
      },
      scrollCollapse: true,
      paginationType: "full_numbers",
      lengthMenu: [
        [10, 25, 50, 100],
        [10, 25, 50, 100]
      ],
      columnDefs: [
        { className: "text-left pl-4", targets: 0 },
        { className: "text-right pr-4", targets: "_all" },
      ],
      language: {
        "search": "Cari: ",
        "paginate": {
          "first": "Awal ",
          "last": "Akhir ",
          "previous": "<<",
          "next": ">>",
        },
        "lengthMenu": " _MENU_ baris "
      },
      buttons: [{
          extend: 'excelHtml5',
          className: 'btn-success',
          text: '<i class="fa fa-file-excel"></i> EXCEL',
          footer: true,
          title: function() {
            return judul
          },
          exportOptions: {
            modifier: {
              page: 'current',
            }
          },
        },
        {
          extend: 'pdfHtml5',
          className: 'btn-danger',
          footer: true,
          title: function() {
            return judul
          },
          text: '<i class="fa fa-file-pdf"></i> PDF',
          exportOptions: {
            modifier: {
              page: 'current',
            }
          },
        },
        {
          extend: 'print',
          footer: true,
          autoPrint: true,
          text: '<i class="fa fa-print"></i> PRINT',
          title: '',
          exportOptions: {
            modifier: {
              page: 'current',
            }
          },
          customize: function(win) {
            $(win.document.body)
              .css('font-size', '10pt')
              .prepend('<h5 class="text-center">' + judul + '</h5>');
            $(win.document.body).find('table')
              .addClass('compact')
              .css('font-size', 'inherit');
          }
        },
      ],
      footerCallback: function(row, data, start, end, display) {
        var api = this.api(),
          data;
        var colNumber = api.columns()[0];
        var intVal = function(i) {
          return typeof i === 'string' ?
            i.replace(/[, ₹]|(\.\d{2})/g, '') * 1 :
            typeof i === 'number' ?
            i : 0;
        };
        for (i = 1; i < colNumber.length; i++) {
          var colNo = colNumber[i];
          var total2 = api
            .column(colNo, { page: 'current' })
            .data()
            .reduce(function(a, b) {
              return intVal(a) + intVal(b);
            }, 0);
          $(api.column(colNo).footer()).html(formatCurrency(total2));
        }
      },
    })
  }
})
</script>