(function ($) {
    "use strict";
    $("#basicScenario").jsGrid({
        width: "100%",
        filtering: true,
        editing: true,
        inserting: true,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,
        pageButtonCount: 5,
        deleteConfirm: "Do you really want to delete the client?",
        controller: db,
        fields: [
            { name: "Task", type: "text", width: 150 },
            { name: "Email", type: "text", width: 200 },
            { name: "Phone", type: "text", width: 150 },
            { name: "Assign", type: "text", width: 160 },
            { name: "Date", type: "text", width: 150 },
            { name: "Price", type: "text", width: 100 },
            { name: "Status", type: "html", width: 150 },
            { name: "Progress", type: "text", width: 100 },
            { type: "control", width: 80 },
        ],
    });
    $("#sorting-table").jsGrid({
        height: "500px",
        width: "100%",
        autoload: true,
        sorting: true,
        selecting: false,
        controller: db,
        fields: [
            { name: "", type: "number", width: 40 },
            { name: "NO.AGENDA", type: "text", width: 120 },
            {
                name: "ADD FILE",
                itemTemplate: function (value, item) {
                    var $modal = $("#uploadModal");
                    var $fileInput = $("<input>").attr("type", "file").hide();
                    var $button = $("<button>")
                        .text("Upload")
                        .on("click", function () {
                            $modal.modal("show");
                        });

                    $fileInput.on("change", function (e) {
                        var file = e.target.files[0];
                        // Lakukan apa pun yang perlu dilakukan dengan file yang diunggah
                        console.log("File yang diunggah:", file);
                    });

                    $modal.find("form").on("submit", function (e) {
                        e.preventDefault();
                        var formData = new FormData($(this)[0]);
                        $.ajax({
                            url: "path/to/upload/endpoint",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                // Handle response dari server setelah pengunggahan berhasil
                                console.log("Upload berhasil:", response);
                            },
                            error: function (xhr, status, error) {
                                // Handle error jika pengunggahan gagal
                                console.error("Upload gagal:", error);
                            },
                        });
                    });

                    return $("<div>").append($fileInput, $button);
                },
                width: 115,
            },
            { name: "VERIFY", type: "checkbox", width: 95 },
            { name: "NOMOR", type: "text", width: 130 },
            { name: "TANGGAL", type: "number", width: 150 },
            {
                name: "TANDA TERIMA",
                itemTemplate: function (value, item) {
                    var $fileInput = $("<input>").attr("type", "file").hide();
                    var $button = $("<button>")
                        .text("Convert to PDF")
                        .on("click", function () {
                            $fileInput.click();
                        });

                    $fileInput.on("change", function (e) {
                        var file = e.target.files[0];
                        // Lakukan konversi ke PDF di sini
                        convertToPDF(file);
                    });

                    function convertToPDF(file) {
                        // Lakukan konversi ke PDF di sini
                        // Misalnya, Anda bisa menggunakan library JavaScript untuk mengonversi file ke PDF
                        console.log("Mengonversi ke PDF:", file);
                    }

                    return $("<div>").append($fileInput, $button);
                },
                width: 115,
            },
            { name: "NAMA KAPAL", type: "text", width: 130 },
            { name: "BENDERA KAPAL", type: "text", width: 130 },
            { name: "PELABUHAN ASAL", type: "text", width: 130 },
            { name: "RENCANA TANGGAL KEDATANGAN", type: "date", width: 130 },
            { name: "JUMLAH AWAK ALAT ANGKUT", type: "number", width: 130 },
            { name: "RENCANA LAMA BERLABUH", type: "text", width: 130 },
            { name: "CATATAN PETUGAS", type: "text", width: 230 },
            { name: "TANGGAL DIBUAT", type: "date", width: 130 },
        ],
    });

    $("#tabelKeberangkatan").jsGrid({
        height: "500px",
        width: "100%",
        autoload: true,
        sorting: true,
        selecting: false,
        controller: db,
        fields: [
            { name: "", type: "number", width: 40 },
            { name: "NO.AGENDA", type: "text", width: 120 },
            {
                name: "ADD FILE",
                itemTemplate: function (value, item) {
                    var $modal = $("#uploadModal");
                    var $fileInput = $("<input>").attr("type", "file").hide();
                    var $button = $("<button>")
                        .text("Upload")
                        .on("click", function () {
                            $modal.modal("show");
                        });

                    $fileInput.on("change", function (e) {
                        var file = e.target.files[0];
                        // Lakukan apa pun yang perlu dilakukan dengan file yang diunggah
                        console.log("File yang diunggah:", file);
                    });

                    $modal.find("form").on("submit", function (e) {
                        e.preventDefault();
                        var formData = new FormData($(this)[0]);
                        $.ajax({
                            url: "path/to/upload/endpoint",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                // Handle response dari server setelah pengunggahan berhasil
                                console.log("Upload berhasil:", response);
                            },
                            error: function (xhr, status, error) {
                                // Handle error jika pengunggahan gagal
                                console.error("Upload gagal:", error);
                            },
                        });
                    });

                    return $("<div>").append($fileInput, $button);
                },
                width: 115,
            },
            { name: "VERIFY", type: "checkbox", width: 95 },
            { name: "NOMOR", type: "text", width: 130 },
            { name: "TANGGAL", type: "number", width: 150 },
            {
                name: "TANDA TERIMA",
                itemTemplate: function (value, item) {
                    var $fileInput = $("<input>").attr("type", "file").hide();
                    var $button = $("<button>")
                        .text("Convert to PDF")
                        .on("click", function () {
                            $fileInput.click();
                        });

                    $fileInput.on("change", function (e) {
                        var file = e.target.files[0];
                        // Lakukan konversi ke PDF di sini
                        convertToPDF(file);
                    });

                    function convertToPDF(file) {
                        // Lakukan konversi ke PDF di sini
                        // Misalnya, Anda bisa menggunakan library JavaScript untuk mengonversi file ke PDF
                        console.log("Mengonversi ke PDF:", file);
                    }

                    return $("<div>").append($fileInput, $button);
                },
                width: 115,
            },
            { name: "NAMA KAPAL", type: "text", width: 130 },
            { name: "BENDERA KAPAL", type: "text", width: 130 },
            { name: "PELABUHAN TUJUAN", type: "text", width: 130 },
            { name: "RENCANA TANGGAL KEBERANGKATAN", type: "date", width: 130 },
            { name: "JUMLAH AWAK ALAT ANGKUT", type: "number", width: 130 },
            { name: "RENCANA LAMA BERLABUH", type: "text", width: 130 },
            { name: "CATATAN PETUGAS", type: "text", width: 230 },
            { name: "TANGGAL DIBUAT", type: "date", width: 130 },
        ],
    });

    $("#uploadFilePerusahaan").jsGrid({
        height: "200px",
        width: "100%",
        autoload: true,
        sorting: true,
        selecting: false,
        controller: db,
        fields: [
            { name: "NAMA FILE", type: "text", width: 200 },
            { name: "TANGGAL", type: "date", width: 80 },
        ],
    });

    $("#sort").click(function () {
        var field = $("#sortingField").val();
        $("#sorting-table").jsGrid("sort", field);
    });
    $("#batchDelete").jsGrid({
        width: "100%",
        autoload: true,
        confirmDeleting: false,
        paging: true,
        controller: {
            loadData: function () {
                return db.clients;
            },
        },
        fields: [
            {
                headerTemplate: function () {
                    return $("<button>")
                        .attr("type", "button")
                        .text("Delete")
                        .addClass("btn btn-danger btn-sm btn-delete mb-0")
                        .click(function () {
                            deleteSelectedItems();
                        });
                },
                itemTemplate: function (_, item) {
                    return $("<input>")
                        .attr("type", "checkbox")
                        .prop("checked", $.inArray(item, selectedItems) > -1)
                        .on("change", function () {
                            $(this).is(":checked")
                                ? selectItem(item)
                                : unselectItem(item);
                        });
                },
                align: "center",
                width: 80,
            },
            { name: "Id", type: "text", width: 50 },
            { name: "Employee Name", type: "Text", width: 150 },
            { name: "Salary", type: "text", width: 100 },
            { name: "Skill", type: "text", width: 60 },
            { name: "Office", type: "text", width: 100 },
            { name: "Hours", type: "text", width: 80 },
            { name: "Experience", type: "text", width: 110 },
        ],
    });
    var selectedItems = [];
    var selectItem = function (item) {
        selectedItems.push(item);
    };
    var unselectItem = function (item) {
        selectedItems = $.grep(selectedItems, function (i) {
            return i !== item;
        });
    };
    var deleteSelectedItems = function () {
        if (!selectedItems.length || !confirm("Are you sure?")) return;
        deleteClientsFromDb(selectedItems);
        var $grid = $("#batchDelete");
        $grid.jsGrid("option", "pageIndex", 1);
        $grid.jsGrid("loadData");
        selectedItems = [];
    };
    var deleteClientsFromDb = function (deletingClients) {
        db.clients = $.map(db.clients, function (client) {
            return $.inArray(client, deletingClients) > -1 ? null : client;
        });
    };
})(jQuery);
