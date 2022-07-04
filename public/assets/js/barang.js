get_icon_data($('#show_data').val())

$('#show_data').on('change', function() {
    get_all()
});

$('#modal-tambah-barang').on('click', function() {
    create_barang();
})

$('#reset-tambah').on('click', function() {
    reset_form_tambah_barang();
})

$('#table').on('click', function() {
    get_tb_data($('#show_data').val());
    $('#tb-barang').removeClass('d-none');
    $('#icon-barang').addClass('d-none');
    $('#icon-content').empty();
})

$('#icon').on('click', function() {
    get_icon_data($('#show_data').val());
    $('#tb-barang').addClass('d-none');
    $('#icon-barang').removeClass('d-none');
    $('#tb-content').empty();
})

function reset_form_tambah_barang() {
    $('#tambah_kode_barang').val('');
    $('#tambah_nama_barang').val('');
    $('#tambah_desc').val('');
}

function get_all() {
    if($('#tb-barang').hasClass('d-none')) {
        get_icon_data($('#show_data').val())
    }
    else if($('#icon-barang').hasClass('d-none')) {
        get_tb_data($('#show_data').val());
    }
}
function get_tb_data(number, page) {
    $('#tb-content').empty();
    $('#tb-total-entry').empty();
    $('#tb-paginate').empty();
    $.ajax({
        type: 'get',
        url: base_url+'/api/product/get',
        dataType: 'json',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        data: {
            'number': number,
            'page': page,
        },
        success: function(resp) {
            let count = 1
            $.each(resp.data, function(idx, value) {
                var td = `
                    <tr>
                        <td>${count}</td>
                        <td>${value.id}</td>
                        <td>${value.kode_barang}</td>
                        <td>${value.nama_barang}</td>
                        <td>${value.desc}</td>
                        <td>
                            <button class="btn btn-warning btn-sm tb-edit" data-id="${value.id}"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm tb-delete" data-id="${value.id}"><i class="fas fa-trash"></i></button>

                        </td>
                    </tr>
                    `;
                count += 1;
                $('#tb-content').append(td);
            });

            let total_entry = `Menampilkan ${resp.data.length} dari ${resp.total} data`;
            $('#tb-total-entry').html(total_entry);

            let paginate = ``;
            for(let i=1; i<=resp.last_page; i++) {
                let active = resp.current_page == i ? 'font-weight-bold' : '';
                paginate += `
                    <a href="javascript:void(0);" class="border rounded px-2 py-1 tb-paginate-show mr-1 ${active}" page=${i}>${i}</a>
                `;
            }
            $('#tb-paginate').html(paginate);

            $('.tb-paginate-show').on('click', function() {
                if($(this).attr('page') == resp.current_page) {
                    return
                }
                get_tb_data($('#show_data').val(), $(this).attr('page'));
            })

            $('.tb-edit').on('click', function() {
                edit_data($(this).attr('data-id'));
            });

            $('.tb-delete').on('click', function() {
                delete_data($(this).attr('data-id'));
            })
        },
        error: function(resp) {
            if(resp.responseJSON.code == 'token') {
                alert(resp.responseJSON.message);
                window.location.replace(base_url+'/');
            }
            else {
                alert(resp.responseJSON);
            }
        }
    });
}

