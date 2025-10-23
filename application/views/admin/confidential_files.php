<!-- File Upload Modal -->
<div class="modal fade" id="file_upload" tabindex="-1" aria-labelledby="file_upload" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">Upload File | Confidential File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="directory">Select Directory</label>
                            <select class="form-select" id="directory" name="directory">
                                <option value=""></option>
                                <option value="CONFIDENTIAL_FILES">CONFIDENTIAL FILES</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>Filename</label>
                            <input type="text" class="form-control" id="filename" name="filename">
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label class="col-form-label">Date :</label>
                            <div class="input-group">
                                <input type="date" id="date_" class="form-control" placeholder="Select Date" data-provider="flatpickr"/>
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label for="fileUpload">Upload a File</label>
                            <input type="file" id="fileUpload" class="filepond filepond-input-multiple" name="file[]" multiple data-allow-reorder="true" data-max-file-size="100MB" data-max-files="20" />
                            <p class="text-center mt-1">
                                <small class="text-danger"><b>Note</b>: Image file max size <b>10MB</b> | PDF max size <b>50MB</b> | Video max size <b>100MB</b></small>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-lg btn-primary" id="uploadBtn">Upload</button>
                        <button type="button" class="btn btn-lg  btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for viewing folder files -->
<div class="modal fade" id="folderModal" tabindex="-1" aria-labelledby="folderModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="folder_name"></h5>
                <input type="hidden" id="persistentFolderName" value="">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-6 mb-3 ">
                    <div class="d-flex gap-2">
                        <div class="input-group">
                            <input type="search" id="file_name_filter" class="form-control"  placeholder="Search Filename" />
                            <span class="input-group-text"><i class="ri-search-2-line"></i></span>
                        </div>
                        <div class="input-group">
                            <input type="date" id="date_range" class="form-control"  placeholder="Date Range" data-provider="flatpickr" data-date-format="F j, Y" data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" id="folderModalBody"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Confidential Records</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Confidential </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-1">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="col-md-12 mt-1">
                        <div class="d-flex gap-2 mb-2 justify-content-end">
                            <button class="btn btn-primary w-sm create-folder-modal flex-shrink-0" data-bs-toggle="modal" data-bs-target="#file_upload">
                                <i class="ri-add-line align-bottom me-1"></i> Upload Document
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="folderlist-data"></div>
            </div>
        </div>
    </div>  
</div>

<script>

$(document).ready(function () {
    $('#directory').select2({ placeholder: 'Select Directory', allowClear: true, minimumResultsForSearch: Infinity });
});
filter();

