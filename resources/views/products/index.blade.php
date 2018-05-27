@extends('layouts.app')

@section('content')

@foreach($products as $product)
   {{$product->id}} | {{$product->name}} | {{$product->category_id}}
<br>
@endforeach

@endsection