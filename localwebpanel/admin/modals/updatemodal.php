
<div class="modal fade" id="modal-update">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Write Update Query</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="card-body">
            <div class="row">
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="updatetable"  placeholder="Enter table name">  
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="updatecolumnname" placeholder="Enter column name">  
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="updatewhereclause" placeholder="Enter where clause">  
              </div>
              <div class="input-group mb-3">
                <textarea class="form-control" id="updatequery" disabled=""></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="update()">Submit</button>
          </div>
        </div>
    </div>
  </div>
</div>