function filter() {
    $('#folderlist-data').html('<div class="text-center text-primary" style="margin-top: 100px;"><iconify-icon icon="svg-spinners:bars-rotate-fade" width="40" height="40"></iconify-icon></div>');
        $.ajax({
            url: '<?php echo base_url('get_confidential_folders'); ?>',
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                var folderListHTML = '';
                $.each(response, function (index, folder) {
                    folderListHTML += `
                    <div class="col-xxl-6 col-6 folder-card">
                        <div class="card bg-light ribbon-box border" id="folder-` + index + `" onclick="openFolderModal('` + folder.name + `')" style="cursor: pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="` + folder.name + `">
                            <div class="card-body">
                                <div class="d-flex mb-1">
                                    <div class="form-check form-check-danger mb-3 fs-15 flex-grow-1">
                                        <input type="hidden" id="foldername" value="` + folder.name + `">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="mb-2">
                                        <iconify-icon icon="mdi:confidential-mode" class="align-bottom text-warning fs-60"></iconify-icon>
                                    </div>
                                    <h6 class="fs-12 folder-name fw-bold">` + folder.name + `</h6>
                                </div>
                                <div class="hstack mt-3 text-muted">
                                    <span class="me-auto fs-6 ribbon-three ribbon-three-primary">
                                        <span><b>` + (folder.matched_files ? folder.matched_files.length : 0) + ` Files</b></span>
                                    </span>
                                    <span style="font-size: 10px">
                                        <b>` + (folder.size < 1024 * 1024 * 1024 ?
                                                (folder.size / (1024 * 1024)).toFixed(2) + ' MB' :
                                                (folder.size / (1024 * 1024 * 1024)).toFixed(2) + ' GB') + `</b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
                $('#folderlist-data').html(folderListHTML);
            }
        });
    }
    function openFolderModal(folderName){
        $('#persistentFolderName').val(folderName); 
        var dateRange = $('#dateRange').val() || '';
        var fileName = $('#file_name_filter').val().trim(); 
        updateFolderModalContent(folderName,dateRange,1, fileName);
    }

    function updateFolderModalContent(folderName = $('#persistentFolderName').val(), dateRange, page = 1, fileName = '') {
        const itemsPerPage = 12; 
        $('#folderModalBody').html('<div class="text-center text-primary"><iconify-icon icon="svg-spinners:bars-rotate-fade" width="40" height="40"></iconify-icon></div>');
        $.ajax({
            url: '<?php echo base_url('view_folder_modal_confidential'); ?>',
            type: 'POST',
            data: {
                folder_name: folderName,
                date_filter: dateRange,
                file_name: fileName,
            },
            dataType: 'json',
            success: function (response) {
                let modalContent = '<div class="row">';
                let matchedFiles = response.matched_files || [];
                let totalPages = Math.ceil(matchedFiles.length / itemsPerPage);
                let paginatedFiles = matchedFiles.slice((page - 1) * itemsPerPage, page * itemsPerPage);
                let currentEmpId = "<?= $this->session->userdata('emp_id') ?>"; 
                if (paginatedFiles.length > 0) {
                    paginatedFiles.forEach(function (file) {
                        let fileExtension = file.name.split('.').pop().toLowerCase();
                        let base_url = "<?= base_url() ?>";
                        modalContent += `
                        <div class="element-item col-xxl-2 col-xl-2 col-sm-6">
                            <div class="gallery-box card">`;
                                if (<?= $this->session->userdata('is_admin') === 'Yes' ?>) {
                                    modalContent += `
                                        <div class="form-check form-check-danger flex-grow-1 mb-1">
                                            <a class="form-check-input fs-15 text-danger" value="">
                                                <iconify-icon icon="tabler:xbox-x-filled" 
                                                onclick="deleteFile('${folderName}', '${file.name}')">
                                                </iconify-icon>
                                            </a>
                                        </div>`;
                                }else{
                                    modalContent += `
                                        <div class="form-check form-check-danger flex-grow-1 mb-1">
                                            <a class="form-check-input fs-15 text-danger" value="" hidden>
                                                <iconify-icon icon="tabler:xbox-x-filled" 
                                                onclick="deleteFile('${folderName}', '${file.name}')">
                                                </iconify-icon>
                                            </a>
                                        </div>`;
                                }
                                    modalContent += `<div class="gallery-container">
                                    ${['jpg', 'jpeg', 'png', 'gif', 'jfif'].includes(fileExtension) ? `
                                        <a class="image-popup" href="${base_url}open_confidential_image/${folderName}/${file.name}" target="_blank" title="${file.filename}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <img src="${base_url}open_confidential_image/${folderName}/${file.name}" style="width: 100%; height: 150px; background-size: cover; background-repeat: no-repeat !important;" />
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12">${file.filename}</h5>
                                            </div>
                                            <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.filename}</span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'pdf' ? `
                                        <a class="image-popup" href="${base_url}open_confidential_pdf/${folderName}/${file.name}" target="_blank" title="${file.filename}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <embed src="${base_url}open_confidential_pdf/${folderName}/${file.name}" type="application/pdf" style="width: 100%; height: 145px;" />
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12">${file.filename}</h5>
                                            </div>
                                    <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.filename}</span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'txt' ? `
                                        <a href="${base_url}open_confidential_txt/${folderName}/${file.name}" target="_blank" title="${file.filename}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <iframe src="${base_url}open_confidential_txt/${folderName}/${file.name}" style="width: 100%; height: 145px;"></iframe>
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12">${file.filename}</h5>
                                            </div>
                                            <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.filename}</span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'docx' ? `
                                        <a href="${base_url}open_confidential_docx/${folderName}/${file.name}" target="_blank" title="${file.filename}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <iconify-icon icon="tabler:file-type-docx" class="align-bottom text-info" style="font-size: 150px;"></iconify-icon>
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12">${file.filename}</h5>
                                            </div>
                                            <span class="text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                ${file.filename}
                                            </span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'xlsx' ? `
                                        <a href="${base_url}open_confidential_xlsx/${folderName}/${file.name}" target="_blank" title="${file.filename}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <iconify-icon icon="ri:file-excel-2-line" class="align-bottom text-success" style="font-size: 150px;"></iconify-icon>
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12">${file.filename}</h5>
                                            </div>
                                            <span class="text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                ${file.filename}
                                            </span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'csv' ? `
                                        <a href="${base_url}open_confidential_csv/${folderName}/${file.name}" target="_blank" title="${file.filename}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <iconify-icon icon="ri:file-excel-2-line" class="align-bottom text-success" style="font-size: 150px;"></iconify-icon>
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12">${file.filename}</h5>
                                            </div>
                                        <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.filename}</span>
                                        </a>
                                    ` : ''}

                                    ${['mp3', 'wav', 'ogg'].includes(fileExtension) ? `
                                        <a href="${base_url}open_confidential_audio/${folderName}/${file.name}" target="_blank" title="${file.filename}" data-bs-toggle="tooltip" data-bs-placement="top" >
                                        <iconify-icon icon="ri:folder-music-fill" class="align-bottom text-center text-success" style="font-size: 130px;"></iconify-icon>
                                        <audio controls style="width: 100%; height: 10px;">
                                            <source src="${base_url}open_confidential_audio/${folderName}/${file.name}" type="audio/${fileExtension}">
                                            Your browser does not support the audio element.
                                        </audio>
                                            <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.filename}</span>
                                        </a>
                                    ` : ''}

                                    ${['mp4', 'mkv', 'avi', 'x-matroska'].includes(fileExtension) ? `
                                        <a href="${base_url}open_confidential_video/${folderName}/${file.name}" target="_blank" title="${file.filename}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <video controls style="width: 100%;">
                                                <source src="${base_url}open_confidential_video/${folderName}/${file.name}" type="video/${fileExtension}">
                                                Your browser does not support the video tag.
                                            </video>
                                            <span class="text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.filename}</span>
                                        </a>
                                    ` : ''}
                                    
                                </div>
                                    <div class="box-content">
                                        <div class="d-flex align-items-center mt-1 justify-content-center">
                                            <div class="flex-shrink-0">
                                                <div class="d-flex gap-3">
                                                    <button type="button" class="btn btn-sm fs-10 btn-link text-body text-decoration-none px-0 shadow-none">
                                                        <iconify-icon icon="ri:numbers-fill"
                                                            class="text-muted align-bottom me-1 fs-12"></iconify-icon>
                                                        ${formatFileSize(file.size)}
                                                    </button>
                                                    <button type="button" class="btn btn-sm fs-10 btn-link text-body text-decoration-none px-0 shadow-none">
                                                        <iconify-icon icon="ri:time-fill"
                                                            class="text-muted align-bottom me-1 fs-12"></iconify-icon>
                                                        ${file.modified}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>`;
                    });
                } else {
                    modalContent += '<li class="list-group-item text-primary text-center"><iconify-icon icon="fluent:box-multiple-search-24-filled" width="80" height="80"></iconify-icon><h5 class="mt-2">No file available | Not yet uploaded</h5></li>';
                }
                modalContent += '</div>';

                if (totalPages > 1) {
                    modalContent += '<div class="pagination-container text-center mt-3">';
                    
                    if (page > 1) {
                        modalContent += `<button class="btn btn-sm btn-outline-primary" onclick="updateFolderModalContent('${folderName}',${page - 1})">Prev</button> `;
                    }

                    modalContent += `<span class="mx-2">Page ${page} of ${totalPages}</span>`;

                    if (page < totalPages) {
                        modalContent += `<button class="btn btn-sm btn-outline-primary" onclick="updateFolderModalContent('${folderName}',${page + 1})">Next</button> `;
                    }

                    modalContent += '</div>';
                }

                if (!folderName) {
                    folderName = $('#persistentFolderName').val();
                }

                $('#folderModalBody').html(modalContent);
                $('#folder_name').text(folderName + ' ' + 'FOLDER FILES');
                $('#folderModal').modal('show');
            },
        });
    }

    $('#file_name_filter, #date_range').on('change', function () {
        var folderName      = $('#persistentFolderName').val();
        var dateRange       = $('#date_range').val();
        var fileNameFilter  = $('#file_name_filter').val();
        updateFolderModalContent(folderName,dateRange, 1, fileNameFilter); 
    });
    $('#folderModal').on('hide.bs.modal', function () {
        $('#file_name_filter').val('');
        $('#date_range').val('');
    });
    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        else if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
        else if (bytes < 1024 * 1024 * 1024) return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        else return (bytes / (1024 * 1024 * 1024)).toFixed(2) + ' GB';
    }

