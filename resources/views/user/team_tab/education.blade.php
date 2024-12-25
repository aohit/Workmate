
<div class="card">
  <div class="card-body">
    <table class="table table-hover table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">Items</th>
          <th scope="col">Currency</th>
          <th scope="col">Amount</th>
        </tr>
      </thead>
      <tbody>
        @php
            $totalamount = 0;
            $currency = '';
        @endphp
        @foreach ($wageses as $wages)
        <tr>
          <th scope="row">{{ $wages->items }}</th>
          <th>{{ $wages->currency }}</th>
          <th>{{ $wages->amount }}</th>
        </tr>
        <?php 
        $currency = $wages->currency;
          $totalamount += (int)$wages->amount;
        ?>
        @endforeach
        <tfoot>
          <tr>
            <th scope="col">Total Gross Monthly Benefit</th>
            <th scope="col">{{$currency}}</th>
            <th scope="col"> {{$totalamount.' '.$currency }} </th> 
          </tr>
        </tfoot>
      </tbody>
    </table>
  </div>
</div>