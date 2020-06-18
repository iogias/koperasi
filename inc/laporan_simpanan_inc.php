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
        <div class="card bg-gradient-light">
          <div class="card-header border-0 mb-4">
            <h3 class="card-title">
              <i class="fas fa-th mr-2"></i>Tabel Simpanan Anggota
            </h3>
            <div class="card-tools">
              <div class="input-group">
                <label for="tawal-laporan_simpanan" class="mr-3 pt-1">Tanggal</label>
                <input type="text" class="form-control-plaintext p-1 input-tanggal border-bottom" id="tawal-laporan_simpanan" name="tawal-laporan_simpanan" value="<?php echo $tglnow;?>" data-zdp_readonly_element="false">
                <label for="tawal-laporan_simpanan" class="mr-3 ml-3 pt-1">s.d</label>
                <input type="text" class="form-control-plaintext p-1 input-tanggal border-bottom" id="takhir-laporan_simpanan" name="takhir-laporan_simpanan" value="<?php echo $tglnow;?>" data-zdp_readonly_element="false">
                <button type="button" class="btn btn-info btn-sm ml-3" id="filter-laporan_simpanan"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-sm" id="tb-laporan_simpanan">
                <thead>
                  <tr>
                    <th class="text-center" width="2%">No.</th>
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
                    <th>&nbsp;</th>
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
      dom: '<"row"<"col-sm-12 col-md-6 pl-2"B><"col-sm-12 col-md-6 pr-2"f>>t<"row"<"col-sm-12 col-md-6 p-2"l><"col-sm-12 col-md-6 p-2 "p>>',
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
      columnDefs: [{
          searchable: false,
          orderable: false,
          targets: "_all"
        },
        {
          className: "text-left pl-4",
          targets: 1
        },
        {
          className: "text-center",
          targets: 0
        },
        {
          className: "text-right pr-4",
          targets: "_all"
        },
      ],
      fnCreatedRow: function(row, data, index) {
        $('td', row).eq(0).html(index + 1);
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
        // var colNumber = api.columns()[0];
        var colNumber = [1, 2, 3, 4, 5, 6];
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