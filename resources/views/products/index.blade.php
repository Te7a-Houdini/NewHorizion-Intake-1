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
      <th> Delete By Ajax </th>
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

      <td>
          <a id="{{$product->id}}" class="btn btn-info delete-by-ajax" href="/google.com"> Delete By Ajax </a>
      </td>
    </tr>
@endforeach

  </tbody>
</table>

<script>
$('.delete-by-ajax').click(function(event){
  event.preventDefault();

var ajaxConfiguration = {
   'url' : '/products/' + $(this).attr('id'),
   'method' : 'POST',
   'data' : {
     '_method' : 'DELETE',
     '_token' : '{{csrf_token()}}'
   }};

 $.ajax( ajaxConfiguration)
  .done(function() {
    //after ajax request
    $(this).parent().parent().css('display','none')
  })
  .fail(function(error) {
    console.log( error );
  });



 //another method to remove dom element
  //$(this).parent().parent().remove()
  //$(this).parent().parent().css('display','none')
 
});
</script>
</div>
@endsection