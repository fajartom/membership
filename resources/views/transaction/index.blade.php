@extends('layouts.app')


@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 mb-5">
  <div class="container-fluid">
    <div class="header-body mb-4">
      <!-- Card stats -->
      <div class="row">
       
      </div>
  </div>
</div>
</div>
<div class="container-fluid mt--7">
  <!-- Table -->
  <div class="row">
    <div class="col">
       <div class="card shadow">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col"><h3 class="mb-0 text-uppercase">Transcation</h3></div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Name</th>
                        <th scope="col">Member Type</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Date Payment</th>
                        <th scope="col">Action</th>
                        
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($cat as $key => $v)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td><label class="badge badge-success">{{ $v->invoice }}</label></td>
                        <td>{{ $v->name }}</td>
                        <td>{{ $v->member_name }}</td>
                        <td>{{ $v->artist_name }}</td>
                        <td>{{ $v->total_amount }}</td>
                        <td>{{ $v->payment_method_name }}</td>
                        <td>{{ $v->date_pay }}</td>
                        <td><a class="btn btn-sm btn-primary" href="{{ route('transaction.edit',[$locale, $v->id]) }}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer py-4"> 
                {!! $cat->render() !!}
            </div>
        </div>
    </div>
</div>
</div>






@endsection