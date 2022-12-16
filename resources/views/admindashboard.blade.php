@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Categories</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered mt-5">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Parent_Category</th>
   <th>Action</th>
 </tr>
 
@php $i = 0; @endphp
 @foreach ($categories as $key => $categorie)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $categorie->name }}</td>
    <td>{{ $categorie->parent_category_id }}</td>
    <td>
       <a class="btn btn-info" href="{{ route('categories.show',$categorie->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('categories.edit',$categorie->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $categorie->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
  @if(count($categorie->children))
  @php $j= 0 @endphp
  @foreach($categorie->children as $child)
  <tr>
    <td>{{ $i }}.{{++$j}}</td>
    <td>{{ $child->name }}</td>
    <td>{{ $categorie->name }}</td>
    <td>
       <a class="btn btn-info" href="{{ route('categories.show',$child->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('categories.edit',$child->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $child->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr> 
  @endforeach
  @endif

 @endforeach
</table>

@endsection
