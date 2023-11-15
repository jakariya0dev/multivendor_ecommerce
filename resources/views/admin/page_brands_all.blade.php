@extends('admin.admin_master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Brands</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Brands</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('brands.create') }}" class="btn btn-primary">Add New</a>
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
                                <th>SL</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $key => $brand)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img src="{{ asset($brand->brand_image) }}" alt="Brand image" style="width: 40px; height: 40px"></td>
                                    <td>61</td>
                                    <td>
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn-sm btn-info">Edit</a>
                                        <form style="display: inline-block" action="{{ route('brands.destroy', $brand->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" value="{{ $brand->brand_image }}" name="brand_image">
                                            <button id="delete-brand-image" class="btn-sm btn-danger">Delete</button>
                                        </form>
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
