<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Request</h5>
            </div>
            <form id='update-record' enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Company: </label>
                        <span id="company_id"></span>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <label class="col-form-label">Request Id: </label>
                        <span id="request_id"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">User:</label>
                        <?= form_dropdown('user_id', $user_arr, '', 'id="user_id" class="form-control" required=""')?>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Status:</label>
                        <?php unset($status_arr['Pending']);?>
                        <?= form_dropdown('status', $status_arr, '', 'id="status" class="form-control" required=""')?>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Files:</label>
                        <input required='' accept="image/*, .pdf" type="file" name="files[]" id="files" class="form-control" multiple="multiple"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>