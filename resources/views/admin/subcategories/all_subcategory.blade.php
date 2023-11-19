@extends('admin.admin_master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Sub-categories</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Sub-category</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('subcategory.create') }}" class="btn btn-primary">Add New</a>
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
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subcategories as $key => $subcategory)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $subcategory['category']['category_name'] }}</td>
                                    <td>{{ $subcategory->subcategory_name }}</td>
                                    <td>61</td>
                                    <td>
                                        <a href="{{ route('subcategory.edit', $subcategory->id) }}" class="btn-sm btn-info">Edit</a>
                                        <form style="display: inline-block" action="{{ route('subcategory.destroy', $subcategory->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
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
