document.addEventListener("DOMContentLoaded", function(){
    const table = $("#umkm-datatable").dataTable({
        processing: true,
        serverSide: true,
        searching: true,
        dom: 'Brtip',
        ajax : `${window.location.href}/datatable`,
        columns: [
            { data: 'no', name: 'no', orderable: false, searchable: false },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                render: function(umkmId, type, order, meta){
                    const baseUrl = window.location.href;
                    return `
                        <div class="btn-group dropright px-0 pr-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropright">
                                <a class="dropdown-item has-icon" href="${baseUrl}/${umkmId}/detail">
                                    <i class="fas fa-info-circle"></i>
                                    Detail
                                </a>
                                <a class="dropdown-item has-icon" href="${baseUrl}/${umkmId}/edit">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item has-icon btn-delete" href="#" id="${umkmId}">
                                    <i class="fas fa-trash-alt"></i>
                                    Hapus
                                </a>
                            </div>
                        </div>
                    `;
                }
            },
            { data: 'name', name: 'name'},
            { data: 'since', name: 'since'},
            { data: 'nib', name: 'nib'},
            { 
                data: 'legality', 
                name: 'legality',
                orderable: false, 
                searchable: false,
                render: function(_, type, umkm, meta){
                    return `
                        <span class="mb-1 w-100 badge ${umkm.has_bpom ? 'badge-success' : 'badge-secondary'}">BPOM</span><br>
                        <span class="mb-1 w-100 badge ${umkm.has_pirt ? 'badge-success' : 'badge-secondary'}">PIRT</span><br>
                        <span class="w-100 badge ${umkm.has_halal ? 'badge-success' : 'badge-secondary'}">Halal</span>
                    `;
                }
            },
            { 
                data: 'owner', 
                name: 'owner',
                orderable: false, 
                searchable: false,
                render: function(_, type, umkm, meta){
                    return `
                        ${umkm.owner} <br>
                        ${umkm.phone} <br>
                        ${umkm.email}
                    `;
                }
            },
            { data: 'address', name: 'address'},
        ], 
        createdRow: function( row, data, dataIndex ){
            for(var i=1; i <= 8; i++){
                if([1, 2, 4, 5, 6].includes(i)){
                    $(row).children(`:nth-child(${i})`).addClass(`text-center align-middle`);
                }else{
                    $(row).children(`:nth-child(${i})`).addClass(`align-middle`);
                }
            }
        },
        initComplete: function () {
            this.api().columns().every(function () {
                var table = this;
    
                // Event Form Input
                $('input', this.footer()).on('keyup change clear', function () {
                    table.search(this.value).draw();
                });

                // Event Form Dropdown
                $('select', this.footer()).on('keyup change clear', function () {
                    table.search(this.value).draw();
                });
            });
        }
    }); 

    $('#umkm-datatable tfoot th').each(function (index) {
        var name = $(this).attr('id');
    
        if(["action", 'no', 'legalities'].includes(name)){
            $(this).text('');
        }else{
            var placeholder = $(this).text();
            $(this).html(`
                <div class="form-group">
                    <input type="text" class="form-control text-center" name="${name}" placeholder="Cari ${placeholder}" id="${name}-form" data-index="${index}">
                </div>
            `);
        }
    });

    $('#umkm-datatable').on('draw.dt', function (datatable) {
        const cancelButtons = datatable.target.getElementsByClassName('btn-delete');
        for(let button of cancelButtons){
            button.addEventListener('click', function(e){
                e.preventDefault();
    
                var productId = e.target.id;
                confirmAlert(
                    "Konfirmasi Penghapusan Produk",
                    "Apakah Anda Yakin ingin Menghapus Produk?",
                    async function(){
                        const response = await fetch(
                            `${window.location.href}/${productId}/delete`,
                            { method: "GET", headers: {'Content-Type': 'application/json'}}
                        );
            
                        var {status, title, message} = await response.json();
                        Swal.fire({icon: status, title: title, text: message});
                        if(status == 'success'){
                            table.api().ajax.reload(null, false);
                        }
                    }
                );
            });
        }
    });
});