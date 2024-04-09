<script>
    $(document).ready(function() {
        $(".show_modal").click(function() {
            let id = $(this).data("id")
            let token = $("input[name=_token]").val();

            $.ajax({
                type: "GET",
                url: "barangs/json/" + id,
                data: {
                    id: id,
                    _token: token
                },
                success: function(data) {
                    $("#modalLabel").html(data.data.name)
                    $("#item_code").val(data.data.item_code)
                    $("#register").val(data.data.register)
                    $("#mata_pelajarans_id").html(data.data.mata_pelajarans_id)
                    $("#name").html(data.data.name)
                    $("#brand").val(data.data.brand)
                    $("#material").val(data.data.material)
                    $("#year_of_purchase").val(data.data.year_of_purchase)
                    $("#school_operational_assistance_id").html(data.data.school_operational_assistance_id)
                    $("#quantity").val(data.data.quantity)
                    $("#price").val(data.data.price)
                    $("#status").val(data.data.status)
                    $("#note").html(data.data.note)
                }
            })
        })

        $("form[name='commodity_create']").submit(function(e) {
            e.preventDefault();

            // Membuat FormData object dan menambahkan nilai ke dalamnya
            var formData = new FormData(this); // 'this' merujuk ke form yang di-submit

            $.ajax({
                type: "POST",
                url: "barangs/json",
                data: formData,
                processData: false, // Memberitahu jQuery untuk tidak memproses data
                contentType: false, // Memberitahu jQuery untuk tidak mengatur contentType
                success: function(data) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Data berhasil ditambahkan.",
                        icon: "success",
                        timerProgressBar: true,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                            timerInterval = setInterval(() => {
                                const content = Swal.getContent();
                                if (content) {
                                    const b = content.querySelector("b");
                                    if (b) {
                                        b.textContent = Swal.getTimerLeft();
                                    }
                                }
                            }, 100);
                        },
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                },
                error: function(data) {
                    console.log('Gagal');
                    console.log(data);
                }
            });
        });


        $(".swal-edit-button").click(function() {
            let id = $(this).data("id");
            let token = $("input[name=_token]").val();

            // Injecting an id with relevant data on click for updating on #swal-update-button
            $("#swal-update-button").attr("data-id", id);

            $.ajax({
                url: "barangs/json/" + id + "/edit",
                type: "GET",
                data: {
                    id: id,
                    _token: token
                },
                success: function(data) {
                    const {
                        barangs: barang,
                        mata_pelajarans,
                        conditions
                    } = data.data;

                    var baseUrl = "/assets/img/dokumen/";
                    if (barang.status) { // Memastikan status tidak kosong
                        var fullUrl = baseUrl + barang.status; // Gabungkan baseUrl dengan nama file dari status
                        $('#status_edit').html(`<a href="${fullUrl}" target="_blank">${barang.status}</a>`);
                    } else {
                        $('#status_edit').html('Tidak ada dokumen');
                    }

                    conditions.forEach(function(condition, index) {
                        i = index + 1
                        $('#condition_edit').append(`<option value="${i}"${i === barang.condition ? ' selected' : ''}>${condition}</option>`)
                    });

                    mata_pelajarans.forEach(function(mata_pelajarans) {
                        $('#mata_pelajarans_id_edit').append(`<option value="${mata_pelajarans.id}"${mata_pelajarans.id === barang.mata_pelajarans_id ? ' selected' : ''}>${mata_pelajarans.name}</option>`)
                    });


                    $("#name_edit").val(barang.name)
                    $("#mata_pelajarans_id_edit").val(barang.mata_pelajarans_id)
                    $("#jabatan_edit").val(barang.jabatan)
                    $("#condition_edit").val(barang.condition)
                    $("#note_edit").val(barang.note)
                    $("#status_edit").val(barang.status)
                    $("#created_at_edit").val(barang.created_at)
                },
                error: function(data) {
                    Swal.fire("Gagal!", "Tidak dapat melihat info kategori buku.", "warning");
                }
            });
        });

        $("#swal-update-button").click(function(e) {
            e.preventDefault();
            // Get id injected by .swal-edit-button
            let id = $("#swal-update-button").attr("data-id");
            let token = $("input[name=_token]").val();

            let name = $("#name_edit").val();
            let description = $("#description_edit").val();

            $.ajax({
                url: "barangs/json/" + id,
                type: "PUT",
                data: {
                    _token: token,
                    school_operational_assistance_id: $("#school_operational_assistance_id_edit").val(),
                    mata_pelajarans_id: $("#mata_pelajarans_id_edit").val(),
                    item_code: $("#item_code_edit").val(),
                    register: $("#register_edit").val(),
                    name: $("#name_edit").val(),
                    brand: $("#brand_edit").val(),
                    material: $("#material_edit").val(),
                    year_of_purchase: $("#year_of_purchase_edit").val(),
                    condition: $("#condition_edit").val(),
                    quantity: $("#quantity_edit").val(),
                    price: $("#price_edit").val(),
                    price_per_item: $("#price_per_item_edit").val(),
                    note: $("#note_edit").val(),
                },
                success: function(data) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Data berhasil diubah.",
                        icon: "success",
                        timerProgressBar: true,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                            timerInterval = setInterval(() => {
                                const content = Swal.getContent();
                                if (content) {
                                    const b = content.querySelector("b");
                                    if (b) {
                                        b.textContent = Swal.getTimerLeft();
                                    }
                                }
                            }, 100);
                        },
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 800)
                },
                error: function(data) {
                    Swal.fire("Gagal!", "Tidak dapat mengubah data.", "warning");
                }
            });
        });

        $(".swal-delete-button").click(function() {
            Swal.fire({
                title: "Hapus?",
                text: "Data tidak akan bisa dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.value) {
                    let id = $(this).data("id");
                    let token = $("input[name=_token]").val();
                    $.ajax({
                        url: "barangs/json/" + id,
                        type: "DELETE",
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function(data) {
                            Swal.fire({
                                title: "Berhasil",
                                text: "Data berhasil dihapus.",
                                icon: "success",
                                timerProgressBar: true,
                                onBeforeOpen: () => {
                                    Swal.showLoading();
                                    timerInterval = setInterval(() => {
                                        const content = Swal.getContent();
                                        if (content) {
                                            const b = content.querySelector("b");
                                            if (b) {
                                                b.textContent = Swal.getTimerLeft();
                                            }
                                        }
                                    }, 100);
                                },
                                showConfirmButton: false
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        },
                        error: function(data) {
                            Swal.fire("Gagal!", "Data gagal dihapus.", "warning");
                        }
                    });
                }
            });
        });

        $(".swal-reject-button").click(function() {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data tidak akan bisa dikembalikan setelah diubah.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, ubah saja!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data("id");
                    let token = $("input[name=_token]").val();
                    $.ajax({
                        url: "barangs/json/" + id, // Sesuaikan dengan URL endpoint Anda
                        type: "POST", // Atau PATCH tergantung konfigurasi server Anda
                        data: {
                            _token: token,
                            condition: 3, // Mengubah kondisi menjadi 3
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Data berhasil diubah.",
                                icon: "success"
                            }).then(() => {
                                location.reload(); // Reload halaman untuk melihat perubahan
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Gagal!", "Terjadi kesalahan, data gagal diubah.", "error");
                        }
                    });
                }
            });
        });



    })
</script>