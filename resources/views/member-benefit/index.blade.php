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
        <div class="col"><h3 class="mb-0 text-uppercase">Member Benefit table</h3></div>
          <div class="col text-right">
        </div>
    </div>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
        <tbody> 
        @foreach ($member as $key => $v)
        <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $v->name }}</td>
        <td>
            <a class="btn btn-sm btn-info" href="{{ route('member-benefit.show',[$locale, $v->id]) }}">Show</a>
            @can('member-benefit-edit')
                <a class="btn btn-sm btn-primary" href="{{ route('member-benefit.edit',[$locale, $v->id]) }}">Edit</a>
            @endcan
        </td>
        </tr>
    @endforeach
        </tbody>
    </table>
    <div class="card-footer py-4"> 
    {!! $member->render() !!}
    </div>
    </div>
</div>
</div>
</div>
@endsection