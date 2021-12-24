<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" crossorigin="anonymous">
</head>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-primary card-outline">
                        <h3 class="card-title">Request List</h3>
                        <div class="card-tools pull-right">
                            <button class="btn btn-info" id="add-new"> Add New</button>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-body">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?= form_dropdown('filter',$status_arr , '', 'id="filter" class="form-control"')?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-body table-bordered ">
                            <table id="list" class="table table-bordered table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>Request Id</th>
                                        <th>Company</th>
                                        <th>Action By</th>
                                        <th>Uploaded Document Count</th>
                                        <th>Approver Document Count</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<?= view('request_creator/create')?>
<script type="text/javascript">
    var base_url = "<?= base_url()?>";
    $(document).ready(function(){
        $("#filter").change(function(){
            load_data();
        }).change();
        function load_data()
        {
            $('#list').DataTable({
                destroy:true,
                dom: 'lfBrtip',
                bFilter: false,
                "processing": true,
                "serverSide": false,
                'searching' : true,
                "paging": true,
                "ordering": true,
                "order"     : [],
                ajax: {
                    url: base_url + "/request_creator/lists",
                    type: "post",
                    data:{
                        'filter': $("#filter").val()
                    }
                },
                columns: [
                    { data: "request_id" },
                    { data: "company_name" },
                    { data: "action_by" },
                    { data: "upload_document" },
                    { data: "approver_document" },
                    { data: "status" },
                ]
            });
        }

        $("#add-new").click(function(){
            $("#insert-record").trigger('reset');
            $("#id").val('');
            $('#create').modal({backdrop: 'static', keyboard: false});
        });        
    })
</script>