<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Compose Message</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="compose_message">
        <div class="form-group"> 
          From:&nbsp;<strong><?php echo $_SESSION["admin_user_fname"] . ' '. $_SESSION["admin_user_lname"] . '('.$_SESSION ['admin_user_role'].')' ; ?></strong><br> 
        </div>
        <div class="form-group">   
       <!--    <select class="select2" multiple="multiple" data-placeholder="Select a State" id="to-emails" onkeydown="findemailadd()"> -->

            <input type="text" name=""  id="tags" list="productName" class="form-control" multiple/>
              <datalist id="productName">
              <option value="Pen">Pen</option>
              <option value="Pencil">Pencil</option>
              <option value="Paper">Paper</option>
              </datalist>
        </div>
        <div class="form-group">
          <label for="message-content">Content:</label>
          <textarea style="resize: none; height: 200px" class="form-control" id="message-content"></textarea>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send Message</button>
      </div>
    </div>
  </div>
</div>