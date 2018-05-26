var uploader = new qq.FineUploader({
    debug: true,
    element: document.getElementById('fine-uploader'),
    request: {
        endpoint: 'index.php?c=bolsa_trabajo&a=request_operation&operacion=upload_file'
    },
    deleteFile: {
        method: 'POST',
        enabled: true,
        endpoint: 'index.php?c=bolsa_trabajo&a=request_operation&operacion=upload_file'
    },
    retry: {
        enableAuto: true
    }
});


///recuperar datos subida
uploader.getUploads('id')[0].uuid;
uploader.getUploads('id')[0].name;