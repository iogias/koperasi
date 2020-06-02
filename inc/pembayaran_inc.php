<?php
if (!defined('WEB_ROOT')) {
    exit;
}
$pin = AppKatalog::getAllRowsWithStatus('tb_pinjaman',1);
?>
<div class="content">
  <div class="container-fluid">
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
                  <input type="hidden" id="id-anggota" name="id-anggota">
                  <input type="text" class="form-control form-pembayaran" id="form-cari" name="form-cari" data-mask>
                  <ul id="list-cari" class="list-group"></ul>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="nomor-kontrak">No. Kontrak</label>
                  <input type="text" id="nomor-kontrak" name="nomor-kontrak" class="form-control form-pembayaran" readonly>
                </div>
                <div class="form-group col-md-3">
                  <label for="tgl-bayar">Tgl. Bayar</label>
                  <input value="<?php echo $tglnow;?>" type="text" class="input-tanggal form-control form-pembayaran" id="tgl-bayar" name="tgl-bayar" data-zdp_readonly_element="false">
                </div>
                <div class="form-group col-md-3">
                  <label for="bayar-ke">Angsuran Ke-</label>
                  <input type="text" id="bayar-ke" name="bayar-ke" class="form-control form-pembayaran">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="bayar-pokok">Bayar Pokok</label>
                  <input type="text" id="bayar-pokok" name="bayar-pokok" class="format-uang form-control form-pembayaran">
                </div>
                <div class="form-group col-md-4">
                  <label for="bayar-bunga">Bayar Bunga</label>
                  <input type="text" id="bayar-bunga" name="bayar-bunga" class="format-uang form-control form-pembayaran">
                </div>
                <div class="form-group col-md-4">
                  <label for="setor-wajib">Simpanan Wajib</label>
                  <input type="text" id="setor-wajib" name="setor-wajib" class="format-uang form-control form-pembayaran">
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
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-th mr-2"></i>Data Peminjam
            </h3>
            <div class="card-tools">
              <button type="button" class="btn bg-light btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn bg-light btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
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
                <div class="form-group col-md-4">
                  <label for="angsuran-pokok">Angsuran Pokok / bln</label>
                  <input type="text" id="angsuran-pokok" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-4">
                  <label for="angsuran-bunga">Angsuran Bunga / bln</label>
                  <input type="text" id="angsuran-bunga" class="form-control-plaintext border-bottom form-display">
                </div>
                <div class="form-group col-md-4">
                  <label for="angsuran-total">Total Angsuran / bln</label>
                  <input type="text" id="angsuran-total" class="form-control-plaintext border-bottom form-display">
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

  $('#select-pinjaman').change(function(e) {
    select_pin = $(this).val()
  })

  $('#select-cari').change(function() {
    select_cari = $(this).val()
    if (select_cari == '1') {
      $('#form-cari').inputmask("remove")
    } else {
      $('#form-cari').inputmask({
        "mask": "999999-9999"
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

  function display_data(kontrak) {
    $.post(service_url + 's_edit.php', {
      token: 'bayar',
      data: kontrak
    }, function(data) {
      if (data.status == true) {
        let total_angs = 0
        $('#nomor-kontrak').val(data.row.nomor_kontrak)
        $('#nama-anggota').val(data.row.nama)
        $('#tgl-pinjam').val(formatDmy(data.row.tanggal))
        $('#status').val(data.row.status)
        $('#pokok').val(formatCurrency(data.row.pokok))
        $('#bunga').val(formatCurrency(data.row.bunga_rupiah))
        $('#tenor').val(data.row.tenor + ' X')
        let angs_pokok = Math.round(data.row.pokok / data.row.tenor)
        let angs_bunga = Math.round(data.row.bunga_rupiah / data.row.tenor)
        $('#angsuran-pokok').val(formatCurrency(angs_pokok))
        $('#angsuran-bunga').val(formatCurrency(angs_bunga))
        total_angs = angs_pokok + angs_bunga
        $('#angsuran-total').val(formatCurrency(total_angs))
        $('#sisa-pokok').val('')
        $('#sisa-bunga').val('')
        $('#total-sisa').val('')
      }
    }, 'json')
  }
})
</script>