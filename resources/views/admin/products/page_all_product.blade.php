@extends('admin.admin_master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Products</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image </th>
                                <th>Product Name </th>
                                <th>Price </th>
                                <th>QTY </th>
                                <th>Discount </th>
                                <th>Status </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <td> {{ $key+1 }} </td>
                                    <td> <img src="{{ asset($product->product_thumbnail) }}" style="width: 70px; height:40px;"  alt="Product Thumbnail">  </td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->selling_price }}</td>
                                    <td>{{ $product->product_quantity }}</td>
                                    <td>{{ $product->discount_price }}</td>
                                    <td>
                                        @if($product->status == 0)
                                            <span class="badge bg-danger">Inactive</span>
                                        @elseif($product->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit',$product->id) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('category.edit',$product->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{ route('category.destroy',$product->id) }}" class="btn btn-danger" id="delete" ><i class="fa-solid fa-trash-can"></i></a>
                                        @if($product->status == 0)
                                            <a href="{{ route('category.destroy',$product->id) }}" class="btn btn-info" id="delete" ><i class="fa-solid fa-thumbs-down"></i></a>
                                        @elseif($product->status == 1)
                                            <a href="{{ route('category.destroy',$product->id) }}" class="btn btn-info" id="delete" ><i class="fa-solid fa-thumbs-up"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
