<fieldset>
  <div class="modal fade upload-modal" id="uploadModal<?= $num ?>" tabindex="-1" aria-labelledby="labelUploadModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelUploadModal">Image Upload</h5>
          <button type="button" class="btn-close modal-cancel" data-bs-dismiss="modal" data-modal-num="<?= $num ?>" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row row-cols-md-auto align-items-center mb-3 mb-md-4">
            <div class="col-md-3 text-md-end">
              <label for="inputImage<?= $num ?>" class="col-form-label">Image Source</label>
            </div>
            <div class="col-md-7">
              <input type="file" name="image<?= $num ?>" value="" class="form-control" id="inputImage<?= $num ?>" accept="image/*" aria-describedby="helpImage<?= $num ?>">
            </div>
            <div id="helpImage<?= $num ?>" class="form-text offset-md-3">Must be an image smaller than 2MB</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary modal-cancel" data-modal-num="<?= $num ?>" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary modal-save" data-modal-num="<?= $num ?>" data-bs-dismiss="modal">Use Image</button>
        </div>
      </div>
    </div>
  </div>
</fieldset>