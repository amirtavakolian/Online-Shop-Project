<div class="modal fade" id="newIssue" tabindex="-1" role="dialog" aria-labelledby="newIssue"
     aria-hidden="true">
    <div class="modal-wrapper">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                    <h4 class="modal-title"><i class="fa fa-pencil"></i> Create New Issue</h4>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input name="subject" type="text" class="form-control"
                                   placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <input name="department" type="text" class="form-control"
                                   placeholder="Department">
                        </div>
                        <div class="form-group">
                                                    <textarea name="message" class="form-control"
                                                              placeholder="Please detail your issue or question"
                                                              style="height: 120px;"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="attachment">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="fa fa-times"></i> Discard
                        </button>
                        <button type="submit" class="btn btn-primary pull-right"><i
                                class="fa fa-pencil"></i> Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
