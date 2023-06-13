document.addEventListener("DOMContentLoaded", function () {
    const table = $("#product-datatable").dataTable({
        processing: true,
        serverSide: true,
        searching: true,
        dom: "Brtip",
        ajax: `${window.location.href}/product/datatable`,
        columns: [
            { data: "no", name: "no", orderable: false, searchable: false },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
                render: function (productId, type, product, meta) {
                    const baseUrl = window.location.href;
                    return `
                        <div class="btn-group dropright px-0 pr-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropright">
                                <a class="dropdown-item has-icon" href="${baseUrl}/product/${productId}/edit">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item has-icon btn-delete" href="#" id="${productId}">
                                    <i class="fas fa-trash-alt"></i>
                                    Hapus
                                </a>
                            </div>
                        </div>
                    `;
                },
            },
            {
                data: "picture",
                name: "picture",
                orderable: false,
                searchable: false,
                render: function (pictures, type, order, meta) {
                    var element = "";
                    for (var i = 0; i < pictures.length; i++) {
                        element += `
                            <a href="${
                                pictures[i]
                            }" target="_blank">Foto Produk ${i + 1}</a><br>
                        `;
                    }

                    return element;
                },
            },
            { data: "name", name: "name" },
            { data: "price", name: "price" },
            { data: "description", name: "description" },
        ],
        createdRow: function (row, data, dataIndex) {
            for (var i = 1; i <= 6; i++) {
                if ([1, 2, 3, 5].includes(i)) {
                    $(row)
                        .children(`:nth-child(${i})`)
                        .addClass(`text-center align-middle`);
                } else {
                    $(row)
                        .children(`:nth-child(${i})`)
                        .addClass(`align-middle`);
                }
            }
        },
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var table = this;

                    // Event Form Input
                    $("input", this.footer()).on(
                        "keyup change clear",
                        function () {
                            table.search(this.value).draw();
                        }
                    );

                    // Event Form Dropdown
                    $("select", this.footer()).on(
                        "keyup change clear",
                        function () {
                            table.search(this.value).draw();
                        }
                    );
                });
        },
    });

    $("#product-datatable tfoot th").each(function (index) {
        var name = $(this).attr("id");

        if (["action", "no", "picture"].includes(name)) {
            $(this).text("");
        } else {
            var placeholder = $(this).text();
            $(this).html(`
                <div class="form-group">
                    <input type="text" class="form-control text-center" name="${name}" placeholder="Cari ${placeholder}" id="${name}-form" data-index="${index}">
                </div>
            `);
        }
    });

    $("#product-datatable").on("draw.dt", function (datatable) {
        const cancelButtons =
            datatable.target.getElementsByClassName("btn-delete");
        for (let button of cancelButtons) {
            button.addEventListener("click", function (e) {
                e.preventDefault();

                var productId = e.target.id;
                confirmAlert(
                    "Konfirmasi Penghapusan Produk",
                    "Apakah Anda Yakin ingin Menghapus Produk?",
                    async function () {
                        const response = await fetch(
                            `${window.location.href}/product/${productId}/delete`,
                            {
                                method: "GET",
                                headers: { "Content-Type": "application/json" },
                            }
                        );

                        var { status, title, message } = await response.json();
                        Swal.fire({
                            icon: status,
                            title: title,
                            text: message,
                        });
                        if (status == "success") {
                            table.api().ajax.reload(null, false);
                        }
                    }
                );
            });
        }
    });
});
