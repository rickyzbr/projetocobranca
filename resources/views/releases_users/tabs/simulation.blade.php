<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#newSimulation_{{ $client->id }}"><i class="far fa-calendar-plus"></i> Nova Simulação </button>
<div class="table-wrap">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Invoice</th>
                <th>User</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            @for($i=1; $i <= $parcelas; $i++)
                <td><a href="javascript:void(0)">Order #26589</a></td>
                <td>Herman Beck</td>
                <td><span class="text-muted"><i class="icon-clock font-13"></i> Oct 16, 2016</span> </td>
                <td>$45.00</td>
                <td>
                    <div class="badge badge-success">Paid</div>
                </td>
                <td>EN</td>
            </tr>
            @endfor
        </tbody>
    </table>  
</div>   