@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Laravel API CRUD with Docker</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-sm table-responsive table-bordered table-hover">
        <caption style="text-align:center;"> List of Products </caption>
        <thead class="thead-dark" style="text-align: center;">
            <th>#</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </thead>
        @foreach ($products as $product)
        <tbody >
            <td style="text-align: center;">{{ $product['id'] }}</td>
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['detail'] }}</td>
            <td style="text-align: center;">
                <form action="{{ route('products.destroy',$product['id']) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('products.show',$product['id']) }}">Show</a>
 
                    <a class="btn btn-primary" href="{{ route('products.edit',$product['id']) }}">Edit</a>

                    @csrf
                    @method('DELETE')
   
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tbody>
        @endforeach
    </table>

@endsection