<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- loading --}}
        <div class="text-center">
          <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        {{-- end loading --}}
      </div>
    </div>
  </div>
</div>

@push('after-scripts')
<script>
  $('#show-modal').on('show.bs.modal', event => {
    var button = $(event.relatedTarget);
    var modal = $(this);
    // Use above variables to manipulate the DOM
    $('.modal-body').load(button.data('url'));
    $('.modal-title').text(button.data('title'));
  });
</script>
@endpush