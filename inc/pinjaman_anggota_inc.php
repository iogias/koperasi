<?php
if (!defined('WEB_ROOT')) {
    exit;
}
$pinjaman = AppKatalog::getAllRowsWithStatus('tb_pinjaman',1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-7">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-th mr-2"></i>Tabel Pinjaman Anggota
            </h3>
            <div class="card-tools">
              <select name="filter-status" id="filter-pinjaman_anggota" class="form-control-plaintext filter-status p-1 m-0">
                <option value="99">Jenis Pinjaman</option>
                <?php foreach($pinjaman as $row){ ?>
                <option value="<?php echo $row['id'];?>">
                  <?php echo $row['nama']; ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-sm" id="tb-pinjaman_anggota">
                <thead class="text-center">
                  <tr>
                    <th>No. Kontrak</th>
                    <th>Anggota</th>
                    <th>Tgl. Pinjam</th>
                    <th class="text-center">Plafon</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr>
                    <th colspan="3">Total</th>
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
      <div class="col-md-5">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-file-alt mr-2"></i>Form Pinjaman Anggota
            </h3>
            <div class="card-tools">
              <button title="Tambah Pinjaman Anggota" class="btn btn-primary btn-tambah" id="tambah-pinjaman_anggota">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form id="f-pinjaman_anggota" name="f-pinjaman_anggota" autocomplete="off">
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label for="tgl-pinjaman_anggota">Tgl. Pinjam</label>
                  <input type="hidden" id="id2-pinjaman_anggota" name="id2-pinjaman_anggota">
                  <input value="<?php echo $tglnow;?>" type="text" class="input-tanggal form-control form-pinjaman_anggota" id="tgl-pinjaman_anggota" name="tgl-pinjaman_anggota" data-zdp_readonly_element="false">
                </div>
                <div class="form-group col-md-7">
                  <label for="jenis-pinjaman_anggota">Jenis Pinjaman</label>
                  <select class="form-control form-pinjaman_anggota" id="jenis-pinjaman_anggota" name="jenis-pinjaman_anggota">
                    <option value="00">-- Pilih --</option>
                    <?php foreach($pinjaman as $row){ ?>
                    <option value="<?php echo $row['id'];?>">
                      <?php echo $row['nama']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <label for="nama-pinjaman_anggota">Nama</label>
                  <input type="hidden" id="id-pinjaman_anggota" name="id-pinjaman_anggota">
                  <input type="text" class="form-control form-pinjaman_anggota input-cari" id="nama-pinjaman_anggota" name="nama-pinjaman_anggota" required>
                  <ul id="list-pinjaman_anggota" class="list-group"></ul>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="plafon">Plafon</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="format-uang form-control form-pinjaman_anggota" id="plafon" name="plafon" required>
                    <input type="hidden" id="plafon-hidden" name="plafon-hidden">
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label for="tenor">Tenor</label>
                  <div class="input-group">
                    <input type="number" min="1" max="12" class="form-control form-pinjaman_anggota" id="tenor" name="tenor" required>
                    <div class="input-group-append">
                      <span class="input-group-text">bulan</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="bunga-rp">Bunga</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control form-pinjaman_anggota" id="bunga-rp" name="bunga-rp" readonly>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label for="bunga-persen">&nbsp;</label>
                  <div class="input-group">
                    <input type="number" min="1" max="100" class="form-control form-pinjaman_anggota" id="bunga-persen" name="bunga-persen" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="admin-rp">Biaya Admin</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control form-pinjaman_anggota" id="admin-rp" name="admin-rp" readonly>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label for="admin-persen">&nbsp;</label>
                  <div class="input-group">
                    <input type="number" min="1" max="100" class="form-control form-pinjaman_anggota" id="admin-persen" name="admin-persen" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="total-terima">Total Terima |
                    <span><small class="text-muted">&nbsp;Plafon - Biaya Admin</small></span>
                  </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control form-pinjaman_anggota" id="total-terima" name="total-terima" readonly>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label for="status-pinjaman_anggota">Status</label>
                  <select class="form-control form-pinjaman_anggota" id="status-pinjaman_anggota" name="status-pinjaman_anggota">
                    <option value="JALAN">Jalan</option>
                    <option value="LUNAS">Lunas</option>
                    <option value="MACET">Macet</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-success btn-form" id="update-pinjaman_anggota">
              <i class="fas fa-check mr-2"></i>UPDATE
            </button>
            <button type="button" class="btn btn-info btn-form" id="simpan-pinjaman_anggota">
              <i class="fas fa-save mr-2"></i>SIMPAN
            </button>
            <button type="button" class="btn btn-secondary btn-batal" id="batal-pinjaman_anggota">
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
  let param = 'pinjaman_anggota'
  let _plafon = 0
  let _bunga = 0
  let _admin = 0
  let _admin_rp = 0
  disable_form(param)
  fetch_data(param)

  $('#filter-' + param).change(function(e) {
    let id = $(this).val()
    $('#tb-' + param).DataTable().destroy()
    fetch_data(param, id)
  })

  $('#jenis-' + param).change(function(e) {
    let jenis = $(this).val()
    $.post(service_url + 's_edit.php', {
      token: 'edit',
      param: 'pinjaman',
      data: jenis
    }, function(data) {
      if (data.status == true) {
        $('#plafon').val(formatCurrency(data.row.max_plafon))
        $('#plafon-hidden').val(data.row.max_plafon)
        $('#bunga-persen').val(data.row.max_bunga)
        $('#tenor').val(data.row.max_tenor)
        $('#admin-persen').val(data.row.max_admin)
        _plafon = $('#plafon').val()
        _bunga = $('#bunga-persen').val()
        _admin = $('#admin-persen').val()
        if (_plafon != 0 && _bunga != 0 && _admin != 0) {
          hitung_persen(_plafon, _bunga)
          hitung_admin(_plafon, _admin)
          console.log(_admin)
          _admin_rp = $('#admin-rp').val()
          hitung_terima(_plafon, _admin_rp)
        }
      }
    }, 'json')
  })

  $('#plafon').blur(function(e) {
    let max_plafon = parseInt($('#plafon-hidden').val())
    let this_plafon = parseInt(formatNormal($(this).val()))
    let bunga = $('#bunga-persen').val()
    let tenor = $('#tenor').val()
    let admin = $('#admin-persen').val()
    console.log(_bunga)
    if (this_plafon > max_plafon) {
      toastr.error('Plafon melebihi batas maksimal')
      $(this).addClass('is-invalid')
    } else {
      _plafon = this_plafon
      hitung_persen(_plafon, bunga)
      hitung_admin(_plafon, admin)
      _admin_rp = $('#admin-rp').val()
      hitung_terima(_plafon, _admin_rp)
    }
  })

  $('#plafon').focus(function(e) {
    if ($(this).hasClass('is-invalid')) {
      $(this).removeClass('is-invalid')
    }
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
          $('#id2-' + param).val(data.row.id)
          $('#tgl-' + param).val(formatDmy(data.row.tanggal))
          $('#id-' + param).val(data.row.id_anggota)
          $('#nama-' + param).val(data.row.nm_anggota)
          $('#jenis-' + param).val(data.row.id_pinjaman).attr('selected')
          $('#plafon').val(formatCurrency(data.row.pokok))
          $('#bunga-persen').val(data.row.bunga_persen)
          $('#bunga-rp').val(formatCurrency(data.row.bunga_rupiah))
          $('#tenor').val(data.row.tenor)
          $('#admin-persen').val(data.row.admin_persen)
          $('#admin-rp').val(formatCurrency(data.row.admin_rupiah))
          $('#total-terima').val(formatCurrency(data.row.total_terima))
          $('#status-' + param).val(data.row.status).attr('selected')

        }
      }, 'json')
    }
  })

  $('.input-cari').keyup(function(e) {
    e.preventDefault()
    e.stopPropagation()
    let idpin = ($('#jenis-' + param).val() == '00') ? '1' : $('#jenis-' + param).val()
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
          query: query,
          arg: 'pinjaman',
          idp: idpin
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

  function hitung_terima(plafon, admin) {
    let total = 0
    plafon = parseInt(formatNormal(plafon))
    admin = parseInt(formatNormal(admin))
    total = plafon - admin
    $('#total-terima').val(formatCurrency(total))
  }

  function hitung_persen(plafon, persen) {
    let prosentase = 0
    plafon = parseInt(formatNormal(plafon))
    prosentase = plafon * parseFloat(persen / 100)
    $('#bunga-rp').val(formatCurrency(prosentase))
  }

  function hitung_admin(plafon, persen) {
    let prosentase = 0
    plafon = parseInt(formatNormal(plafon))
    prosentase = plafon * parseFloat(persen / 100)
    $('#admin-rp').val(formatCurrency(prosentase))
  }

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
      let judul = 'Pinjaman Anggota per tanggal : ' + skrg
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

        columns: [
          { "data": "nomor_kontrak", "class": "pl-3" },
          { "data": "nama", "class": "pl-3" },
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
            "data": "status",
            "class": "text-center",
            "render": function(data, type, row) {
              return kreditBadge(data)
            },
          },
          {
            "data": "id",
            "class": "text-center",
            "render": function(data, type, row) {
              return actionBtn(table, data)
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
              columns: [0, 1, 2, 3, 4, 5, ],
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
              columns: [0, 1, 2, 3, 4, 5, ],
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
              columns: [0, 1, 2, 3, 4, 5, ],
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