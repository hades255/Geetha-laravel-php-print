<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Review Changes</h4>
			</div>
			<div class="modal-body">
				<div class="row">
				    <table class="table datatable table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date </th>
                            <th>Added By</th>
                            <th>Module</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                        <tbody>
                        @if ($reviewed->count())
                            @foreach ($reviewed as $row)
                                <tr>
                                    <td>{{ @format_datetime($row->created_at) }}</td>
                                    <td>{{ $row->bname }}</td>
                                    <td>{{ $row->module }}</td>
                                    <td>{{ $row->description }}</td>
                                    
                                </tr>
                            @endforeach
                        
                        @endif
                        </tbody>
                    <tfoot>
                        <tr>
                            <th>Date </th>
                            <th>Added By</th>
                            <th>Module</th>
                            <th>Description</th>
                        </tr>
                    </tfoot>
                </table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
	
	<script>
	    $(document).ready(function() {
            $('.datatable').DataTable();
	    });
	</script>