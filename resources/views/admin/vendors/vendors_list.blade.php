@extends('admin.admin_master')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Vendors</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $status }}</li>
                        </ol>
                    </nav>
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
                                <th>Shop Name</th>
                                <th>Email</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vendors as $key => $vendor)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>
                                        <a class="{{ $vendor->status == 'inactive' ? 'btn-sm btn-danger' : 'btn-sm btn-info' }}">{{ $vendor->status }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('vendor.details', $vendor->id) }}" class="btn-sm btn-primary">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