function get_icon_data(number, page) {
    $('#icon-content').empty();
    $('#icon-paginate').empty();
    $.ajax({
        type: 'get',
        url: base_url+'/api/product/get',
        dataType: 'json',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        data: {
            'number': number,
            'page': page,
        },
        success: function(resp) {
            $.each(resp.data, function(idx, value) {
                let html = `
                <div class="col-sm-6 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h4>${value.nama_barang}</h4>
                            <p>Id: ${value.id}</p>
                            <p>Kode barang: ${value.kode_barang}</p>
                            <p>${value.desc}</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-warning btn-block icon-edit" id="icon-edit" data-id="${value.id}">Edit</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-danger btn-block icon-delete" id="icon-delete" data-id="${value.id}">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                $('#icon-content').append(html);
            });


            let paginate = ``;
            for(let i=1; i<=resp.last_page; i++) {
                let active = resp.current_page == i ? 'font-weight-bold' : '';
                paginate += `
                    <a href="javascript:void(0);" class="border rounded px-2 py-1 icon-paginate-show mr-1 ${active}" page=${i}>${i}</a>
                `;
            }
            $('#icon-paginate').html(paginate);

            $('.icon-paginate-show').on('click', function() {
                if($(this).attr('page') == resp.current_page) {
                    return
                }
                get_icon_data($('#show_data').val(), $(this).attr('page'));
            });

            $('.icon-edit').on('click', function() {
                edit_data($(this).attr('data-id'));
            });

            $('.icon-delete').on('click', function() {
                console.log('aaaa');
                delete_data($(this).attr('data-id'));
            })
        },
        error: function(resp) {
            if(resp.responseJSON.code == 'token') {
                alert(resp.responseJSON.message);
                window.location.replace(base_url+'/');
            }
            else {
                alert(resp.responseJSON);
            }
        }
    });
}

function create_barang() {
    let html = `
    <div class="modal-header">
        <h5 class="modal-title">Tambah Barang</h5>
        <button type="button" class="close cancel-tambah" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="tambah_barang">
        <div class="modal-body">

            <div class="form-group">
                Kode Barang:
                <input type="text" name="kode_barang" class="form-control select2" id="tambah_kode_barang" style="width:100%;">
            </div>
            <div class="form-group">
                Nama Barang:
                <input type="text" name="nama_barang" class="form-control select2 py-2" id="tambah_nama_barang" style="width:100%;">
            </div>
            <div class="form-group">
                Deskripsi:
                <input type="text" name="desc" class="form-control select2 py-2" id="tambah_desc" style="width:100%;">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger cancel-tambah">Close</button>
            <button type="button" class="btn btn-warning" id="reset-tambah">Reset</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    `
    $('#modal-barang-content').html(html);
    $('#modal-barang').modal('show');

    $('#tambah_barang').on('submit', function(event) {
        event.preventDefault();
        let data = new FormData(this);
        let object_data = {}
        data.forEach(function(value, key) {
            object_data[key] = value;
        });
        let json_data = JSON.stringify(object_data);
        store_data(json_data);
    });

    $('.cancel-tambah').on('click', function() {
        cancel_barang();
    });
}

function store_data(data) {
    $.post({
        url: base_url+'/api/product/store',
        dataType: 'json',
        contentType: 'application/json',
        data: data,
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            if(resp.success) {
                Swal.fire('Sukses', resp.message, 'success');
                get_all();
                $('#modal-barang').modal('hide');
                $('#modal-barang-content').empty();
            }
        },
        error: function(resp) {
            if(resp.responseJSON.code == 'token') {
                alert(resp.responseJSON.message);
                window.location.replace(base_url+'/');
            }
            else if(resp.responseJSON.code == 'barang'){
                Swal.fire('Error', resp.responseJSON.message, 'error');
            }
        }
    });
}

function show_data() {

}

function edit_data(id) {
    $('#modal-barang').modal('show');
    $.get({
        url: base_url+'/api/product/edit/'+id,
        dataType: 'json',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            let html = `
            <div class="modal-header">
                <h5 class="modal-title">Edit Barang</h5>
                <button type="button" class="close cancel-edit" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_barang">
                <div class="modal-body">
                    <div class="form-group">
                        Kode Barang:
                        <input type="text" name="kode_barang" class="form-control select2" id="edit_kode_barang" style="width:100%;" value="${resp.data.kode_barang}">
                    </div>
                    <div class="form-group">
                        Nama Barang:
                        <input type="text" name="nama_barang" class="form-control select2 py-2" id="edit_nama_barang" style="width:100%;" value="${resp.data.nama_barang}">
                    </div>
                    <div class="form-group">
                        Deskripsi:
                        <input type="text" name="desc" class="form-control select2 py-2" id="edit_desc" style="width:100%;" value="${resp.data.desc}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger cancel-edit">Close</button>
                    <button type="button" class="btn btn-warning" id="reset-tambah">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            `;

            $('#modal-barang-content').html(html);

            $('.cancel-edit').on('click', function() {
                cancel_barang();
            });

            $('#edit_barang').on('submit', function(event) {
                event.preventDefault();
                console.log($('#edit_kode_barang').val());
                let data = new FormData(this);
                let object_data ={'_method': 'put'}
                data.forEach(function(value, key) {
                    object_data[key] = value;
                });
                let json_data = JSON.stringify(object_data);
                update_data(id, json_data);
            })
        },
        error: function(resp) {
            if(resp.responseJSON.code == 'token') {
                alert(resp.responseJSON.message);
                window.location.replace(base_url+'/');
            }
            else if(resp.responseJSON.code == 'barang'){
                Swal.fire('Error', resp.responseJSON.message, 'error');
            }
        }
    })
}

function update_data(id, data) {
    console.log(data);

    $.post({
        url: base_url+'/api/product/update/'+id,
        dataType: 'json',
        contentType: 'application/json',
        data: data,
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            Swal.fire('Sukses', resp.message, 'success');
            get_all();
            $('#modal-barang').modal('hide');
            $('#modal-barang-content').empty();
        },
        error: function(resp) {
            if(resp.responseJSON.code == 'token') {
                alert(resp.responseJSON.message);
                window.location.replace(base_url+'/');
            }
            else if(resp.responseJSON.code == 'barang'){
                Swal.fire('Error', resp.responseJSON.message, 'error');
            }
        }
    });
}

function delete_data(id) {
    let data = JSON.stringify({'_method':'delete'});
    $.post({
        url: base_url+'/api/product/delete/'+id,
        dataType: 'json',
        contentType: 'application/json',
        data: data,
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            Swal.fire('Sukses', resp.message, 'success');
            get_all();
        },
        error: function(resp) {
            if(resp.responseJSON.code == 'token') {
                alert(resp.responseJSON.message);
                window.location.replace(base_url+'/');
            }
            else if(resp.responseJSON.code == 'barang'){
                Swal.fire('Error', resp.responseJSON.message, 'error');
            }
        }
    });
}

function cancel_barang() {
    $('#modal-barang-content').empty();
    $('#modal-barang').modal('hide');
}

function error_response(resp) {

}
