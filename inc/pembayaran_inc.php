<?php
if (!defined('WEB_ROOT')) {
    exit;
}
$pin = AppKatalog::getAllRowsWithStatus('tb_pinjaman',1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-th mr-2"></i>Tabel Pembayaran
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-sm" id="tb-pembayaran">
                <thead class="text-center">
                  <tr>
                    <th>No.Kontrak</th>
                    <th>Nama</th>
                    <th>Tgl.Bayar</th>
                    <th class="text-center">Pokok Terbayar</th>
                    <th class="text-center">Bunga Terbayar</th>
                    <th width="5%">&nbsp;</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-file-alt mr-2"></i>Form Pembayaran Anggota
            </h3>
            <div class="card-tools">
              <button title="Tambah Pembayaran Anggota" class="btn btn-primary btn-tambah" id="tambah-pembayaran">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form id="f-pembayaran" name="f-pembayaran" autocomplete="off">
              <div class="row">
                <div class="col-md-4">
                  <select name="select-pinjaman" id="select-pinjaman" class="form-control filter-status form-pembayaran">
                    <?php foreach($pin as $w){ ?>
                    <option value="<?php echo $w['id'];?>">
                      <?php echo $w['nama']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <select class="form-control form-pembayaran" id="select-cari">
                    <option value="1">Nama</option>
                    <option value="2">No.Kontrak</option>
                  </select>
                </div>
                <div class="col-md-5">
                  <input type="hidden" id="id-pembayaran" name="id-pembayaran">
                  <input type="hidden" id="id-anggota" name="id-anggota">
                  <input type="text" class="form-control form-pembayaran" id="form-cari" name="form-cari" data-mask required>
                  <ul id="list-cari" class="list-group"></ul>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="nomor-kontrak">No. Kontrak</label>
                  <input type="text" id="nomor-kontrak" name="nomor-kontrak" class="form-control form-pembayaran" readonly required>
                </div>
                <div class="form-group col-md-6">
                  <label for="tgl-bayar">Tgl. Bayar</label>
                  <input value="<?php echo $tglnow;?>" type="text" class="input-tanggal form-control form-pembayaran" id="tgl-bayar" name="tgl-bayar" data-zdp_readonly_element="false">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="bayar-pokok">Bayar Pokok</label>
                  <input type="text" id="bayar-pokok" name="bayar-pokok" class="format-uang form-control form-pembayaran" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="bayar-bunga">Bayar Bunga</label>
                  <input type="text" id="bayar-bunga" name="bayar-bunga" class="format-uang form-control form-pembayaran" required>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="keterangan">Keterangan</label>
                  <textarea rows="2" id="keterangan" name="keterangan" class="form-control form-pembayaran"></textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-success btn-form" id="update-pembayaran">
              <i class="fas fa-check mr-2"></i>UPDATE
            </button>
            <button type="button" class="btn btn-info btn-form" id="simpan-pembayaran">
              <i class="fas fa-save mr-2"></i>SIMPAN
            </button>
            <button type="button" class="btn btn-secondary btn-batal" id="batal-pembayaran">
              <i class="fas fa-times mr-2"></i>BATAL
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card bg-gradient-light">
          <div class="card-body">
            <form id="f-display" readonly>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="nama-anggota">Nama</label>
                  <input type="text" class="form-control-plaintext border-bottom form-display" id="nama-anggota">
                </div>
                <div class="form-group col-md-3">
                  <label for="tgl-pinjam">Tgl. Pinjam</label>
                  <input type="text" id="tgl-pinjam" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-3">
                  <label for="status">Status</label>
                  <input type="text" id="status" class="form-control-plaintext border-bottom form-display">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="angsuran-pokok">Angsuran Pokok (bln)</label>
                  <input type="text" id="angsuran-pokok" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-4">
                  <label for="angsuran-bunga">Angsuran Bunga (bln)</label>
                  <input type="text" id="angsuran-bunga" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-4">
                  <label for="angsuran-total">Total Angsuran (bln)</label>
                  <input type="text" id="angsuran-total" class="form-control-plaintext border-bottom form-display">
                </div>
              </div>
              <br />
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="pokok">Total Pokok</label>
                  <input type="text" id="pokok" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-4">
                  <label for="bunga">Total Bunga</label>
                  <input type="text" id="bunga" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-4">
                  <label for="tenor">Tenor</label>
                  <input type="text" id="tenor" class="form-control-plaintext border-bottom form-display">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-3">
                  <label for="pokok-terbayar">Pokok Terbayar</label>
                  <input type="text" id="pokok-terbayar" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-1">
                  <label for="x-pokok">(x)</label>
                  <input type="text" id="x-pokok" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-3">
                  <label for="bunga-terbayar">Bunga Terbayar</label>
                  <input type="text" id="bunga-terbayar" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-1">
                  <label for="x-bunga">(x)</label>
                  <input type="text" id="x-bunga" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-4">
                  <label for="total-terbayar">Total Terbayar
                  </label>
                  <input type="text" id="total-terbayar" class="form-control-plaintext border-bottom form-display">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="sisa-pokok">Sisa Pokok</label>
                  <input type="text" id="sisa-pokok" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-4">
                  <label for="sisa-bunga">Sisa Bunga</label>
                  <input type="text" id="sisa-bunga" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-4">
                  <label for="total-sisa">Total Sisa Hutang
                  </label>
                  <input type="text" id="total-sisa" class="form-control-plaintext border-bottom form-display">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function() {
  let param = 'pembayaran'
  let select_cari = '1'
  let select_pin = '1'
  disable_form(param)
  fetch_data(param)

  $('#select-pinjaman').change(function(e) {
    select_pin = $(this).val()
  })

  $('#select-cari').change(function() {
    select_cari = $(this).val()
    if (select_cari == '1') {
      $('#form-cari').inputmask("remove")
    } else {
      $('#form-cari').inputmask({
        "mask": "99999999-999"
      })
    }
  })

  $('#form-cari').keyup(function() {
    let query = $(this).val()
    let tokens = (select_cari == '1') ? 'cari' : 'carino'

    $('#list-cari').css('display', 'block')
    if (query.length >= 2) {
      $.ajax({
        url: service_url + 's_search.php',
        method: 'POST',
        data: {
          token: tokens,
          param: param,
          query: query,
          arg: 'bayar',
          idp: select_pin
        },
        success: function(data) {
          $('#list-cari').html(data)
        }
      })
    }
    if (query.length == 0) {
      $('#list-cari').css('display', 'none')
    }
  })

  $(document).on('click', '.gsearch', function(e) {
    e.preventDefault()
    let nama = $(this).text()
    let id = $(this).attr('id').split('-')
    let nok = $(this).attr('data-kontrak')
    $('#form-cari').val(nama)
    $('#id-anggota').val(id[1])
    $('#list-cari').css('display', 'none')
    display_data(nok)
  })

  $(document).on('click', '.btn-edit', function(e) {
    e.preventDefault()
    let idx = $(this).attr('id').split('-')
    if (idx[0] == param) {
      enable_form(param, 'edit')
      $.post(service_url + 's_edit.php', {
        token: 'pembayaran',
        data: idx[1]
      }, function(data) {
        if (data.status == true) {
          $('#id-' + param).val(data.row.id)
          $('#select-pinjaman').val(data.row.id_pinjaman).attr('selected')
          $('#form-cari').val(data.row.nm_anggota)
          $('#nomor-kontrak').val(data.row.nomor_kontrak)
          $('#bayar-pokok').val(formatCurrency(data.row.nominal_pokok))
          $('#bayar-bunga').val(formatCurrency(data.row.nominal_bunga))
          $('#tgl-bayar').val(formatDmy(data.row.tanggal))
          $('#keterangan').val(data.row.keterangan)
        }
      }, 'json')
    }
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
      let judul = 'Pembayaran Anggota per tanggal : ' + skrg
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
          { "data": "nomor_kontrak", },
          { "data": "anggota", "class": "pl-3" },
          {
            "data": "tanggal",
            "class": "text-center",
            "render": function(data, type, row) {
              return formatDmy(data)
            },
          },
          {
            "data": "nominal_pokok",
            "class": "text-right pr-4",
            "render": function(data, type, row) {
              return formatCurrency(data)
            },
          },
          {
            "data": "nominal_bunga",
            "class": "text-right pr-4",
            "render": function(data, type, row) {
              return formatCurrency(data)
            },
          },
          {
            "data": "id",
            "class": "text-center",
            "render": function(data, type, row) {
              return actionBtnEditBayar(table, data, row.nomor_kontrak)
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

  function display_data(kontrak) {
    $.post(service_url + 's_bayar.php', {
      token: 'bayar',
      param: param,
      data: kontrak
    }, function(data) {
      if (data.status == true) {
        $('#nomor-kontrak').val(data.row.nomor_kontrak)
        $('#nama-anggota').val(data.row.nama)
        $('#tgl-pinjam').val(formatDmy(data.row.tanggal))
        $('#status').val(data.row.status)
        $('#pokok').val(formatCurrency(data.row.pokok))
        $('#bunga').val(formatCurrency(data.row.bunga_rupiah))
        $('#tenor').val(data.row.tenor + ' X')
        $('#angsuran-pokok').val(formatCurrency(data.angs_pokok))
        $('#angsuran-bunga').val(formatCurrency(data.angs_bunga))
        $('#angsuran-total').val(formatCurrency(data.total_angs))
        $('#sisa-pokok').val(formatCurrency(data.sisa_pokok))
        $('#sisa-bunga').val(formatCurrency(data.sisa_bunga))
        $('#total-sisa').val(formatCurrency(data.total_sisa))
        $('#pokok-terbayar').val(formatCurrency(data.pokok_terbayar))
        $('#bunga-terbayar').val(formatCurrency(data.bunga_terbayar))
        $('#total-terbayar').val(formatCurrency(data.total_terbayar))
        $('#x-pokok').val(data.ct_pokok + 'x')
        $('#x-bunga').val(data.ct_bunga + 'x')
      }
    }, 'json')
  }
})
</script>