<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <form action="{{route('admin.'.$resource.'.destroy','delete')}}" method="post">
            @method('DELETE')
            @csrf
          <div class="modal-body">
                <p>
                    Are you sure you want to delete this?
                </p>
                <input type="hidden" name="resource_id" id="resource_id" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
          </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var resource_id = button.data('resourceid')
  var modal = $(this)
  modal.find('.modal-body #resource_id').val(resource_id);
})
</script>
@endpush
