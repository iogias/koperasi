const service_url = './services/'
const validnum = /^[0-9]+$/
const validalphanum = /^[a-z0-9]+$/i
let urls = window.location.search
let lin = urls.replace('?action=', '')
let today = new Date()
let dd = String(today.getDate()).padStart(2, '0')
let mm = String(today.getMonth() + 1).padStart(2, '0') //January is 0!
let yyyy = today.getFullYear()
today = dd + '-' + mm + '-' + yyyy

$(function() {

  toastr.options = {
    'positionClass': 'toast-top-center',
    'showDuration': '2000',
    'hideDuration': '2000',
    'timeOut': '2000',
    'extendedTimeOut': '2000',
  }

  set_date($('.input-tanggal'))

  $(document).on('click', '.a-link-menu-nav', function() {
    let id = $(this).attr('id').replace('get_', '')
    window.location.href = 'index.php?action=' + id
  })

  $('.nav-link').each(function() {
    let idx = $(this).attr('id')
    if (idx !== undefined && idx == lin) {
      $(this).addClass('active')
      let tree = $(this).parents('.nav-item').filter('.has-treeview')
      tree.addClass('menu-open')
    }
  })

  $('#btn-masuk').click(function(e) {
    e.preventDefault()
    let pengguna = $('#pengguna').val()
    let rahasia = $('#rahasia').val()
    let form = $('#f-login')
    let fail = false
    let fail_log = ''
    let name
    form.find('input').each(function() {
      if (!$(this).prop('required')) {} else {
        if (!$(this).val()) {
          fail = true
          name = $(this).attr('name')
          fail_log += '[' + name + '] HARUS DI ISI!' + '</br>'
        }
      }
    })
    if (!fail) {
      $.ajax({
        url: service_url + 's_login.php',
        method: 'POST',
        dataType: 'json',
        data: {
          token: 'login',
          datalog: form.serialize()
        },
        beforeSend: function() {
          $('.spinme').removeClass('d-none')
          $('.spinme').addClass('d-flex')
        },
        complete: function() {
          $('.spinme').removeClass('d-flex')
          $('.spinme').addClass('d-none')
        },
        success: function(result) {
          if (result.status == true) {
            form[0].reset()
            window.location.href = "/koperasi/index.php"
          } else {
            form[0].reset()
            toastr.error('Kesalahan pada username / password!')
          }
        }
      })
    } else {
      toastr.warning(fail_log)
    }
  })

  $('#btn-keluar').click(function(e) {
    e.preventDefault()
    let user = $('#text-user').text()
    $.get(service_url + 's_login.php', {
      token: 'logout',
      data: user
    }, function(data) {
      if (data.status == true) {
        window.location.href = "/koperasi/login.php"
      } else {
        toastr.error('Gagal Logout!')
      }
    }, 'json')
  })

})

$(document).on('click', '.btn-form', function(e) {
  e.preventDefault()
  let id = $(this).attr('id').split('-')
  let state = id[0]
  let param = id[1]
  simpan_update(param, state)
})

$(document).on('click', '.btn-batal', function(e) {
  let id = $(this).attr('id').replace('batal-', '')
  batal(id)
})

$(document).on('click', '.btn-tambah', function(e) {
  let id = $(this).attr('id').replace('tambah-', '')
  tambah(id)
})

$(document).on('keyup', '.format-uang', function() {
  let nilai = $(this)
  format_uang(nilai)
})

$(document).on('click', '.btn-delete', function(e) {
  let idx = $(this).attr('id').split('-')
  if (confirm("Hapus data ini?")) {
    $.post(service_url + 's_delete.php', {
      token: 'delete',
      param: idx[0],
      data: idx[1]
    }, function(data) {
      if (data.status == true) {
        toastr.error('SUKSES HAPUS DATA!')
        window.setTimeout(function() {
          window.location.href = 'index.php?action=' + idx[0]
        }, 1500)
      }
    }, 'json')
  }
})

