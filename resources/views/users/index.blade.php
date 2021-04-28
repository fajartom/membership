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
    <div class="card-header border-0">
        <div class="row align-items-center">
        <div class="col"><h3 class="mb-0 text-uppercase">Users table</h3></div>
          <div class="col text-right">
            @can('user-create')
            <a class="btn btn-sm btn-primary text-capitalize" href="{{ route('users.create', $locale) }}"> Create </a>
            @endcan
        </div>
    </div>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Roles</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
        <tbody> 
        @foreach ($users as $key => $user)
        <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>@if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </td>
        <td>
            <a class="btn btn-sm btn-info" href="{{ route('users.show',[$locale, $user->id]) }}">Show</a>
            @can('user-edit')
                <a class="btn btn-sm btn-primary" href="{{ route('users.edit',[$locale, $user->id]) }}">Edit</a>
            @endcan
            @can('user-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $locale, $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
        </tr>
    @endforeach
        </tbody>
    </table>
    <div class="card-footer py-4"> 
    {!! $users->render() !!}
    </div>
    </div>
</div>
</div>
</div>






@endsection