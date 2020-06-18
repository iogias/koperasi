<?php
if (!defined('WEB_ROOT')) {
    exit;
}
$pinjaman = AppKatalog::getAllRowsWithStatus('tb_pinjaman',1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card bg-gradient-light">
          <div class="card-header border-0 mb-4">
            <h3 class="card-title">
              <i class="fas fa-th mr-2"></i>Tabel Pinjaman Anggota
            </h3>
            <div class="card-tools">
              <div class="input-group">
                <label for="jpinjaman" class="mr-2 pt-1">Jenis Pinjaman</label>
                <select name="jpinjaman" id="jpinjaman" class="form-control-plaintext p-1 m-0">
                  <?php foreach($pinjaman as $row){ ?>
                  <option value="<?php echo $row['id'];?>">
                    <?php echo $row['nama']; ?>
                  </option>
                  <?php } ?>
                </select>
                <label for="tawal-laporan_pinjaman" class="ml-4 mr-3 pt-1">Tanggal</label>
                <input type="text" class="form-control-plaintext p-1 input-tanggal border-bottom" id="tawal-laporan_pinjaman" name="tawal-laporan_pinjaman" value="<?php echo $tglnow;?>" data-zdp_readonly_element="false">
                <label for="tawal-laporan_pinjaman" class="mr-3 ml-3 pt-1">s.d</label>
                <input type="text" class="form-control-plaintext p-1 input-tanggal border-bottom" id="takhir-laporan_pinjaman" name="takhir-laporan_pinjaman" value="<?php echo $tglnow;?>" data-zdp_readonly_element="false">
                <button type="button" class="btn btn-info btn-sm ml-3" id="filter-laporan_pinjaman"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-sm" id="tb-laporan_pinjaman">
                <thead>
                  <tr>
                    <th class="text-center">Anggota</th>
                    <th class="text-center">No.Kontrak</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Tgl.Pinjam</th>
                    <th class="text-center">Pokok</th>
                    <th class="text-center">Bunga</th>
                    <th class="text-center">Total Pinjaman</th>
                    <th class="text-center">Bayar Pokok</th>
                    <th class="text-center">Bayar Bunga</th>
                    <th class="text-center">Tenor</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Total</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
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
  let param = 'laporan_pinjaman'
  let jp = '1'
  fetch_data(param, jp, today, today)

  $('#filter-' + param).click(function(e) {
    e.preventDefault()
    let awal = $('#tawal-' + param).val()
    let akhir = $('#takhir-' + param).val()
    let jp = $('#jpinjaman').val()
    $('#tb-' + param).DataTable().destroy()
    fetch_data(param, jp, awal, akhir)
  })

  function fetch_data(table, arg, awal, akhir) {
    $.ajax({
      url: service_url + 's_laporan.php',
      method: 'POST',
      dataType: 'json',
      data: {
        token: 'laporan',
        param: table,
        awal: awal,
        akhir: akhir,
        jpinjaman: arg
      }
    }).done(function(data) {
      let judul = 'Laporan Pinjaman Anggota per : ' + awal + 's.d' + akhir
      let datatable = $('#tb-' + table).DataTable({
        dom: '<"row"<"col-sm-12 col-md-6 pl-2"B><"col-sm-12 col-md-6 pr-2"f>>t<"row"<"col-sm-12 col-md-6 p-2"l><"col-sm-12 col-md-6 p-2 "p>>',
        aaData: data,
        autoWidth: false,
        processing: true,
        serverside: true,
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
        columns: [{
            "data": "anggota",
            "class": "pl-3",
            "render": function(data, type, row) {
              return row.salut + "&nbsp;" + data
            },
          },
          { "data": "nomor_kontrak", "class": "text-center", },
          {
            "data": "status",
            "class": "text-center",
            "render": function(data, type, row) {
              return kreditBadge(data)
            },
          },
          {
            "data": "tanggal",
            "class": "text-center",
            "render": function(data, type, row) {
              return formatDmy(data)
            },
          },
          {
            "data": "pokok",
            "class": "text-right pr-4",
            "render": function(data, type, row) {
              return formatCurrency(data)
            },
          },
          {
            "data": "bunga_rupiah",
            "class": "text-right pr-4",
            "render": function(data, type, row) {
              return formatCurrency(data)
            },
          },
          {
            "data": "total_pinjaman",
            "class": "text-right pr-4",
            "render": function(data, type, row) {
              return formatCurrency(data)
            },
          },
          {
            "data": "bayar_pokok",
            "class": "text-right pr-4",
            "render": function(data, type, row) {
              return formatCurrency(data)
            },
          },
          {
            "data": "bayar_bunga",
            "class": "text-right pr-4",
            "render": function(data, type, row) {
              return formatCurrency(data)
            },
          },
          { "data": "tenor", "class": "text-center", },

        ],
        buttons: [{
            extend: 'excelHtml5',
            className: 'btn-success',
            text: '<i class="fa fa-file-excel"></i> EXCEL',
            footer: true,
            title: function() {
              return judul
            },
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
              modifier: {
                page: 'current',
              }
            },
          },
          {
            extend: 'pdfHtml5',
            className: 'btn-danger',
            text: '<i class="fa fa-file-pdf"></i> PDF',
            footer: true,
            title: function() {
              return judul
            },
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
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
              columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
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
          var colNumber = [3, 4, 5, 6, 7, 8, ];
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
    })
  }
})
</script>