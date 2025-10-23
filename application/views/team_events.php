<div class="modal fade zoomIn" id="createFolderModal" tabindex="-1" aria-labelledby="folderModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="createFolderModalLabel">Create Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" class="needs-validation createfolder-form" id="createfolder-form"
                    novalidate="">
                    <div class="mb-4">
                        <label for="foldername-input" class="form-label">Folder Name</label>
                        <input type="text" class="form-control" id="foldername" required=""
                            placeholder="Enter folder name">
                        <div class="invalid-feedback">Please enter a folder name.</div>
                        <input type="hidden" class="form-control" id="folderid" value=""
                            placeholder="Enter folder name">
                    </div>
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-ghost-success material-shadow-none"
                            data-bs-dismiss="modal"><i class="ri-close-line align-bottom"></i> Close</button>
                        <button type="submit" class="btn btn-primary" onclick="addFolder()">Add Folder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="folderName"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" method="post">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="module">Directory <span class="text-danger">*</span> :</label>
                            <select class="form-select mb-3" id="directory">
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" id="selected-folder" name="folderName" />
                    <div class="col-lg-12">
                        <input type="file" id="fileInput" class="filepond filepond-input-multiple" name="file[]"
                            multiple data-allow-reorder="true" data-max-file-size="100MB" data-max-files="50" />
                        <p class="text-center mt-1">
                            <small class="text-danger"><b>Note</b>: Image file max size <b>10MB</b></small>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="uploadBtn">Upload</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">FS | PROCESS | RMS | SYSDEV GALLERY</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages </a></li>
                        <li class="breadcrumb-item active">Gallery </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <?php if ($this->session->userdata('is_admin') == 'Yes'): ?>
                    <div class="card-header text-end">
                        <button class="btn btn-success w-sm create-folder-modal flex-shrink-0" data-bs-toggle="modal"
                            data-bs-target="#createFolderModal"><i class="ri-add-line align-bottom me-1"></i> Create
                            Folders</button>
                        <button type="submit" class="btn btn-primary w-sm create-folder-modal flex-shrink-0"
                            data-bs-toggle="modal" data-bs-target="#uploadModal"> Upload
                        </button>

                        <button id="deleteButton" class="btn btn-danger w-sm flex-shrink-0 d-none"
                            onclick="deleteSelectedImages()">
                            <i class="ri-delete-bin-6-line align-bottom me-1"></i> Delete Selected
                        </button>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <ul class="list-inline categories-filter animation-nav" id="filter"></ul>
                            </div>
                            <div class="row gallery-wrapper" style="clear: both" id="gallery" ></div>
                        </div>
                        <div id="pagination-controls" class="pagination mb-2"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#directory').select2({ placeholder: 'Select Directory', allowClear: true, minimumResultsForSearch: Infinity });
    });
    function directories() {
        $.ajax({
            url: '<?php echo base_url(); ?>get_directories',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.error) {
                    toastr.error(data.error);
                } else {
                    let $directorySelect = $('#directory');
                    $directorySelect.empty().append('<option value="">Select Directory</option>');

                    $.each(data, function (index, dir) {
                        $directorySelect.append(`<option value="${dir}">${dir}</option>`);
                    });
                }
            },

        });
    }

    directories();

    function load_directory() {
        $.ajax({
            url: '<?php echo base_url(); ?>get_images_directory',
            method: 'GET',
            dataType: 'json',
            cache: true,
            success: function (folders) {
                updateCategoriesFilter(folders);
            },
        });
    }
    load_directory();

    function addFolder() {
        event.preventDefault();
        let folderName = $('#foldername').val().trim();
        if (!folderName) {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
            };
            toastr.error('Please enter a folder name.');

            $('#foldername').each(function () {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            return;
        }

        $.ajax({
            url: '<?php echo base_url(); ?>create_folder',
            type: 'POST',
            dataType: 'json',
            data: { folderName: folderName },
            success: function (response) {
                if (response.status === 'success') {
                    toastr.options = {
                        progressBar: true,
                        positionClass: "toast-top-left",
                        timeOut: 5000,
                        extendedTimeOut: 2000,
                        preventDuplicates: true,
                    };
                    toastr.success(response.message);
                    $('#createFolderModal').modal('hide');
                    $('#foldername').val('');
                    load_directory();
                    directories();

                } else {
                    toastr.options = {
                        progressBar: true,
                        positionClass: "toast-top-left",
                        timeOut: 5000,
                        extendedTimeOut: 2000,
                        preventDuplicates: true,
                    };
                    toastr.error(response.message);
                }
            },
        });
    }
    function toggleDeleteButton() {
        const selectedFiles = $('.image-checkbox:checked').length;
        $('#deleteButton').toggleClass('d-none', selectedFiles === 0);
    }

    function deleteSelectedImages() {
        const selectedFiles = $('.image-checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        if (selectedFiles.length === 0) return;

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete ${selectedFiles.length} file(s). This action cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url("sysdev_delete_files"); ?>',
                    type: 'POST',
                    data: {
                        files: JSON.stringify(selectedFiles)
                    },
                    cache: false,
                    success: function (response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 5000,
                                extendedTimeOut: 2000,
                                preventDuplicates: true,
                            };
                            toastr.success('Selected files deleted successfully.');
                            selectedFiles.forEach(file => {
                                $(`.image-checkbox[value="${file}"]`).closest('.element-item').remove();
                            });
                            $('.image-checkbox').prop('checked', false);
                            toggleDeleteButton();

                            displayImages(currentCategory, currentPage);
                        } else {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 5000,
                                extendedTimeOut: 2000,
                                preventDuplicates: true,
                            };
                            toastr.error(result.message || 'Failed to delete some files.');
                        }
                    },
                });
            }
        });
    }


    function updateCategoriesFilter(folders) {
        const filterContainer = $('#filter');
        const galleryWrapper = $('.gallery-wrapper');
        const itemsPerPage = 18;
        let currentPage = 1;
        let currentCategory = null;

        filterContainer.empty();
        galleryWrapper.empty();

        folders.forEach((folder, index) => {
            const category = folder.name.toLowerCase().replace(/\s+/g, '-');
            const activeClass = index === 0 ? 'active' : '';

            filterContainer.append(`
                <li class="list-inline-item">
                    <a class="categories ${activeClass}" href="#" role="button" data-folder="${folder.name}">
                        ${folder.name}
                    </a>
                </li>
            `);
        });

        $(document).on('click', '.categories', function (e) {
            e.preventDefault();

            const folderName = $(this).data('folder');

            $('.upload-btn').addClass('d-none');
            $(`.upload-btn[data-folder="${folderName}"]`).removeClass('d-none');

            $('.categories').removeClass('active');
            $(this).addClass('active');

            currentCategory = folderName.toLowerCase().replace(/\s+/g, '-');
            currentPage = 1;
            displayImages(currentCategory, currentPage);
        });

        filterContainer.on('click', '.categories', function (e) {
            e.preventDefault();
            $('.categories').removeClass('active');
            $(this).addClass('active');

            currentCategory = $(this).data('filter');
            currentPage = 1;
            displayImages(currentCategory, currentPage);
        });

        function displayImages(category, page) {
            galleryWrapper.empty();

            const selectedFolder = folders.find(folder => folder.name.toLowerCase().replace(/\s+/g, '-') === category);
            if (selectedFolder) {
                const images = selectedFolder.images;
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, images.length);

                const folderItems = images.slice(startIndex, endIndex).map(image => {
                    const imageName = image.split('/').pop();
                    return `
                        <div class="element-item col-xxl-2 col-xl-4 col-sm-6 ${category}" data-category="${category}" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="gallery-box card">
                                <div class="gallery-container position-relative">
                                    <?php if ($this->session->userdata('is_admin') === 'Yes'): ?>
                                        <input type="checkbox" class="image-checkbox position-absolute top-0 start-0 m-2" 
                                            value="${image}" onchange="toggleDeleteButton()">
                                    <?php endif; ?>
                                    <a class="image-popup" href="${image}" title="">
                                        <img class="gallery-img img-fluid mx-auto" src="${image}" alt="${imageName}" loading="lazy"/>
                                    </a>
                                </div>
                            </div>
                        </div>`;
                });

                galleryWrapper.append(folderItems.join(''));
                updatePaginationControls(images.length, page);
            } else {
                galleryWrapper.append(`
                    <li class="list-group-item text-primary text-center">
                        <iconify-icon icon="fluent:box-multiple-search-24-filled" width="80" height="80"></iconify-icon>
                        <h5 class="mt-2">No file available | Not yet uploaded</h5>
                    </li>
                `);
            }

            let lightbox = GLightbox({
                selector: '.image-popup',
            });
        }


        function updatePaginationControls(totalItems, currentPage) {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const paginationContainer = $('#pagination-controls');
            paginationContainer.empty();

            if (totalPages > 1) {
                paginationContainer.append(`
                    <button class="btn btn-sm btn-primary" id="prev-page" ${currentPage === 1 ? 'disabled' : ''}>Previous</button>
                    <span class="mx-2">Page ${currentPage} of ${totalPages}</span>
                    <button class="btn btn-sm btn-primary" id="next-page" ${currentPage === totalPages ? 'disabled' : ''}>Next</button>
                `);

                $('#prev-page').on('click', function () {
                    if (currentPage > 1) {
                        currentPage--;
                        displayImages(currentCategory, currentPage);
                    }
                });

                $('#next-page').on('click', function () {
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayImages(currentCategory, currentPage);
                    }
                });
            }
        }

        initializeFilters();
        currentCategory = folders[0]?.name.toLowerCase().replace(/\s+/g, '-');
        displayImages(currentCategory, currentPage);
    }

    function initializeFilters() {
        $('.gallery-wrapper').isotope({
            itemSelector: '.element-item',
            layoutMode: 'fitRows',
        });
    }

    $(document).on('click', '.image-popup', function (e) {
        e.preventDefault();
    });


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
                    const folderName = $('#directory').val();
                    formData.append('folderName', folderName);

                    const pond = FilePond.find(document.querySelector(".filepond-input-multiple"));
                    const files = pond.getFiles();

                    if (files.length === 0) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                        };
                        toastr.error('No files selected.');
                        return;
                    }

                    files.forEach(fileItem => {
                        formData.append('file[]', fileItem.file);
                    });

                    const uploadButton = document.querySelector('#uploadBtn');
                    uploadButton.innerHTML = 'Uploading files...';
                    uploadButton.disabled = true;

                    $.ajax({
                        url: '<?php echo base_url('sysdev_upload_file'); ?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            result = JSON.parse(response);
                            if (result.success) {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,
                                };
                                toastr.success(result.message);
                                $('#uploadModal').modal('hide');
                                pond.removeFiles();
                                $('#uploadForm')[0].reset();
                                load_directory();
                                
                            } else {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,
                                };
                                toastr.error(result.message);
                            }

                            uploadButton.innerHTML = 'Upload Files';
                            uploadButton.disabled = false;
                        }
                    });
                }
            });
        });
    });

</script>
<style>
    .gallery-wrapper {
        clear: both;
        margin-bottom: 150px;
    }

    .gallery-img {
        width: 400px;
        height: 150px;
        object-fit: cover;
        display: block;
        margin: auto;
    }

    .pagination {
        margin-top: 400px;
        display: flex;
        justify-content: center;
    }
</style>