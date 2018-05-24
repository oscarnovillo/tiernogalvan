var uploader = new qq.FineUploader({
    debug: true,
    element: document.getElementById('fine-uploader'),
    request: {
        endpoint: 'index.php?c=bolsa_trabajo&a=request_operation&operacion=upload_file'
    },
    deleteFile: {
        enabled: true,
        endpoint: '/uploads'
    },
    retry: {
        enableAuto: true
    }
});