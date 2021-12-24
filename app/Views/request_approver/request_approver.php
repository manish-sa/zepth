<?= view('header')?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-primary card-outline">
                        <h3 class="card-title">Approver List</h3>
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
                                        <th>Action</th>
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
<?= view('request_approver/update')?>
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
                    { 
                        data: "id",
                        "orderable": false,
                        "render": function ( data, type, full, meta ) {
                            var html = '';
                            if(full.status == 'Pending'){
                                html += '<i data-id="'+full.id+'" class="pointer fa fa-pencil-square-o edit" aria-hidden="true"></i>';
                            }
                            return html;
                        }
                    },
                ]
            });
        }

        $(document).on('click', ".edit", function(){
            var id = $(this).data('id');
            $("#update-record").trigger('reset');
            $.ajax({
                url:base_url+"/approver/"+id,
                type: "GET",
                dataType: 'json',
                success: function(res) {
                    if(res.id){
                        $('#update').modal({backdrop: 'static', keyboard: false});
                        $("#company_id").html(res.company_name);
                        $("#request_id").html(res.request_id);
                        $("#id").val(res.id);
                        $("#update-record").attr('action', 'approver/'+res.id)
                    }else{
                        toastr.error('Something want wrong');
                    }
                }
            });
        });
    })
</script>