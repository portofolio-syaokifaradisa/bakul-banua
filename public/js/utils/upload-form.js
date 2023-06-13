function setFileNameUploaded(){
    const fileForm = document.getElementById('uploaded-file-form');

    var fileName = '';
    if(fileForm.hasAttribute("multiple")){
        for(file of fileForm.files){
            fileName += (file.name + ", ");
        }
    }else{
        fileName = fileForm.value.split('\\').pop();
    }

    document.getElementById('uploaded-file-label').innerHTML = fileName;
}

document.addEventListener("DOMContentLoaded", function(){
    document.getElementById('uploaded-file-form').addEventListener('change', setFileNameUploaded);
});