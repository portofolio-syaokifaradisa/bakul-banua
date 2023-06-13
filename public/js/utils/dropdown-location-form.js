document.addEventListener("DOMContentLoaded", function(){
    document.getElementById('province').addEventListener('mousedown', setProvinceDropdown);
    document.getElementById('city').addEventListener('mousedown', setCityDropdown);
});

async function setProvinceDropdown(){
    const response = await fetch(`https://dev.farizdotid.com/api/daerahindonesia/provinsi`);
    const json = await response.json();

    dropdownData = '';
    dropdownData += `<option value="-" hidden selected>Pilih Provinsi</option>`;
    for(var data of json.provinsi){
        dropdownData += `<option value="${data.id}.${data.nama}">${data.nama}</option>`;
    }

    document.getElementById('province').innerHTML = dropdownData;
}

async function setCityDropdown(evt){
    var provinceId = document.getElementById('province').value.split('.')[0];
    if(provinceId){
        const response = await fetch(`http://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${provinceId}`);
        const json = await response.json();

        dropdownData = '';
        dropdownData += `<option value="-" hidden selected>Pilih Kabupaten</option>`;
        for(var data of json.kota_kabupaten){
            dropdownData += `<option value="${data.nama}">${data.nama}</option>`;
        }

        document.getElementById('city').innerHTML = dropdownData;
    }
}