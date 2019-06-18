var host = window.location.hostname;
var path = window.location.pathname;

var delay = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

$(function() {
    $(window).hashchange(function() {
        var hash = $.param.fragment();
        if (hash == 'tambah') {
            if (path.search('/mobil') > 0) {
                $('#myModal .modal-header #myModalLabel').text('Tambah Mobil');
                $('#myModal .modal-footer #submit-mobil').text('OK');
                $('#myModal #form-mobil').attr('action', 'tambah');
            } else if (path.search('/user') > 0) {
                $('#myModal .modal-header #myModalLabel').text('Tambah User');
                $('#myModal .modal-footer #submit-user').text('OK');
                $('#myModal #form-user').attr('action', 'tambah');
            }
            $('#myModal').modal('show');
        } else if (hash.search('edit') == 0) {
            if (path.search('/permohonan') > 0) {
                /* pilihan mobil */
                var pilihan_mobil = getJSON('http://'+host+path+'/get_mobil', {});
                $('#mobil_parent option').remove();
                $('#mobil_parent').append('<option value="">-- Pilih Mobil --</option>');
                if (pilihan_mobil.record) {
                    $.each(pilihan_mobil.record, function(key, value) {
                        $('#mobil_parent').append('<option value="'+value['mobil_id']+'">'+value['mobil']+' -- ['+value['nopol']+']</option>');
                    });
                }

                var permohonan_id = getUrlVars()['id'];
                var permohonan_detail = getJSON('http://'+host+path+'/action/ambil', { id: permohonan_id });

                $('#myModal .modal-body #pemohon').val(permohonan_detail.data['username']);
                $('#myModal .modal-body #tujuan').val(permohonan_detail.data['tujuan']);
                $('#myModal .modal-body #keperluan').val(permohonan_detail.data['keperluan']);
                $('#myModal .modal-body #jum_penumpang').val(permohonan_detail.data['jum_penumpang']);
                $('#myModal .modal-body #tgl_pemakaian').val(permohonan_detail.data['tgl_pemakaian']);
                $('#myModal .modal-body #lama_pemakaian').val(permohonan_detail.data['lama_pemakaian']);
                $('#myModal .modal-body #dasar_pemakaian').val(permohonan_detail.data['dasar_pemakaian']);
                $('#myModal .modal-body #mobil_parent option[value ="'+permohonan_detail.data['mobil_id']+'"]').prop('selected', true);
                $('#myModal .modal-body #kode_pemakaian').after('<p class="help-block warning">Isikan kode pemakaian dengan 4 digit angka</p>');
                $('#myModal .modal-header #myModalLabel').text('Menyetujui Permohonan');
                $('#myModal .modal-footer #submit-permohonan').text('OK');
                $('#myModal #form-permohonan').attr('action', 'update');
                $('#myModal #form-permohonan #permohonan_id').val(permohonan_id);
            } else if (path.search('/pemakaian') > 0) {
                var pemakaian_id = getUrlVars()['id'];
                var pemakaian_detail = getJSON('http://'+host+path+'/action/ambil', { id: pemakaian_id });

                $('#myModal .modal-body #catatan').val(pemakaian_detail.data['catatan']);
                $('#myModal .modal-body #berangkat').val(pemakaian_detail.data['berangkat']);
                $('#myModal .modal-body #kembali').val(pemakaian_detail.data['kembali']);
                $('#myModal .modal-body #km_awal').val(pemakaian_detail.data['km_awal']);
                $('#myModal .modal-body #km_akhir').val(pemakaian_detail.data['km_akhir']);
                $('#myModal .modal-body #kode_pemakaian').val(pemakaian_detail.data['kode_pemakaian']);
                $('#myModal .modal-header #myModalLabel').text('Edit Pemakaian');
                $('#myModal .modal-footer #submit-pemakaian').text('OK');
                $('#myModal #form-pemakaian').attr('action', 'update');
                $('#myModal #form-pemakaian #pemakaian_id').val(pemakaian_id);
            } else if (path.search('/mobil') > 0) {
                var mobil_id = getUrlVars()['id'];
                var mobil_detail = getJSON('http://'+host+path+'/action/ambil', { id: mobil_id });

                $('#myModal .modal-body #mobil').val(mobil_detail.data['mobil']);
                $('#myModal .modal-body #nopol').val(mobil_detail.data['nopol']);
                $('#myModal .modal-body #tipe').val(mobil_detail.data['tipe']);
                $('#myModal .modal-body #merk').val(mobil_detail.data['merk']);
                $('#myModal .modal-body #mobil_id').val(mobil_detail.data['mobil_id']);
                $('#myModal .modal-header #myModalLabel').text('Edit Mobil');
                $('#myModal .modal-footer #submit-mobil').text('OK');
                $('#myModal #form-mobil').attr('action', 'update');
                $('#myModal #form-mobil #mobil_id').val(mobil_id);
            } else if (path.search('/user') > 0) {
                var user_id = getUrlVars()['id'];
                var user_detail = getJSON('http://'+host+path+'/action/ambil', { id: user_id });

                $('#myModal .modal-body #username').val(user_detail.data['username']);
                $('#myModal .modal-body #password').val();
                $('#myModal .modal-body #password').after('<p class="help-block warning">kosongkan jika tidak ingin mengubah password</p>');
                $('#myModal .modal-body #email').val(user_detail.data['email']);
                $('#myModal .modal-body #group').val(user_detail.data['group']);
                $('#myModal .modal-body #user_id').val(user_detail.data['user_id']);
                $('#myModal .modal-header #myModalLabel').text('Edit User');
                $('#myModal .modal-footer #submit-user').text('OK');
                $('#myModal #form-user').attr('action', 'update');
                $('#myModal #form-user #user_id').val(user_id);
            }
            $('#myModal').modal('show');
        } else if (hash.search('hapus') == 0) {
            if (path.search('/mobil') > 0) {
                var mobil_id = getUrlVars()['id'];
                $('#myModal form').hide();
                $('#myModal .modal-header #myModalLabel').text('Hapus Mobil');
                $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus mobil?</p>');
                $('#myModal .modal-footer #submit-mobil').text('OK');
                $('#myModal #form-mobil').attr('action', 'hapus');
                $('#myModal #form-mobil #mobil_id').val(mobil_id);
            } else if (path.search('/user') > 0) {
                var user_id = getUrlVars()['id'];
                var user_detail = getJSON('http://'+host+path+'/action/ambil', { id: user_id });

                $('#myModal form').hide();
                $('#myModal .modal-header #myModalLabel').text('Hapus User');
                $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus user: <b>'+user_detail.data['username']+'</b>?</p>');
                $('#myModal .modal-footer #submit-user').text('OK');
                $('#myModal #form-user').attr('action', 'hapus');
                $('#myModal #form-user #user_id').val(user_id);
            }
            $('#myModal').modal('show');
        } else if (hash.search('ambil') == 0) {
            if (path.search('/permohonan') > 0) {
                var hal_aktif = null;
                var hash = getUrlVars();
                if (hash['hal']) {
                    hal_aktif = hash['hal'];
                }

                load_permohonan(hal_aktif, true);
                $("ul#pagination-permohonan li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
            } else if (path.search('/user') > 0) {
                var hal_aktif, cari = null;
                var hash = getUrlVars();
                if (hash['cari'] && hash['hal']) {
                    hal_aktif = hash['hal'];
                    cari = hash['cari'];
                } else if (hash['hal']) {
                    hal_aktif = hash['hal'];
                }

                load_user(hal_aktif, true, cari);
                $("ul#pagination-user li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');
            }
        } else if (hash.search('tolak') == 0) {
            if (path.search('/permohonan') > 0) {
                var permohonan_id = getUrlVars()['id'];
                $('#myModal form').hide();
                $('#myModal .modal-header #myModalLabel').text('Menolak Permohonan');
                $('#myModal .modal-body').prepend('<p id="hapus-notif">Anda akan menolak permohonan. Aksi ini tidak dapat diulangi.</p>');
                $('#myModal .modal-footer #submit-permohonan').text('OK');
                $('#myModal #form-permohonan').attr('action', 'tolak');
                $('#myModal #form-permohonan #permohonan_id').val(permohonan_id);
            }
            $('#myModal').modal('show');
        }
    });

    $(window).trigger('hashchange');

    /* Yang dilakukan ketika menutup modal */
    $('#myModal').on('hidden', function() {
        window.history.pushState(null, null, path);
        $('#myModal #hapus-notif').remove();
        $('#myModal #myMap').remove();
        $('#myModal form').find("input[type=text], input[type=hidden], input[type=password], input[type=email]").val("").attr('placeholder', '');
        $('#myModal form').find("select").prop("selected", false);
        $('#myModal form p.warning').remove();
        $('#myModal form').show();
    });

    /* PENCARIAN */
    $(document).on('keyup', '#search', function() {
        delay(function() {
            var searchkey = $('#search').val();
            window.location.hash = "#ambil?cari="+searchkey+"&hal=1";
        }, 1000);
    });

    moment.locale('id');

    /* 
     * BACKEND BAGIAN PERMOHONAN
     */
    $(document).on('click', '#submit-permohonan', function(eve) {
        eve.preventDefault();
        var action = $('#form-permohonan').attr('action');
        var datatosend = $('#form-permohonan').serialize();

        $('#myModal').modal('hide');

        $.ajax('http://'+host+path+'/action/'+action, {
            dataType: 'json',
            type: 'POST',
            data: datatosend,
            success: function(data) {
                if (data.response == 'success') {
                    load_permohonan(null, false);
                    $('div.widget-content').prepend(
                        '<div class="control-group">'+
                            '<div class="alert alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                '<strong>Berhasil!</strong> Permohonan telah diperbarui'+
                            '</div>'+
                        '</div>'
                    );
                } else {
                    $.each(data.errors, function(key, value) {
                        $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    load_permohonan();

    /* 
     * BACKEND BAGIAN PEMAKAIAN
     */
    $(document).on('click', '#submit-pemakaian', function(eve) {
        eve.preventDefault();
        var action = $('#form-pemakaian').attr('action');
        var datatosend = $('#form-pemakaian').serialize();

        $('#myModal').modal('hide');

        $.ajax('http://'+host+path+'/action/'+action, {
            dataType: 'json',
            type: 'POST',
            data: datatosend,
            success: function(data) {
                if (data.response == 'success') {
                    load_pemakaian(null, false);
                    $('div.widget-content').prepend(
                        '<div class="control-group">'+
                            '<div class="alert alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                '<strong>Berhasil!</strong> Pemakaian telah diperbarui'+
                            '</div>'+
                        '</div>'
                    );
                } else {
                    $.each(data.errors, function(key, value) {
                        $('#'+key).attr('placeholder', value);
                    });
                }
            }
        });
    });

    load_pemakaian(null, false);

    /* 
     * BACKEND BAGIAN PERMOHONAN
     */
    $(document).on('click', '#submit-mobil', function(eve) {
        eve.preventDefault();
        $('#myModal form p.warning').remove();

        var action = $('#form-mobil').attr('action');
        var datatosend = $('#form-mobil').serialize();

        $.ajax('http://'+host+path+'/action/'+action, {
            dataType: 'json',
            type: 'POST',
            data: datatosend,
            success: function(data) {
                if (data.response == 'success') {
                    $('#myModal').modal('hide');
                    load_mobil(null, false);

                    $('div.widget-content').prepend(
                        '<div class="control-group">'+
                            '<div class="alert alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                '<strong>Berhasil!</strong> Mobil telah diperbarui'+
                            '</div>'+
                        '</div>'
                    );
                } else {
                    $.each(data.errors, function(key, value) {
                        $('#'+key).after('<p class="help-block warning">'+value+'</p>');
                    });
                }
            }
        });
    });

    load_mobil(null, false);

    /* 
     * BACKEND BAGIAN USER
     */
    $(document).on('click', '#submit-user', function(eve) {
        eve.preventDefault();
        $('#myModal form p.warning').remove();

        var action = $('#form-user').attr('action');
        var datatosend = $('#form-user').serialize();

        $.ajax('http://'+host+path+'/action/'+action, {
            dataType: 'json',
            type: 'POST',
            data: datatosend,
            success: function(data) {
                if (data.response == 'success') {
                    $('#myModal').modal('hide');
                    load_user(null, false);

                    $('div.widget-content').prepend(
                        '<div class="control-group">'+
                            '<div class="alert alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                '<strong>Berhasil!</strong> User telah diperbarui.'+
                            '</div>'+
                        '</div>'
                    );
                } else {
                    $.each(data.errors, function(key, value) {
                        $('#'+key).after('<p class="help-block warning">'+value+'</p>');
                    });
                }
            }
        });
    });

    load_user();

    /* ==================== ==================== =================== */

    /* MENCEGAH SUBMIT MENGGUNAKAN ENTER SAAT INPUT */
    $(document).on('submit', '#myModal form', function(eve) {
        eve.preventDefault();
    });  
});

/* =================================================== */
/*                  KUMPULAN FUNCTION                  */
/* =================================================== */

function load_permohonan(hal_aktif, scrolltop) {
    if ($('table#tbl-permohonan').length > 0) {
        $.ajax('http://'+host+path+'/action/ambil', {
            dataType: 'json',
            type: 'POST',
            data: { hal_aktif: hal_aktif },
            success: function(data) {
                $('table#tbl-permohonan tbody tr').remove();
                if (data.record.length > 0) {
                    $.each(data.record, function(index, element) {
                        $('table#tbl-permohonan').find('tbody').append(
                            '<tr>'+
                                '<td class="text-center">'+element.username+'</td>'+
                                '<td class="text-center">'+element.tujuan+'</td>'+
                                '<td class="text-center">'+element.keperluan+'</td>'+
                                '<td class="text-center">'+element.jum_penumpang+'</td>'+
                                '<td class="text-center">'+moment(element.created_on).format('L')+'</td>'+
                                '<td class="text-center">'+moment(element.tgl_pemakaian).format('L')+'</td>'+
                                '<td class="text-center">'+element.lama_pemakaian+'</td>'+
                                '<td class="text-center">'+element.dasar_pemakaian+'</td>'+
                                '<td class="td-actions text-center">'+
                                    '<a href="permohonan#edit?id='+element.permohonan_id+'" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i> Terima</a> '+
                                    '<a href="permohonan#tolak?id='+element.permohonan_id+'" class="btn btn-small btn-danger"><i class="btn-icon-only icon-remove" id="hapus_1"></i> Tolak</a> '+
                                '</td>'+
                            '</tr>'
                        )
                    });

                    /* BAGIAN UNTUK PAGINATION */
                    var pagination = '';
                    var paging = Math.ceil(data.total_rows/data.perpage);

                    if ((!hal_aktif) && ($('ul#pagination-permohonan li').length == 0)) {
                        $('ul#pagination-permohonan li').remove();
                        for (i = 1; i <= paging; i++) {
                            pagination = pagination + '<li><a href="permohonan#ambil?hal='+i+'">'+i+'</a></li>';
                        }
                    }

                    $('ul#pagination-permohonan').append(pagination);
                    $("ul#pagination-permohonan li:contains('"+hal_aktif+"')").addClass('active');
                } else {
                    $('table#tbl-permohonan').find('tbody').append(
                        '<tr><td class="text-center" colspan="9" style="color: red">Tidak ada permohonan</td></tr>')
                }

                if (scrolltop == true) { $('body').scrollTop(0); }
            }
        });
    }
}

function load_pemakaian(hal_aktif, scrolltop) {
    if ($('table#tbl-pemakaian').length > 0) {
        $.ajax('http://'+host+path+'/action/ambil', {
            dataType: 'json',
            type: 'POST',
            data: { hal_aktif:hal_aktif },
            success: function(data) {
                $('table#tbl-pemakaian tbody tr').remove();
                if (data.total_rows > 0) {
                    $.each(data.record, function(index, element) {
                        $('table#tbl-pemakaian').find('tbody').append(
                            '<tr>'+
                                '<td class="text-center">'+element.username+'</td>'+
                                '<td class="text-center"><a class="link-edit" href="pemakaian/show_map?id='+element.pemakaian_id+'" target="_blank">'+element.tujuan+'</a></td>'+
                                '<td class="text-center">'+moment(element.tgl_pemakaian).format('L')+'</td>'+
                                '<td class="text-center">'+element.nopol+'</td>'+
                                '<td class="text-center">'+element.berangkat+'</td>'+
                                '<td class="text-center">'+element.kembali+'</td>'+
                                '<td class="text-center">'+element.km_awal+'</td>'+
                                '<td class="text-center">'+element.km_akhir+'</td>'+
                                '<td class="text-center">'+element.kode_pemakaian+'</td>'+
                                '<td class="td-actions text-center">'+
                                    '<a href="pemakaian#edit?id='+element.pemakaian_id+'" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i> Edit</a> '+
                                    '<a href="pemakaian/print_pemakaian?id='+element.pemakaian_id+'" target="_blank" class="btn btn-small btn-warning"><i class="btn-icon-only icon-print"></i> Print</a> '+
                                '</td>'+
                            '</tr>'
                        )
                    });
                    /* BAGIAN UNTUK PAGINATION */
                    var pagination = '';
                    var paging = Math.ceil(data.total_rows/data.perpage);

                    if ((!hal_aktif) && ($('ul#pagination-pemakaian li').length == 0)) {
                        $('ul#pagination-pemakaian li').remove();
                        for (i = 1; i <= paging; i++) 
                            pagination = pagination + '<li><a href="pemakaian#ambil?hal='+i+'">'+i+'</a></li>';
                    }
                    $('ul#pagination-pemakaian').append(pagination);
                    $("ul#pagination-pemakaian li:contains('"+hal_aktif+"')").addClass('active');
                } else 
                    $('table#tbl-pemakaian').find('tbody').append(
                        '<tr><td class="text-center" colspan="10" style="color: red">Tidak ada pemakaian</td></tr>')
                if (scrolltop == true) 
                    $('body').scrollTop(0);
            }
        });
    }
}

function load_mobil(hal_aktif, scrolltop) {
    if ($('table#tbl-mobil').length > 0) {
        $.ajax('http://'+host+path+'/action/ambil', {
            dataType: 'json',
            type: 'POST',
            data: { hal_aktif:hal_aktif },
            success: function(data) {
                $('table#tbl-mobil tbody tr').remove();
                if (data.total_rows > 0) {
                    $.each(data.record, function(index, element) {
                        $('table#tbl-mobil').find('tbody').append(
                            '<tr>'+
                                '<td class="text-center">'+element.mobil+'</td>'+
                                '<td class="text-center">'+element.nopol+'</td>'+
                                '<td class="text-center">'+element.tipe+'</td>'+
                                '<td class="text-center">'+element.merk+'</td>'+
                                '<td class="td-actions text-center" width="18%">'+
                                    '<a href="mobil#edit?id='+element.mobil_id+'" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i> Edit</a> '+
                                    '<a href="mobil#hapus?id='+element.mobil_id+'" class="btn btn-small btn-danger"><i class="btn-icon-only icon-remove" id="hapus_1"></i> Hapus</a> '+
                                '</td>'+
                            '</tr>'
                        )
                    });
                    /* BAGIAN UNTUK PAGINATION */
                    var pagination = '';
                    var paging = Math.ceil(data.total_rows/data.perpage);

                    if ((!hal_aktif) && ($('ul#pagination-mobil li').length == 0)) {
                        $('ul#pagination-mobil li').remove();
                        for (i = 1; i <= paging; i++) 
                            pagination = pagination + '<li><a href="mobil#ambil?hal='+i+'">'+i+'</a></li>';
                    }
                    $('ul#pagination-mobil').append(pagination);
                    $("ul#pagination-mobil li:contains('"+hal_aktif+"')").addClass('active');
                } else 
                    $('table#tbl-mobil').find('tbody').append(
                        '<tr><td class="text-center" colspan="8" style="color: red">Tidak ada mobil</td></tr>')
                if (scrolltop == true) 
                    $('body').scrollTop(0);
            }
        });
    }
}

function load_user(hal_aktif, scrolltop, cari) {
    if ($('table#tbl-user').length > 0) {
        $.ajax('http://'+host+path+'/action/ambil', {
            dataType: 'json',
            type: 'POST',
            data: { hal_aktif: hal_aktif, cari: cari },
            success: function(data) {
                $('table#tbl-user tbody tr').remove();
                $.each(data.record, function(index, element) {
                    $('table#tbl-user').find('tbody').append(
                        '<tr>'+
                            '<td><img src="http://'+host+path.replace('user', 'assets/images/')+'user.png"/> <a class="link-edit" href="user#edit?id='+element.user_id+'">'+element.username+'</a></td>'+
                            '<td><i class="icon-envelope"></i> <span class="value">'+element.email+'</span></td>'+
                            '<td><i class="icon-group"></i> <span class="value">'+element.group+'</span></td>'+
                            '<td width="16%" class="td-actions text-center">'+
                                '<a href="user#edit?id='+element.user_id+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> '+
                                '<a href="user#hapus?id='+element.user_id+'" class="btn btn-invert btn-small btn-danger"><i class="btn-icon-only icon-remove" id="hapus_1"></i> Hapus</a>'+
                            '</td>'+
                        '</tr>'
                    )
                });

                /* BAGIAN UNTUK PAGINATION */
                var pagination = '';
                var paging = Math.ceil(data.total_rows/data.perpage);

                if ((!hal_aktif) && ($('ul#pagination-user li').length == 0)) {
                    $('ul#pagination-user li').remove();
                    for (i = 1; i <= paging; i++) {
                        pagination = pagination + '<li><a href="user#ambil?hal='+i+'">'+i+'</a></li>';
                    }
                } else if (hal_aktif && cari) {
                    $('ul#pagination-user li').remove();
                    for (i = 1; i <= paging; i++) {
                        pagination = pagination + '<li><a href="user#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
                    }  
                }

                $('ul#pagination-user').append(pagination);
                $("ul#pagination-user li:contains('"+hal_aktif+"')").addClass('active');

                if (scrolltop == true) { $('body').scrollTop(0); }
            }
        });
    }
}

function getJSON(url, data) {
    return JSON.parse($.ajax({
        type: 'POST',
        url : url,
        data: data,
        dataType: 'json',
        global: false,
        async: false,
        success: function(msg) {

        }
    }).responseText);
}

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }

    return vars;
}

function initMap() {
    var pemakaian_id = getUrlVars()['id'];
    var loc = getJSON('http://'+host+path+'/getLoc', { id: pemakaian_id });
    var latitude = parseFloat(loc.data[0]['lat']);
    var longitude = parseFloat(loc.data[0]['lng']);

    var posisi = {lat: latitude, lng: longitude}
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: posisi
    });
    var marker = new google.maps.Marker({position: posisi, map: map});
}
