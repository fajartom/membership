@extends('layouts.app')


@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
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
        <div class="col"><h3 class="mb-0 text-uppercase">Show {{ Request::segment(1) }}</h3></div>
        <div class="col text-right">
            
            <a class="btn btn-sm btn-primary" href="{{ route('roles.index', $locale)}}">Back</a>
        
        </div>
          
    </div>
    </div>
    
        <div class="card-body">
            <div class="row">
            <div class="col">
            <table style="float:left;" cellpadding="2px">
            <tr>
                <td><strong>Name</strong></td>
            </tr>
            <tr>
                <td>{{ $role->name }}</td>
           
            
            </tr>
            </table>
            </div>
            <div class="col">
            <table style="float:left;" cellpadding="2px">
              <tr>
                <td>
                <strong>Permissions</strong>
                </td>
            </tr>   
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
            
            <tr>
                <td>
                    {{ $v->name }}
                </td>        
            </tr>

                @endforeach
            </td>
        </tr>
            @endif

        </table>
        </div>
        </div>
        </div>
</div>
</div>
</div>
@endsection