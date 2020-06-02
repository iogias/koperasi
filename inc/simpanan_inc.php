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
              <i class="fas fa-th mr-2"></i>Tabel Simpanan
            </h3>
            <div class="card-tools">
              <select name="filter-status" id="status-simpanan" class="form-control-plaintext filter-status p-1 m-0 ">
                <option value="99">Status</option>
                <option value="1">Aktif</option>
                <option value="0">Non-Aktif</option>
              </select>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-sm" id="tb-simpanan">
                <thead class="text-center">
                  <tr>
                    <th>ID</th>
                    <th width="20%">Jenis Simpanan</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
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
              <i class="fas fa-file-alt mr-2"></i>Form Jenis Simpanan
            </h3>
            <div class="card-tools">
              <button title="Tambah Simpanan" class="btn btn-primary btn-tambah" id="tambah-simpanan">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form class="form-horizontal" id="f-simpanan" name="f-simpanan" autocomplete="off">
              <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input type="hidden" id="id-simpanan" name="id-simpanan">
                  <input type="text" class="form-control form-simpanan" id="nama" name="nama" minlength="2" maxlength="80" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                <div class="col-sm-9">
                  <textarea placeholder="Maksimal 200 karakter." class="form-control form-simpanan" id="keterangan" name="keterangan" rows="4"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-5">
                  <select class="form-control form-simpanan" name="status" id="status">
                    <option value="1">Aktif</option>
                    <option value="0">Non-Aktif</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-success btn-form" id="update-simpanan">
              <i class="fas fa-check mr-2"></i>UPDATE
            </button>
            <button type="button" class="btn btn-info btn-form" id="simpan-simpanan">
              <i class="fas fa-save mr-2"></i>SIMPAN
            </button>
            <button type="button" class="btn btn-secondary btn-batal" id="batal-simpanan">
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
  let param = 'simpanan'

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
      let skrg = hariIni()
      let judul = 'Jenis Simpanan per tanggal : ' + skrg
      let tb = $('#tb-' + arg1).DataTable({
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
        columns: [
          { "data": "id", "class": "text-center", },
          { "data": "nama" },
          { "data": "keterangan", },
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
        buttons: [{
            extend: 'excelHtml5',
            className: 'btn-success',
            text: '<i class="fa fa-file-excel"></i> EXCEL',
            footer: false,
            title: function() {
              return judul
            },
            exportOptions: {
              columns: [1, 2, 3, 4, ],
              modifier: {
                page: 'current',
              }
            },
          },
          {
            extend: 'pdfHtml5',
            className: 'btn-danger',
            text: '<i class="fa fa-file-pdf"></i> PDF',
            footer: false,
            title: function() {
              return judul
            },
            exportOptions: {
              columns: [1, 2, 3, 4, ],
              modifier: {
                page: 'current',
              }
            },
          },
          {
            extend: 'print',
            footer: false,
            autoPrint: true,
            text: '<i class="fa fa-print"></i> PRINT',
            title: '',
            exportOptions: {
              columns: [1, 2, 3, 4, ],
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
      })
    })
  }
})
</script>