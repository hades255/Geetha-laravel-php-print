@php

$notification_numbers = json_decode($contact->notification_contacts,true);

@endphp

<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('ContactController@save_notification_numbers', [$contact->id]), 'method' => 'POST', 'id' =>
    'add_notification_numbers_form']) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang('messages.add_more_numbers')</h4>
    </div>

    <div class="modal-body"> 

    <div class="col-md-12">
        <table class="table table-bordered table-striped" style="width: 100%" id="numbers_table">
            <thead>
                <tr>
                    <th>Number</th>
                    @foreach($notifications as $key => $notification)
                        <th>{{$notification['name']}}</th>
                    @endforeach
                    
                    <th>*</th>
                </tr>
            </thead>
            
            <tbody>
                @if(empty($notification_numbers))
                    <tr>
                        <td>
                            {!! Form::text('phone_number[]', null, ['class' => 'form-control', 'required']); !!}
                        </td>
                        @foreach($notifications as $key => $notification)
                            <td class="text-center">
                                {!! Form::checkbox($key . '[]', 1, false, ['class' => 'toggler', 'data-toggle_id' => 'base_unit_div']) !!}
                            </td>
                        @endforeach
    
                        <td>
                            <button type="button" id="add_number_row" class="btn btn-success">+</button>
                        </td>
                    </tr>
                @else
                
                    @php $count = 0; @endphp
                
                    @foreach($notification_numbers as $no)
                        <tr>
                            <td>
                                {!! Form::text('phone_number[]', $no['phone_number'], ['class' => 'form-control', 'required']); !!}
                            </td>
                            @foreach($notifications as $key => $notification)
                                <td class="text-center">
                                    {!! Form::checkbox($key . '[]', 1, !empty($no['notifications'][$key]) ? $no['notifications'][$key] : false, ['class' => 'toggler', 'data-toggle_id' => 'base_unit_div']) !!}
                                </td>
                            @endforeach
        
                            <td>
                                @if($count == 0)
                                    <button type="button" id="add_number_row" class="btn btn-success">+</button>
                                @else
                                    <button type="button" class="btn btn-danger remove-number-row">-</button>
                                @endif
                                
                            </td>
                        </tr>
                        @php $count++; @endphp
                    @endforeach
                
                @endif
                
            </tbody>
            
        </table>
    </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
$(document).ready(function() {
    // Add row when add_number_row button is clicked
    $('#numbers_table').on('click', '#add_number_row', function() {
        var lastRow = $('#numbers_table tbody tr:last');
        var newRow = lastRow.clone(); // Clone the last row
        newRow.find('input[type="text"]').val(''); // Clear the input value
        lastRow.after(newRow); // Append the new row after the last row

        // Add remove button to the new row
        var removeButton = $('<button>', {
            'type': 'button',
            'class': 'btn btn-danger remove-number-row',
            'text': '-'
        });
        newRow.find('td:last').html(removeButton); // Add the remove button to the last cell
    });

    // Remove row when remove-number-row button is clicked
    $('#numbers_table').on('click', '.remove-number-row', function() {
        $(this).closest('tr').remove(); // Remove the row
    });
    
    
    $('#add_notification_numbers_form').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally
      
      var formData = []; // Array to store form data
      
      // Loop through each table row
      $('#numbers_table tbody tr').each(function() {
        var phoneNumber = $(this).find('input[name="phone_number[]"]').val(); // Get phone number value
        var checkboxes = $(this).find('.toggler'); // Get checkboxes
        
        var rowValues = {
          'phone_number': phoneNumber,
          'notifications': {} // Object to store checkbox values
        };
        
        checkboxes.each(function() {
          var checkboxName = $(this).attr('name').replace('[]', ''); // Get the checkbox name
          var checkboxValue = $(this).is(':checked') ? 1 : 0; // Determine checkbox value (1 if checked, 0 if not)
          rowValues['notifications'][checkboxName] = checkboxValue; // Add checkbox name and value to rowValues object
        });
        
        formData.push(rowValues); // Add rowValues to formData array
      });
     
      
      $.ajax({
        url: $(this).attr('action'), // Get the form action URL
        method: $(this).attr('method'), // Get the form method (POST)
        data: {formadata : formData}, // Set the serialized form data as the request data
        success: function(result) {
          
          if(result.success == 1){
                toastr.success(result.msg);
                $('.contact_modal').modal('hide');
            }else{
                toastr.error(result.msg);
    
            }
        },
        error: function(xhr, status, error) {
          // Handle the error response here
          console.error(error);
        }
      });
    });
    
});
</script>

