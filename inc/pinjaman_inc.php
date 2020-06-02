<?php
if (!defined('WEB_ROOT')) {
    exit;
}
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-th mr-2"></i>Tabel Pinjaman
            </h3>
            <div class="card-tools">
              <select name="filter-status" id="status-pinjaman" class="form-control-plaintext filter-status p-1 m-0 ">
                <option value="99">Status</option>
                <option value="1">Aktif</option>
                <option value="0">Non-Aktif</option>
              </select>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-sm" id="tb-pinjaman">
                <thead class="text-center">
                  <tr>
                    <th width="15%">Nama</th>
                    <th>Keterangan</th>
                    <th class="text-center">Max.Plafon</th>
                    <th>Max.Bunga(%)</th>
                    <th>Max.Tenor</th>
                    <th>Max.Admin(%)</th>
                    <th>Status</th>
                    <th width="6%">&nbsp;</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-file-alt mr-2"></i>Form Jenis Pinjaman
            </h3>
            <div class="card-tools">
              <button title="Tambah Pinjaman" class="btn btn-primary btn-tambah" id="tambah-pinjaman">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form id="f-pinjaman" name="f-pinjaman" autocomplete="off">
              <div class="form-row">
                <div class="form-group col">
                  <label for="nama">Nama</label>
                  <input type="hidden" id="id-pinjaman" name="id-pinjaman">
                  <input type="text" class="form-control form-pinjaman" id="nama" name="nama" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <label for="keterangan">Keterangan</label>
                  <textarea rows="2" class="form-control form-pinjaman" id="keterangan" name="keterangan"></textarea>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="max-plafon">Max.Plafon</label>
                  <input type="text" class="format-uang form-control form-pinjaman" id="max-plafon" name="max-plafon" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="max-bunga">Max.Bunga (%)</label>
                  <input type="text" class="form-control form-pinjaman" id="max-bunga" name="max-bunga" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="max-tenor">Max.Tenor</label>
                  <input type="text" class="form-control form-pinjaman" id="max-tenor" name="max-tenor" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="max-admin">Max.Admin (%)</label>
                  <input type="text" class="form-control form-pinjaman" id="max-admin" name="max-admin" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="status">Status</label>
                  <select class="form-control form-pinjaman" name="status" id="status">
                    <option value="1">Aktif</option>
                    <option value="0">Non-Aktif</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-success btn-form" id="update-pinjaman">
              <i class="fas fa-check mr-2"></i>UPDATE
            </button>
            <button type="button" class="btn btn-info btn-form" id="simpan-pinjaman">
              <i class="fas fa-save mr-2"></i>SIMPAN
            </button>
            <button type="button" class="btn btn-secondary btn-batal" id="batal-pinjaman">
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
  let param = 'pinjaman'

  disable_form(param)
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
        token: 'edit',
        param: param,
        data: idx[1]
      }, function(data) {
        if (data.status == true) {
          $('#id-' + param).val(data.row.id)
          $('#nama').val(data.row.nama)
          $('#keterangan').val(data.row.keterangan)
          $('#max-plafon').val(formatCurrency(data.row.max_plafon))
          $('#max-bunga').val(data.row.max_bunga)
          $('#max-tenor').val(data.row.max_tenor)
          $('#max-admin').val(data.row.max_admin)
          $('#status').val(data.row.status).attr('selected')
        }
      }, 'json')
    }
  })

  function fetch_data(arg1, arg2 = '99') {
    $.ajax({
      url: service_url + 's_katalog.php',
      method: 'POST',
      dataType: 'json',
      data: {
        token: 'single',
        param: arg1,
        args: arg2
      }
    }).done(function(data) {
      let tb = $('#tb-' + arg1).DataTable({
        dom: '<"row"<"col-sm-12 col-md-6"><"col-sm-12 col-md-6 p-2"f>>t<"row"<"col-sm-12 col-md-6 p-2"l><"col-sm-12 col-md-6 p-2"p>>',
        aaData: data,
        processing: true,
        autoWidth: false,
        scrollCollapse: true,
        paginationType: "full_numbers",
        ordering: false,
        lengthMenu: [
          [10, 25, 50, 100],
          [10, 25, 50, 100]
        ],
        columns: [
          { "data": "nama", "class": "pl-4" },
          { "data": "keterangan", },
          {
            "data": "max_plafon",
            "class": "text-right pr-4",
            "render": function(data, type, row) {
              return formatCurrency(data)
            },
          },
          { "data": "max_bunga", "class": "text-center" },
          { "data": "max_tenor", "class": "text-center" },
          { "data": "max_admin", "class": "text-center" },
          {
            "data": "status",
            "class": "text-center",
            "render": function(data, type, row) {
              return statusBadge(data)
            },
          },
          {
            "data": "id",
            "class": "text-center",
            "render": function(data, type, row) {
              return actionBtn(arg1, data)
            },
          },
        ],

      })
    })
  }
})
</script>