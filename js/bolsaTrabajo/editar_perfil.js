var uploader = new qq.FineUploader({
    debug: true,
    element: document.getElementById('fine-uploader'),
    request: {
        endpoint: '/uploads'
    },
    deleteFile: {
        enabled: true,
        endpoint: '/uploads'
    },
    retry: {
        enableAuto: true
    }
});