</script>
<script src="<?php echo base_url(); ?>assets/js/filepond.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-image-preview.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-file-validate-size.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-file-encode.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#uploadForm').addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to upload these files?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, upload!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(this);
                    const pond = FilePond.find(document.querySelector(".filepond-input-multiple"));
                    const files = pond.getFiles();

                    const dateValue = document.getElementById('date_').value;
                    formData.append('date_', dateValue);

                    if (files.length === 0) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 3000,
                            extendedTimeOut: 2000,
                        };
                        toastr.error('No files selected.');
                        return;
                    }

                    files.forEach(fileItem => {
                        formData.append('file[]', fileItem.file);
                    });

                    const uploadButton = document.querySelector('#uploadBtn');
                    uploadButton.innerHTML = 'Uploading...';
                    uploadButton.disabled = true;

                    $.ajax({
                        url: '<?php echo base_url('Confidential/upload_file'); ?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {

                            response = JSON.parse(response);

                            if (response.success) {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 3000,
                                    extendedTimeOut: 2000,
                                };
                                toastr.success(response.message);
                                $('#file_upload').modal('hide');
                                pond.removeFiles();
                                $('#uploadForm')[0].reset();
                                filter();
                            } else {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 3000,
                                    extendedTimeOut: 2000,
                                };
                                toastr.error(response.message);
                            }

                            uploadButton.innerHTML = 'Upload Files';
                            uploadButton.disabled = false;
                        }
                    });
                }
            });
        });
    });

    function deleteFile(folderName, fileName) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You want to delete this file?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '<?php echo base_url('Confidential/delete_file'); ?>',
                    type: 'POST',
                    data: {
                        folder_name: folderName,
                        file_name: fileName,
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 3000,
                                extendedTimeOut: 2000,
                
                            };

                            toastr.success(
                                `Successfully deleted`,
                            );
                            updateFolderModalContent(folderName);
                            filter();
                        } else {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 3000,
                                extendedTimeOut: 2000,
                
                            };

                            toastr.error(
                                `${response.error}`,
                            );
                        }
                    }
                });
            }
        });
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        flatpickr("#date_", {
            allowInput: true,
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
            disableMobile: true
        });
    });
    $(document).on({
        mouseenter: function () {
            $(this).tooltip('show');
        },
        mouseleave: function () {
            $('.tooltip').remove();
        }
    }, '[data-bs-toggle="tooltip"]');
</script>
