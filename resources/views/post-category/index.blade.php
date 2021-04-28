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
        <div class="col"><h3 class="mb-0 text-uppercase">Post Category table</h3></div>
          <div class="col text-right">
            @can('post-category-create')
            <a class="btn btn-sm btn-primary text-uppercase" href="{{ route('post-category.create', $locale) }}"> Create</a>
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
                <th scope="col">Slug</th>
                <th scope="col">Order</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
        <tbody> 
        @foreach ($cat as $key => $v)
        <tr>
        <td>{{ ++$i }}</td>
        <td><label class="badge badge-success">{{ $v->name }}</label></td>
        <td>{{ $v->slug}}</td>
        <td>{{ $v->order}}</td>
        <td>
            <a class="btn btn-sm btn-info" href="{{ route('post-category.show',[$locale, $v->id]) }}">Show</a>
            @can('post-category-edit')
                <a class="btn btn-sm btn-primary" href="{{ route('post-category.edit',[$locale, $v->id]) }}">Edit</a>
            @endcan
            @can('post-category-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['post-category.destroy', $locale, $v->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(are you sure?)']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
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