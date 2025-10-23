<div class="modal fade zoomIn" id="filePreviewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="modal-title" id="previewModalLabel">File Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            </div>
            <div class="modal-body mt-2">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#folderModal">Back
                    to List</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quick Search</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages </a></li>
                        <li class="breadcrumb-item active">Search </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row justify-content-center mb-4">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="search" id="search_keyword" class="form-control form-control-lg" placeholder="Please enter a keyword">
                                <button id="search_btn" class="btn btn-primary btn-lg"> <i class="mdi mdi-magnify me-1"></i> Search </button>
                            </div>
                            <small class="text-info d-block fst-italic mt-1 fs-14">
                                <i class="ri-information-line me-1"></i>
                                <strong>Note:</strong> You can search by:
                                    file name, original file name, module abbreviation, type of system,  
                                    team name, employee name, task workload, concerns, remarks, position,  
                                    description, user type, module name, module description, sub-module name, or ip address ( e.g. 127.0.0.1 ).
                                <span class="d-block text-danger mt-3">
                                    <i class="ri-alert-line me-1"></i>
                                    You can click any result with a file to preview it...
                                </span>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12" id="search_results_all" data-aos='zoom-in'>
                            <li class="list-group-item text-primary text-center">
                                <iconify-icon icon="streamline-flex-color:search-category-flat" width="100"
                                    height="100"></iconify-icon>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        function load_page(page = 1) {
            var keyword = $('#search_keyword').val().trim();
            if (keyword === '') {
                $('#search_keyword').addClass('is-invalid');
            } else {
                $('#search_keyword').removeClass('is-invalid');
            }
            $.ajax({
                url: '<?= base_url("Search/search_files") ?>',
                method: 'POST',
                data: { keyword: keyword, page: page },
                beforeSend: function () {
                    $('#search_results_all').html(`
                        <div class="d-flex flex-column align-items-center justify-content-center text-center py-5">
                            <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mb-0 text-muted">
                                <i class="fas fa-search fa-beat me-1"></i> Searching, please wait...
                            </p>
                        </div>
                    `);
                },

                dataType: 'json',
                success: function (response) {

                    var results = $('#search_results_all');
                    results.empty();
                    let headerHtml = '';
                    if (keyword !== '') {
                        headerHtml = `
                                <div class="col-lg-12 mb-3" data-aos='zoom-in'>
                                    <h5 class="fs-12 fw-medium text-center mb-3">
                                        Showing results for "<span class="text-primary fw-semibold fst-italic">
                                        ${$('<div>').text(keyword).html()}
                                        </span>"
                                    </h5>
                                </div><div class='border border-dashed mb-3'></div>`;
                    }
                    if (response.status !== 'success') {
                        results.html(headerHtml + `
                                <li class="list-group-item text-primary text-center" id="no_results" data-aos='flip-up'>
                                        <iconify-icon icon="streamline-flex-color:search-category-flat" width="100" height="100"></iconify-icon>
                                    <h6 class="mt-3">Enter a keyword to search from the categories listed above.</h6>
                                </li>`);

                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                        };
                        toastr.error(
                            `Please search a valid keyword from the categories listed above.`,
                        );
                        return;
                    }

                    results.html(headerHtml + response.html);
                    $('#no_results').remove();
                    toastr.options = {
                        progressBar: true,
                        positionClass: "toast-top-left",
                        timeOut: 5000,
                        extendedTimeOut: 2000,
                    };
                    toastr.success(
                        `Keyword "${keyword}" has a match searched.`,
                    );
                },
                error: function (xhr, status, error) {
                    console.log(error);
                    toastr.options = {
                        progressBar: true,
                        positionClass: "toast-top-left",
                        timeOut: 5000,
                        extendedTimeOut: 2000,
                    };
                    if (xhr.status === 0) {
                        toastr.error(
                            `An error occurred while processing your request. Please try again later or try searching short description.`,
                        );
                    } else {
                        toastr.error(
                            `An error occurred while processing your request. Please try again later or try searching short description.`,
                        );
                    }
                }
            });
        }

        $('#search_btn').on('click', function () {
            load_page(1);
        });

        $(document).on('click', '.search-page', function (e) {
            e.preventDefault();
            var page = $(this).data('page');
            load_page(page);
        });

        $('#search_keyword').keypress(function (e) {
            if (e.which === 13) {
                load_page(1);
            }
        });
    });
    function previewFileModal(fileUrl) {
        const extension = fileUrl.split('.').pop().toLowerCase();
        let previewHTML = '';

        if (['jpg', 'jpeg', 'png', 'gif', 'jfif', 'bmp', 'webp'].includes(extension)) {
            previewHTML = `<img src="${fileUrl}" class="img-fluid w-100" style="max-height:100vh; width: 80px object-fit:contain;" />`;

        } else if (extension === 'pdf') {
            previewHTML = `<iframe src="${fileUrl}" style="width: 100%; height: 90vh;" frameborder="0"></iframe>`;

        } else if (['mp4', 'mkv', 'avi', 'x-matroska'].includes(extension)) {
            previewHTML = `
            <video controls style="width: 100%; height: 90vh;" preload="metadata">
                <source src="${fileUrl}" type="video/${extension === 'mp4' ? 'mp4' : 'ogg'}">
                Your browser does not support the video tag.
            </video>`;

        } else if (['mp3', 'wav', 'ogg'].includes(extension)) {
            previewHTML = `
            <audio controls style="width: 100%;">
                <source src="${fileUrl}" type="audio/${extension}">
                Your browser does not support the audio element.
            </audio>`;

        } else if (['doc', 'docx', 'xlsx'].includes(extension)) {
            previewHTML = `
                    <div class="text-center p-4">
                        <p class="text-muted">Preview not available for this file type on localhost.</p>
                        <a href="${fileUrl}" class="btn btn-outline-secondary" download>Download File</a>
                    </div>`;

        } else if (['txt', 'csv'].includes(extension)) {
            previewHTML = `
            <iframe src="${fileUrl}" style="width: 100%; height: 90vh;" frameborder="0"></iframe>`;

        } else {
            previewHTML = `<p class="text-muted">Preview not available for this file type.</p>`;
        }

        $('#filePreviewModal .modal-body').html(previewHTML);
        $('#filePreviewModal').modal('show');
        $('#folderModal').modal('hide');
    }

</script>