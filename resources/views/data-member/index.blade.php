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
                <div class="col"><h3 class="mb-0 text-uppercase">Subscriber</h3></div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Type</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($cat as $key => $v)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td><label class="badge badge-success">{{ $v->name }}</label></td>
                        <td>{{ $v->email }}</td>
                        <td>{{ $v->member }}</td>
                        <td>{{ $v->periode }} Month</td>
                        <td>{{ $v->artist }}</td>
                         @if($v->status==1)
                        <td><label class="badge badge-success">Active</label></td>
                        @endif
                        @if($v->status==2)
                        <td><label class="badge badge-warning">Expired</label></td>
                        @endif
                        @if($v->status==3)
                        <td><label class="badge badge-info">Registered</label></td>
                        @endif
                        @if($v->status==4)
                        <td><label class="badge badge-warning">Payment Pending</label></td>
                        @endif
                        @if($v->status==5)
                        <td><label class="badge badge-danger">Suspend</label></td>
                        @endif
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