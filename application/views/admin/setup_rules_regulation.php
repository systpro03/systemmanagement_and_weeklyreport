<div class="modal fade" id="file_upload" tabindex="-1" aria-labelledby="file_upload"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">UPLOAD FILE RULE | REGULATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="team">Choose Team</label>
                            <select id="team" name="team" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label for="fileUpload">Upload a File</label>
                            <input type="file" id="fileUpload" class="filepond filepond-input-multiple" name="file[]"  multiple data-allow-reorder="true" data-max-file-size="500MB" data-max-files="5" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-lg btn-primary" id="uploadBtn">Upload</button>
                        <button type="button" class="btn btn-lg btn-dark" data-bs-dismiss="modal">Close</button>
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
                <h4 class="mb-sm-0">Rules and Regulations setup</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Rules | Regulations</a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header border-1">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1 fw-bold"></h5>
                        <button class="btn btn-primary waves-effect waves-light"  data-bs-toggle="modal"  data-bs-target="#file_upload">
                            <i class="ri-add-fill align-bottom me-1 fs-12"></i> Upload File
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="mt-2 tab-pane active" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered text-center" id="filesTable">
                                    <thead class="table-info text-uppercase">
                                        <tr>
                                            <th class=" text-center ">Team</th>
                                            <th class=" text-center ">Filename</th>
                                            <th class=" text-center ">Image</th>
                                            <th class=" text-center ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#team').select2({ placeholder: 'Select Team', allowClear: true });
        $('#filesTable').DataTable({
            "processing": true,
            "serverSide": true, 
            "ajax": {
                "url": "<?= base_url('Admin/setup_rules_regulation_list') ?>",
                "type": "POST",
            },
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [[3, 6, 9, 100, 10000], [3, 6, 9, 100, "Max"]],
            "pageLength": 3,
            "columns": [
                { "data": "team_name" },
                { "data": "filename" },
                { "data": "image", "orderable": false, "searchable": false },
                { "data": "action", "orderable": false, "searchable": false }
            ]
        });
    });
    $.ajax({
        url: '<?php echo base_url('get_team') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            $('#team').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#team').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });
        }
    });

    function deleteFile(fileId, filename) {
        Swal.fire({
            title: "Are you sure?",
            text: "You are about to delete '" + filename + "'. This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('delete_file') ?>/" + fileId,
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 5000,
                                extendedTimeOut: 2000,
                            };
                            toastr.success(
                                `File was successfully deleted`,
                            );
                           $('#filesTable').DataTable().ajax.reload();
                        } else {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 5000,
                                extendedTimeOut: 2000,
                            };
                            toastr.success(
                                `${response.message}`,
                            );
                        }
                    },
                });
            }
        });
    }
</script>
<script src="<?php echo base_url(); ?>assets/js/filepond.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-image-preview.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-file-validate-size.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-file-encode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginFileValidateSize,
            FilePondPluginImageExifOrientation,
            FilePondPluginImagePreview
        );
        document.querySelectorAll("input.filepond-input-multiple").forEach(function (inputElement) {
            FilePond.create(inputElement);
        });
        document.querySelector('#uploadForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const team = document.querySelector('#team').value;
            const teamName = document.querySelector('#team option:checked')?.textContent || '';
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to upload files to "${teamName}".`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, upload it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (!result.isConfirmed) return;
                const formData = new FormData();
                formData.append('team', team);
                formData.append('team_name', teamName);
                const pond = FilePond.find(document.querySelector(".filepond-input-multiple"));
                const files = pond.getFiles();
                if (files.length === 0) {
                    toastr.options = {
                        progressBar: true,
                        positionClass: "toast-top-left",
                        timeOut: 5000,
                        extendedTimeOut: 2000,
                    };
                    toastr.error(`No files were selected`);
                    return;
                }
                files.forEach(fileItem => {
                    formData.append('file[]', fileItem.file);
                });
                const uploadButton = document.querySelector('#uploadBtn');
                uploadButton.innerHTML = `
                    <span class="d-flex align-items-center">
                        <span class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </span>
                        <span class="flex-grow-1 ms-2">Uploading...</span>
                    </span>`;
                uploadButton.disabled = true;
                $.ajax({
                    url: '<?php echo base_url('upload_file_rules_regulations'); ?>',
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
                                timeOut: 5000,
                                extendedTimeOut: 2000,
                            };
                            toastr.success(`${response.message}`);
                            $('#file_upload').modal('hide');
                            $('#filesTable').DataTable().ajax.reload();
                            pond.removeFiles();
                            document.getElementById('uploadForm').reset();
                        } else {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 5000,
                                extendedTimeOut: 2000,
                            };
                            toastr.error(`${response.message}`);
                        }

                        uploadButton.innerHTML = 'Upload Files';
                        uploadButton.disabled = false;
                    }
                });
            });
        });
    });
    $('#file_upload').on('hidden.bs.modal', function () {
        $('#team').val('').trigger('change');
    });
</script>