<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Request</h5>
            </div>
            <form id='insert-record' enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Request Id:</label>
                        <input type="hidden" name="id" id="id">
                        <?= form_input('request_id', '', 'id="request_id" class="form-control" required=""');?>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Company:</label>
                        <?= form_dropdown('company_id', $company_arr, '', 'id="company_id" class="form-control" required=""')?>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Files:</label>
                        <input required='' accept="image/*, .pdf" type="file" name="files[]" id="files" class="form-control" multiple="multiple"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>