$(document).ready(function(){
    role = $('.roleuser').val();
    
    
    var store = new DevExpress.data.CustomStore({
        key: "id",
        load: function() {
            return sendRequest(apiurl + "/daftar-ulang");
        },
        insert: function(values) {
            return sendRequest(apiurl + "/daftar-ulang", "POST", values);
        },
        update: function(key, values) {
            return sendRequest(apiurl + "/daftar-ulang/"+key, "PUT", values);
        },
        remove: function(key) {
            return sendRequest(apiurl + "/daftar-ulang/"+key, "DELETE");
        }
    });

    function moveEditColumnToLeft(dataGrid) {
		dataGrid.columnOption("command:edit", { 
			visibleIndex: -1,
			width: 80 
		});
    }
    
    var id = {},
        popup = null,
        popupOptions = {
            width: 500,
            height: 450,
            contentTemplate: function() {
                var scrollView = $("<div />").append(
                    $("<p>Title: <span>Bukti Pembayaran</span> | File: <span>"+title_lampiran+"</span></p>"),
                    $("<div>").attr("id", "formupload").dxFileUploader({
                        uploadMode: "useButtons",
                        name: "buktipembayaran",
                        uploadUrl: "/api/upload-berkas/"+id+"/bukti-pembayaran",
                        accept: "image/*,application/pdf,application/msword,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                        onUploaded: function (e) {						
                            dataGrid.refresh();
                        }
                    }),
                    $("<p><b>::Lakukan pengajuan::</b></p>"),
                    $("<div>").attr("id", "buttonsubmit").dxButton({
                        icon: "check",
                        type: "success",
                        text: "Submit Pengajuan",
                        onClick: function(e) {
                            $.getJSON('/pengajuan-daftarulang/'+id,function(item){
                                    DevExpress.ui.notify(item.message,item.status);
                                    popup.hide();
                                    dataGrid.refresh();
                            })
                        }
                    }),
                );

                scrollView.dxScrollView({
                    width: '100%',
                    height: '100%'
                });
    

                return scrollView;
            },
            showTitle: true,
            title: "Upload Form",
            dragEnabled: false,
            closeOnOutsideClick: true
    };

    var showUpload = function(
            data,
            lampiran
        ) 
        {
        id = data;

        (lampiran !== null) ? title_lampiran = lampiran : title_lampiran = "<b style='color:red;'>foto belum ada</b>";

        console.log(id);

        if(popup) {
            popup.option("contentTemplate", popupOptions.contentTemplate.bind(this));
        } else {
            popup = $("#popup").dxPopup(popupOptions).dxPopup("instance");
        }

        popup.show();
    };
    function makeid(length) {
        var result           = '';
        var characters       = '0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * 
     charactersLength));
       }
       return result;
    }

        ScStatus = [{id:1,valstatus:"Waiting Approval"},{id:2,valstatus:"Approved"},{id:3,valstatus:"Rejected"}];
        
        var dataGrid = $("#grid-daftarulang").dxDataGrid({     
            dataSource: store,
            allowColumnReordering: true,
            allowColumnResizing: true,
            columnsAutoWidth: true,
            columnMinWidth: 80,
            columnHidingEnabled: false,
            wordWrapEnabled: true,
            showBorders: true,
            filterRow: { visible: true },
            filterPanel: { visible: true },
            headerFilter: { visible: true },
            selection: {
                mode: "multiple"
            },
            columnFixing: { 
                enabled: true
            },
            editing: {
                useIcons:true,
                mode: "popup",
                allowAdding: (role == "siswa")?true:false,
                allowUpdating: (role == "admin")?true:false,
                allowDeleting: false,
                
            },
            // scrolling: {
            //     mode: "infinite"
            // },
            
            pager: {
                allowedPageSizes: [5, 10, 15, 30],
                showInfo: true,
                showNavigationButtons: true,
                showPageSizeSelector: true,
                visible: true
            },
            paging: {
                pageSize: 5
            },
            columns: [
                {
                    caption: '#',formItem: {visible:false},width:40,
                    fixed: false,
                    cellTemplate:function(container,options) {
                        container.text(options.rowIndex +1);
                    }
                },
                { 
                    caption: "Nomo Daftar Ulang",
                    dataField: "nodu",
                    width: 150,
                    formItem: {visible:(role!=="admin")?true:false},
                    editorOptions: {
                        disabled: true
                    },
                    // validationRules: [
                    //     { type: "required" }
                    // ],
                },
                { 
                    caption: "Nama",
                    dataField: "users.nama_lengkap",
                    width: 150,
                    formItem: {visible:false},
                },
                { 
                    caption: "Kelas",
                    dataField: "users.kelas.nama_kelas",
                    width: 150,
                    formItem: {visible:false},
                },
                { 
                    caption: "Jurusan",
                    dataField: "users.jurusan.nama_jurusan",
                    width: 150,
                    formItem: {visible:false},
                },
                { 
                    caption: "Tahun Ajaran",
                    dataField: "users.tahunajaran.tahun_ajaran",
                    width: 150,
                    formItem: {visible:false},
                },
                { 
                    caption: "Bukti Pembayaran",
                    dataField: "lampiran",
                    width: 150,
                    formItem: {visible:false},
                    fixed: false,
                    fixedPosition: "right",
                    editorOptions: {
                        disabled: true
                    },
                    cellTemplate: function(container, options) {
            
                        $('<a href="/upload/'+options.data.lampiran+'" target="_blank">'+options.data.lampiran+'</a>').addClass('dx-link').appendTo(container);
                        
                    }
                },
                { 
                    caption: "Tanggal Dibuat",
                    dataField: "created_at",
                    dataType:"date", format:"dd-MM-yyyy",displayFormat: "dd-MM-yyyy",
                    width: 150,
                    formItem: {visible:false},
                },
                { 
                    caption: "Status",
                    dataField: "status",
                    fixed: true,
                    fixedPosition: "right",
                    formItem: {visible:(role=="admin")?true:false},
                    width: 100,
                    editorType: "dxSelectBox",
                    editorOptions: {
                        dataSource: ScStatus,  
                        valueExpr: 'id',
                        displayExpr: 'valstatus',
                    },
                    encodeHtml: false,
                    customizeText: function(e) {
                        var stext = ["<span class='mb-2 mr-2 badge badge-secondary'>Draft</span>","<span class='mb-2 mr-2 badge badge-primary'>Waiting Approval</span>","<span class='mb-2 mr-2 badge badge-success'>Approved</span>","<span class='mb-2 mr-2 badge badge-danger'>Rejected</span>",""];
                        return stext[e.value];
                    }
                },
                
                {
                    caption: 'Tambah/Edit Berkas',
                    formItem: {visible:false},
                    fixed: true,
                    width: 100,
                    fixedPosition: "right",
                    visible: (role=="siswa")?true:false,
                    editorOptions: {
                        disabled: true
                    },
                    cellTemplate: function(container, options) {
            
                    $('<button class="btn btn-danger btn-xs">Upload</button>').addClass('dx-button').on('dxclick', function(evt) {
                        evt.stopPropagation();
                        $.getJSON('/checkstatus/'+options.data.id,function(item){
                            if(item == 200) {
                                showUpload(
                                    options.data.id,
                                    options.data.lampiran,
                                );
                            } else if(item == 100) {
                                DevExpress.ui.notify("Aksi Tidak di Izinkan","error");
                            } else {
                                DevExpress.ui.notify(item.message,item.status);
                            }
                        })
                      
                    }).appendTo(container);
                    
                    }
                },
                {
                    caption: "Print",
                    type: "buttons",
                    width: 80,
                    buttons: [{
                        hint: "generate",
                        icon: "repeat",
                        onClick: function(e) {
                            $.getJSON('/checkstatus/'+e.row.data.id,function(item){
                                if(item == 100) {
                                    window.open('/printpdf/'+e.row.data.id, '_blank');
                                } else {
                                    DevExpress.ui.notify(item.message,item.status);
                                }
                            })

                        }
                    }]
                },
                
            ],
            export: {
                enabled: true,
                fileName: "daftar-ulang",
                excelFilterEnabled: true,
                allowExportSelectedData: true
            },
            onContentReady: function(e){
                moveEditColumnToLeft(e.component);
            },
            onInitNewRow(e) {  
                e.data.nodu = "adz"+makeid(8);  
            },
            onToolbarPreparing: function(e) {
                dataGrid = e.component;
        
                e.toolbarOptions.items.unshift({						
                    location: "after",
                    widget: "dxButton",
                    options: {
                        hint: "Refresh Data",
                        icon: "refresh",
                        onClick: function() {
                            dataGrid.refresh();
                        }
                    }
                },
                )
            },
            onSelectionChanged: function(data) {
                if(role=="admin") {
                    deleteButton.option("disabled", !data.selectedRowsData.length);
                }
                    // selectedItems = data.selectedRowsData;
                // disabled = !selectedItems.length;
            }, 
        }).dxDataGrid("instance");

    var deleteButton = $("#gridDeleteSelected").dxButton({
        text: "Delete Selected Records",
        height: 34,
        disabled: true,
        onClick: function () {
            var result = DevExpress.ui.dialog.confirm("Are you sure you want to delete selected?", "Delete row");
            result.done(function (dialogResult) {
                if (dialogResult){
                    $.each(dataGrid.getSelectedRowKeys(), function() {
                        store.remove(this);
                    });
                    dataGrid.refresh();
                }
            });
            
        }
    }).dxButton("instance");


});
