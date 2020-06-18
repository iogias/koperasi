<?php
if (!defined('WEB_ROOT')) {
    exit;
}
$simpanan = AppKatalog::getAllRowsWithStatus('tb_simpanan',1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-th mr-2"></i>Tabel Simpanan Anggota
            </h3>
            <div class="card-tools">
              <select name="filter-status" id="status-simpanan_anggota" class="form-control-plaintext filter-status p-1 m-0">
                <option value="99">Jenis Simpanan</option>
                <?php foreach($simpanan as $row){ ?>
                <option value="<?php echo $row['id'];?>">
                  <?php echo $row['nama']; ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-sm" id="tb-simpanan_anggota">
                <thead class="text-center">
                  <tr>
                    <th>Anggota</th>
                    <th>Simpanan</th>
                    <th>Tgl. Setor</th>
                    <th class="text-center">Nominal</th>
                    <th width="12%">&nbsp;</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr>
                    <th colspan="3">Total</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-file-alt mr-2"></i>Form Simpanan Anggota
            </h3>
            <div class="card-tools">
              <button title="Tambah Simpanan Anggota" class="btn btn-primary btn-tambah" id="tambah-simpanan_anggota">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form class="form-horizontal" id="f-simpanan_anggota" name="f-simpanan_anggota" autocomplete="off">
              <div class="form-group row">
                <label for="tgl-setor" class="col-sm-3 col-form-label">Tgl.Setor</label>
                <div class="col-sm-5">
                  <input value="<?php echo $tglnow;?>" type="text" class="input-tanggal form-control form-simpanan_anggota" id="tgl-setor" name="tgl-setor" data-zdp_readonly_element="false">
                </div>
              </div>
              <div class="form-group row">
                <label for="nama-anggota" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input type="hidden" id="id-simpanan_anggota" name="id-simpanan_anggota">
                  <input type="text" class="form-control form-simpanan_anggota input-cari" id="nama-anggota" name="nama-anggota" required>
                  <ul id="list-anggota" class="list-group"></ul>
                  <input type="hidden" id="id-anggota" name="id-anggota">
                </div>
              </div>
              <div class="form-group row">
                <label for="nama-simpanan" class="col-sm-3 col-form-label">Simpanan</label>
                <div class="col-sm-9">
                  <select class="form-control form-simpanan_anggota" id="id-simpanan" name="id-simpanan">
                    <option value="99">-- PILIH --</option>
                    <?php foreach($simpanan as $row){ ?>
                    <option value="<?php echo $row['id'];?>">
                      <?php echo $row['nama']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                <div class="col-sm-9">
                  <input type="text" class="format-uang form-control form-simpanan_anggota" id="nominal" name="nominal" required>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-success btn-form" id="update-simpanan_anggota">
              <i class="fas fa-check mr-2"></i>UPDATE
            </button>
            <button type="button" class="btn btn-info btn-form" id="simpan-simpanan_anggota">
              <i class="fas fa-save mr-2"></i>SIMPAN
            </button>
            <button type="button" class="btn btn-secondary btn-batal" id="batal-simpanan_anggota">
              <i class="fas fa-times mr-2"></i>BATAL
            </button>
          </div>
        </div>
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-file-alt mr-2"></i>Form Ambil Simpanan
            </h3>
            <div class="card-tools">
              <button title="Tambah Ambil Simpanan" class="btn btn-primary btn-tambah" id="tambah-draw_anggota">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form class="form-horizontal" id="f-draw_anggota" name="f-draw_anggota" autocomplete="off">
              <div class="form-group row">
                <label for="tgl-setor" class="col-sm-3 col-form-label">Tgl.Ambil</label>
                <div class="col-sm-5">
                  <input value="<?php echo $tglnow;?>" type="text" class="input-tanggal form-control form-draw_anggota" id="tgl-draw_anggota" name="tgl-draw_anggota" data-zdp_readonly_element="false">
                </div>
              </div>
              <div class="form-group row">
                <label for="nama-draw_anggota" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-draw_anggota input-cari" id="nama-draw_anggota" name="nama-draw_anggota" required>
                  <ul id="list-draw_anggota" class="list-group"></ul>
                  <input type="hidden" id="id-draw_anggota" name="id-draw_anggota">
                </div>
              </div>
              <div class="form-group row">
                <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                <div class="col-sm-9">
                  <input type="text" class="format-uang form-control form-draw_anggota" id="nominal-draw_anggota" name="nominal-draw_anggota" required>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-info btn-form" id="simpan-draw_anggota">
              <i class="fas fa-save mr-2"></i>SIMPAN
            </button>
            <button type="button" class="btn btn-secondary btn-batal" id="batal-draw_anggota">
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
  let param = 'simpanan_anggota'
  let param2 = 'draw_anggota'
  disable_form(param)
  disable_form(param2)
  fetch_data(param)

  $('#status-' + param).change(function(e) {
    let status = $(this).val()
    $('#tb-' + param).DataTable().destroy()
    fetch_data(param, status)
  })

  $(document).on('click', '.btn-edit', function(e) {
    e.preventDefault()
    let idx = $(this).attr('id').split('-')
    if (idx[0] == param) {
      enable_form(param, 'edit')
      $.post(service_url + 's_edit.php', {
        token: 'join_anggota',
        param: param,
        data: idx[1]
      }, function(data) {
        if (data.status == true) {
          $('#id-' + param).val(data.row.id)
          $('#tgl-setor').val(formatDmy(data.row.tanggal))
          $('#id-anggota').val(data.row.id_anggota)
          $('#nama-anggota').val(data.row.nm_anggota)
          $('#id-simpanan').val(data.row.id_simpanan).attr('selected')
          $('#nominal').val(formatCurrency(data.row.nominal))
        }
      }, 'json')
    }
  })


  $('.input-cari').keyup(function(e) {
    e.preventDefault()
    let id = $(this).attr('id').replace('nama-', '')
    let query = $(this).val()

    $('#list-' + id).css('display', 'block')
    if (query.length >= 2) {
      $.ajax({
        url: service_url + 's_search.php',
        method: 'POST',
        data: {
          token: 'cari',
          param: id,
          query: query
        },
        success: function(data) {
          $('#list-' + id).html(data)
        }
      })
    }
    if (query.length == 0) {
      $('#list-' + id).css('display', 'none')
    }
  })

  $(document).on('click', '.gsearch', function(e) {
    e.preventDefault()
    let nama = $(this).text()
    let id = $(this).attr('id').split('-')
    $('#nama-' + id[0]).val(nama)
    $('#id-' + id[0]).val(id[1])
    $('#list-' + id[0]).css('display', 'none')
  })

  function fetch_data(table, arg = '99') {
    $.ajax({
      url: service_url + 's_katalog.php',
      method: 'POST',
      dataType: 'json',
      data: {
        token: 'join',
        param: table,
        arg: arg
      }
    }).done(function(data) {
      let skrg = hariIni()
      let judul = 'Simpanan Anggota per tanggal : ' + skrg
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
          { "data": "simpanan", },
          {
            "data": "tanggal",
            "class": "text-center",
            "render": function(data, type, row) {
              return formatDmy(data)
            },
          },
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
              columns: [0, 1, 2, 3, 4, ],
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
              columns: [0, 1, 2, 3, 4, ],
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
              columns: [0, 1, 2, 3, 4, ],
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
          var colNumber = [3];
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