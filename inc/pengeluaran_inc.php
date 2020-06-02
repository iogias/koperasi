<?php
if (!defined('WEB_ROOT')) {
    exit;
}
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-7">
        <div class="card bg-gradient-light">
          <div class="card-header border-0 mb-4">
            <h3 class="card-title">
              <i class="fas fa-th mr-2"></i>Tabel Anggota
            </h3>
            <div class="card-tools">
              <div class="input-group">
                <label for="tawal-pengeluaran" class="mr-3 pt-1">Tanggal</label>
                <input type="text" class="form-control-plaintext p-1 input-tanggal border-bottom" id="tawal-pengeluaran" name="tawal-pengeluaran" value="<?php echo $tglnow;?>" data-zdp_readonly_element="false">
                <label for="tawal-pengeluaran" class="mr-3 ml-3 pt-1">s.d</label>
                <input type="text" class="form-control-plaintext p-1 input-tanggal border-bottom" id="takhir-pengeluaran" name="takhir-pengeluaran" value="<?php echo $tglnow;?>" data-zdp_readonly_element="false">
                <button type="button" class="btn btn-info btn-sm ml-3" id="filter-pengeluaran"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-sm" id="tb-pengeluaran">
                <thead class="text-center">
                  <tr>
                    <th width="20%">Tanggal</th>
                    <th>Nama</th>
                    <th class="text-center">Nominal</th>
                    <th width="15%">&nbsp;</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr>
                    <th>&nbsp;</th>
                    <th>Total</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-file-alt mr-2"></i>Form Pengeluaran
            </h3>
            <div class="card-tools">
              <button title="Tambah Pinjaman" class="btn btn-primary btn-tambah" id="tambah-pengeluaran">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form class="form-horizontal" id="f-pengeluaran" name="f-pengeluaran" autocomplete="off">
              <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input type="hidden" id="id-pengeluaran" name="id-pengeluaran">
                  <input type="text" class="form-control form-pengeluaran" id="nama" name="nama" minlength="2" maxlength="80" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="tgl-pengeluaran" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-5">
                  <input value="<?php echo $tglnow;?>" type="text" class="input-tanggal form-control form-pengeluaran" id="tgl-pengeluaran" name="tgl-pengeluaran" data-zdp_readonly_element="false">
                </div>
              </div>
              <div class="form-group row">
                <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                <div class="col-sm-5">
                  <input type="text" class="format-uang form-control form-pengeluaran" id="nominal" name="nominal" minlength="2" maxlength="80" required>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-success btn-form" id="update-pengeluaran">
              <i class="fas fa-check mr-2"></i>UPDATE
            </button>
            <button type="button" class="btn btn-info btn-form" id="simpan-pengeluaran">
              <i class="fas fa-save mr-2"></i>SIMPAN
            </button>
            <button type="button" class="btn btn-secondary btn-batal" id="batal-pengeluaran">
              <i class="fas fa-times mr-2"></i>BATAL
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function() {
  let param = 'pengeluaran'

  disable_form(param)
  fetch_data(param, today, today)

  $('#filter-' + param).click(function(e) {
    e.preventDefault()
    let awal = $('#tawal-' + param).val()
    let akhir = $('#takhir-' + param).val()
    $('#tb-' + param).DataTable().destroy()
    fetch_data(param, awal, akhir)
  })

  $(document).on('click', '.btn-edit', function(e) {
    e.preventDefault()
    let idx = $(this).attr('id').split('-')
    if (idx[0] == param) {
      enable_form(param, 'edit')
      $.post(service_url + 's_edit.php', {
        token: 'edit',
        param: param,
        data: idx[1]
      }, function(data) {
        if (data.status == true) {
          $('#id-' + param).val(data.row.id)
          $('#nama').val(data.row.nama)
          $('#tgl-pengeluaran').val(formatDmy(data.row.tanggal))
          $('#nominal').val(formatCurrency(data.row.nominal))
        }
      }, 'json')
    }
  })

  function fetch_data(table, awal, akhir) {
    $.ajax({
      url: service_url + 's_katalog.php',
      method: 'POST',
      dataType: 'json',
      data: {
        token: 'date',
        param: table,
        awal: awal,
        akhir: akhir
      }
    }).done(function(data) {
      let judul = 'Pengeluaran Periode : ' + awal + ' s.d ' + akhir
      let tb = $('#tb-' + table).DataTable({
        dom: '<"row"<"col-sm-12 col-md-6 pl-2"B><"col-sm-12 col-md-6 pr-2"f>>t<"row"<"col-sm-12 col-md-6 p-2"l><"col-sm-12 col-md-6 p-2 "p>>',
        aaData: data,
        processing: true,
        autoWidth: false,
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
            "previous": "",
            "next": "",
          },
          "lengthMenu": " _MENU_ baris "
        },
        columns: [{
            "data": "tanggal",
            "class": "text-center",
            "render": function(data, type, row) {
              return formatDmy(data)
            },
          },
          { "data": "nama" },
          {
            "data": "nominal",
            "class": "text-right pr-4",
            "render": function(data, type, row) {
              return formatCurrency(data)
            },
          },
          {
            "data": "id",
            "class": "text-center",
            "render": function(data, type, row) {
              return actionBtn2(table, data)
            },
          },
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
              columns: [0, 1, 2, ],
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
              columns: [0, 1, 2, ],
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
              columns: [0, 1, 2, ],
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
          var colNumber = [2];
          var intVal = function(i) {
            return typeof i === 'string' ?
              i.replace(/[, ₹]|(\.\d{2})/g, "") * 1 :
              typeof i === 'number' ?
              i : 0;
          };
          for (i = 0; i < colNumber.length; i++) {
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