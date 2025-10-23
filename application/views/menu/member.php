<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Members Data </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
            <div class="d-flex align-items-center justify-content-end">
                    <div class="col-md-5">
                        <div class="d-flex align-items-center mx-2 gap-2">
                            <select class="form-select" id="team_filter">
                                <option value="">Select Team</option>
                            </select>
                            <select class="form-select" id="module_filter">
                                <option value="">Select Module</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown" data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                    <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown" data-simplebar style="max-height: 300px;">
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked> Team</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1" checked> Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2" checked> Sub Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked> Menu</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked> Employee Name</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked> Contact Number</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6" checked> Position</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="7" checked> Type</label></li>
                    </ul>
                    <button id="generate_report" class="btn btn-danger btn-sm ms-1">Generate Report</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dt-responsive table-hover compact" id="user-list">
                        <thead class="table-dark text-uppercase">
                            <tr>
                                <th width="10%">Team</th>
                                <th width="20%">Module</th>
                                <th width="15%">Sub Module</th>
                                <th width="15%">Menu</th>
                                <th width="20%">Employee Name Assigned</th>
                                <th >Contact</th>
                                <th width="12%">Position</th>
                                <th>Type</th>
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

<style>
    tbody tr{
        color: black !important;
    }
</style>
<script>
$(document).ready(function() {
    $('#team_filter').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity });
    $('#module_filter').select2({ placeholder: 'Select Module Name', allowClear: true});

    var table = null;
    var printWindow = null; 
        if (table) {
            table.destroy();
        }
        table = $('#user-list').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "responsive": true,
            "lengthMenu": [[10, 25, 50, 500, 10000], [10, 25, 50, 500, "Max"]],
            "pageLength": 500,
            "ajax": {
                "url": '<?php echo base_url('Menu/Member/member_list'); ?>',
                "type": 'POST',
                "data": function(d) {
                    d.team = $('#team_filter').val();
                    d.module = $('#module_filter').val();
                },
            },
            "columns": [
                { "data": 'team_name' },
                { "data": 'module' },
                { "data": 'sub_module' },
                { "data": 'menu' },
                { "data": 'name' },
                { "data": 'contact_no' },
                { "data": 'position' },
                { "data": 'type' }
            ],
            rowCallback: function(row, data) {
                if (data.team_color) {
                    $(row).css('background-color', getColorCode(data.team_color));
                }
            },
            "paging": true,
            "searching": true,
            "ordering": true,
            "columnDefs": [
                { "className": "text-start", "targets": ['_all'] },
            ]
        });

        $('#columnSelectorDropdown').on('click', function (e) {
            e.stopPropagation();
        });
        $('#columnSelectorDropdown .column-toggle').each(function () {
            let columnIdx = $(this).val();
            $(this).prop('checked', table.column(columnIdx).visible());
        });

        $('#columnSelectorDropdown .column-toggle').on('change', function () {
            let columnIdx = $(this).val();
            let isChecked = $(this).prop('checked');
            table.column(columnIdx).visible(isChecked);
        });
        $('#generate_report').on('click', function () {

            if (printWindow && !printWindow.closed) {
                return;
            }

            let visibleColumns = [];
            let visibleHeaders = [];
            let desc = -1;
            table.columns().every(function (index) {
                let headerText = this.header().textContent.trim();
                if (this.visible() && headerText.toLowerCase() !== 'action') {
                    visibleColumns.push(index);
                    visibleHeaders.push(headerText);
                    if (headerText.toLowerCase() === 'position') {
                        desc = visibleColumns.length - 1;
                    }
                }
            });

            let rowData = table.rows({ filter: 'applied' }).data().toArray();
            let reportData = rowData.map(row => visibleColumns.map(index => row[table.column(index).dataSrc()]));
            let printContent = `
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    padding: 10px;
                    text-align: left;
                    border: 1px solid #ddd;
                    word-wrap: break-word;
                    max-width: 200px;
                    white-space: normal;
                }
                .description {
                    width: 300px;
                }
            </style>
            <div style="text-align: center; margin-bottom: 20px;"><h4>LIST OF MEMBERS AND MODULES</h4></div>
            <table>
                <thead>
                    <tr>${visibleHeaders.map((header, index) => 
                        `<th class="${index === desc ? 'description' : ''}">${header}</th>`
                    ).join('')}</tr>
                </thead>
                <tbody>
                    ${reportData.map((row, rowIndex) => 
                        `<tr>${row.map((cell, cellIndex) => 
                            `<td class="${cellIndex === desc ? 'description' : ''}">${cell}</td>`
                        ).join('')}</tr>`
                    ).join('')}
                </tbody>
            </table>`;
            printWindow = window.open('', '', '');
            printWindow.document.title = 'MEMBER LIST - PDF Export';
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        });


        $('#member-list').change(function () {
            table.ajax.reload();
        });


        $.ajax({
            url: '<?php echo base_url('get_team') ?>',
            type: 'POST',
            success: function (response) {
                teamData = JSON.parse(response);
                $('#team_filter').empty().append('<option value="">Select Team Name</option>');
                teamData.forEach(function (team) {
                    $('#team_filter').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
                });
            }
        });

        function load_mod(){
            $.ajax({
                url: '<?php echo base_url('Admin/setup_module_dat') ?>',
                type: 'POST',
                data: {
                    team: $('#team_filter').val()
                },
                success: function (response) {
                    moduleData = JSON.parse(response);
                    $('#module_filter').empty().append('<option value="">Select Module Name</option>');

                    moduleData.forEach(function (module) {
                        $('#module_filter').append('<option value="' + module.mod_id + '" data-typeofsystem="' + module.typeofsystem + '">' + module.mod_name + '</option>');
                    });
                }
            });
        }
        load_mod();
        $('#team_filter').change(function () {
            load_mod();
        });
        $('#team_filter, #module_filter').change(function () {
            table.ajax.reload();
        });
        function getColorCode(className) {
            const colors = {
                'bg-color-1': 'rgb(211, 240, 255)',   // Soft Sky Blue
                'bg-color-2': 'rgb(221, 251, 224)',   // Soft Mint Green
                'bg-color-3': 'rgb(251, 235, 203)',   // Warm Beige
                'bg-color-4': 'rgb(255, 223, 230)',   // Soft Rose Pink
                'bg-color-5': 'rgb(238, 222, 255)',   // Lilac Lavender
                'bg-color-6': 'rgb(224, 255, 255)',   // Pale Cyan
                'bg-color-7': 'rgb(250, 250, 210)',   // Light Lemon Yellow
                'bg-color-8': 'rgb(240, 248, 255)',   // Alice Blue
                'bg-color-9': 'rgb(253, 245, 230)',   // Eggshell
            };
            return colors[className] || '#ffffff';
        }



    });
</script>