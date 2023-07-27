<html>


<table class="table table-bordered table-striped" id="contact_opening_balance_table">
    <thead>
        <tr>
            <th>Contact Id</th>
            <th>Name</th>
            <th>Type</th>
            
            <th>Outstanding Days 1</th>
            <th>Amount 1</th>
            <th>Invoice No 1</th>
            
            <th>Outstanding Days 2</th>
            <th>Amount 2</th>
            <th>Invoice No 2</th>
            
            <th>Outstanding Days 3</th>
            <th>Amount 3</th>
            <th>Invoice No 3</th>
            
            <th>Outstanding Days 4</th>
            <th>Amount 4</th>
            <th>Invoice No 4</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $one)
            <tr>
                <td>{{$one['contact_id']}}</td>
                <td>{{$one['name']}}</td>
                <td>{{$one['type']}}</td>
                
                <td></td>
                <td></td>
                <td></td>
                
                <td></td>
                <td></td>
                <td></td>
                
                <td></td>
                <td></td>
                <td></td>
                
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>
</html>    