function simpan_update(param, state) {
  let form = $('#f-' + param)
  let fail = false
  let fail_log = ''
  let name
  form.find('input').each(function() {
    if (!$(this).prop('required')) {} else {
      if (!$(this).val()) {
        fail = true
        name = $(this).attr('name')
        fail_log += '[' + name + '] HARUS DI ISI!' + '</br>'
      }
    }
  })
  if (!fail) {
    if (state == 'simpan') {
      $.post(service_url + 's_simpan.php', {
        token: state,
        param: param,
        data: form.serialize()
      }, function(res) {
        if (res.status == true) {
          toastr.success('SUKSES SIMPAN DATA!')
          window.setTimeout(function() {
            window.location.href = urls
          }, 1000)
        } else {
          toastr.error('ERROR SIMPAN DATA! : ' + res.msg)
        }
      }, 'json')
    } else if (state == 'update') {
      $.post(service_url + 's_update.php', {
        token: state,
        param: param,
        data: form.serialize()
      }, function(res) {
        if (res.status == true) {
          toastr.success('SUKSES UPDATE DATA!')
          window.setTimeout(function() {
            window.location.href = urls
          }, 1000)
        } else {
          toastr.error('ERROR UPDATE DATA!')
        }
      }, 'json')
    }
  } else {
    toastr.warning(fail_log)
  }
}

function format_uang(el) {
  el.inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': ',',
    'autoGroup': true,
    'digits': 0,
    'radixPoint': '.',
    'digitsOptional': false,
    'allowMinus': false
  })
}

function disable_form(param) {
  $('#f-' + param).find('.form-' + param).each(function() {
    $(this).prop('disabled', true)
  })
  disable_btn($('.btn-form'))
}

function enable_form(param, arg) {
  $('#f-' + param).find('.form-' + param).each(function() {
    $(this).prop('disabled', false)
  })
  if (arg == 'tambah') {
    enable_btn($('#simpan-' + param))
  } else if (arg == 'edit') {
    enable_btn($('#update-' + param))
    disable_btn($('#tambah-' + param))
  }

}

function disable_btn(ele) {
  ele.prop('disabled', true)
}

function enable_btn(ele) {
  ele.prop('disabled', false)
}

function batal(param) {
  $('#f-' + param)[0].reset()
  disable_form(param)
  enable_btn($('#tambah-' + param))
}

function tambah(param) {
  enable_form(param, 'tambah')
  disable_btn($('#tambah-' + param))
}

function set_date(ele) {
  ele.Zebra_DatePicker({
    format: 'd-m-Y'
  })
}

function hariIni() {
  let today = new Date()
  let dd = String(today.getDate()).padStart(2, '0')
  let mm = String(today.getMonth() + 1).padStart(2, '0') //January is 0!
  let yyyy = today.getFullYear()
  today = dd + '-' + mm + '-' + yyyy
  return today
}

function formatDmy(str) {
  str = str.split('-')
  let tgl = str[2] + '-' + str[1] + '-' + str[0]
  return tgl
}

function statusBadge(sts) {
  let status = (sts == '1') ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Non-Aktif</span>'
  return status
}

function kreditBadge(sts) {
  let status;
  switch (sts) {
    case "LUNAS":
      status = '<span class="badge badge-success">Lunas</span>';
      break;
    case "JALAN":
      status = '<span class="badge badge-primary">Jalan</span>';
      break;
    case "MACET":
      status = '<span class="badge badge-danger">Macet</span>';
      break;
    default:
      status = '-';
  }
  return status;
}

function validAlphaNum(str) {
  if (validalphanum.test(str)) {
    return str
  }
}

function actionBtn(param, id) {
  let btn = '<button type="button" class="btn btn-warning btn-sm btn-edit" id="' + param + '-' + id + '">'
  btn += '<i class="fas fa-pencil-alt"></i></button>'
  return btn
}

function actionBtn2(param, id) {
  let btn = '<button type="button" class="btn btn-warning btn-sm btn-edit" id="' + param + '-' + id + '">'
  btn += '<i class="fas fa-pencil-alt"></i></button>&nbsp;'
  btn += '<button type="button" class="btn btn-danger btn-sm btn-delete" id="' + param + '-' + id + '">'
  btn += '<i class="fas fa-trash-alt"></i></button>'
  return btn
}

function formatCurrency(num) {
  num = (isNaN(num) || num == null) ? '0' : num
  num = num.toString().replace(/\$|\,/g, '')
  sign = (num == (num = Math.abs(num)))
  num = Math.floor(num * 100 + 0.50000000001)
  cents = num % 100
  num = Math.floor(num / 100).toString()
  if (cents < 10)
    cents = "0" + cents
  for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
    num = num.substring(0, num.length - (4 * i + 3)) + ',' +
    num.substring(num.length - (4 * i + 3));
  return (((sign) ? '' : '-') + num)
}

function formatNormal(num) {
  num = num.toString().replace(/\$|\,/g, '')
  if (isNaN(num))
    num = "0"
  return num
}