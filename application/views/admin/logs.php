<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Logs </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Logs </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header border-1">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1 fw-bold">Activity Logs</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="mt-2 tab-pane active" role="tabpanel">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered compact" id="logs">
                            <thead class="table-info text-center text-uppercase">
                                <tr>
                                    <!-- <th>Emp ID</th> -->
                                    <th>Activity Logs</th>
                                    <th width="20%">Date Added</th>
                                    <th width="20%">Date Updated</th>
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
<script>
    $('#logs').DataTable({
            processing: true,
            serverSide: true,
            // stateSave: true,
            destroy: true,
            lengthMenu: [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
            pageLength: 10,
            ajax: {
                url: '<?php echo base_url('logs_list'); ?>',
                type: 'POST',
            },
            columns: [
            // { data: 'id' },
            { data: 'action' },
            { 
                "data": 'date_added',
                "render": function(data, type, row) {
                    if (data) {
                        var date = new Date(data);
                        return date.toLocaleDateString('en-US', { 
                            year: 'numeric', 
                            month: 'long', 
                            day: 'numeric' 
                        }) + ' ' + date.toLocaleTimeString('en-US', { 
                            hour: 'numeric', 
                            minute: 'numeric', 
                            hour12: true 
                        });
                    } else {
                        return '';
                    }
                }
            },
            { 
                "data": 'date_updated',
                "render": function(data, type, row) {
                    if (data) {
                        var date = new Date(data);
                        return date.toLocaleDateString('en-US', { 
                            year: 'numeric', 
                            month: 'long', 
                            day: 'numeric' 
                        }) + ' ' + date.toLocaleTimeString('en-US', { 
                            hour: 'numeric', 
                            minute: 'numeric', 
                            hour12: true 
                        });
                    } else {
                        return '';
                    }
                }
            },
        ],

            paging: true,
            searching: true,
            ordering: true,
            columnDefs: [
                { "className": "text-start", "targets": ['_all'] },
            ],
        });
</script>