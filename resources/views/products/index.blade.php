@extends('layouts.app')

@section('content')

<div class="container"> 
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">Category Id</th>
      <th scope="col">Image</th>
      <th>Delete</th>
      <th> View </th>
    </tr>
  </thead>
  <tbody>
  @foreach($products as $product)

    <tr>
      <th scope="row">{{$product->id}}</th>
      <td>{{$product->name}}</td>
      <td>{{ optional($product->category)->name}}</td>
      <td><img width="60" height="60" src="{{Storage::url($product->image)}}"  ></td>

      <td>
        <form method="POST" action="/products/{{$product->id}}">
          @csrf
          @method('DELETE')
          <input type="submit" class="btn btn-danger" value="Delete">
        </form>
      </td>

      <td>
          <a class="btn btn-primary" href="/products/{{$product->id}}"> View </a>
      </td>
    </tr>
@endforeach

  </tbody>
</table>

</div>
@endsection