var DropzoneDemos = function () {
    Dropzone.options.singleFileUpload = {
        paramName: "foto_ktp", // Menyesuaikan dengan nama parameter dalam controller
        maxFiles: 1,
        maxFilesize: 5,
        accept: function(file, done) {
            if (file.type !== 'image/png' && file.type !== 'image/jpeg' && file.type !== 'application/pdf') {
                done("File harus berupa gambar PNG, JPEG, atau PDF.");
            } else if (file.size > 5 * 1024 * 1024) {
                done("Ukuran file melebihi batas maksimum (5MB).");
            } else {
                done();
            }
        },
        init: function() {
            this.on("success", function(file, response) {
                console.log(response);
                // Lakukan tindakan setelah berhasil mengunggah file
            });
            this.on("error", function(file, errorMessage) {
                console.error(errorMessage);
                // Lakukan tindakan jika terjadi kesalahan saat mengunggah file
            });
        }
    };
};