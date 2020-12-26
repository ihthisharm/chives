@extends('layouts.dashboard')

@section('content')

    <div class="header bg-success pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-neutral"><i class="fa fa-arrow-left"></i>
                            Back</a>
                        <a href="#" data-target="#edit-category" data-toggle="modal" class="btn btn-sm btn-neutral"><i
                                class="fa fa-edit"></i> Edit</a>
                        <a href="#" data-target="#delete-category" data-toggle="modal"
                            class="text-danger btn btn-sm btn-neutral"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                    @include('categories.create-modal')
                </div>
                {{-- @include('partials.dashboard-stats') --}}
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <img src="{{ $category->image }}" alt="Image placeholder" class="card-img-top">
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="h3">
                                {{ $category->name }}
                            </h5>
                            <div>
                                <small class="text-muted">{{ $category->description }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Restaurant Management</h6>
                                <h5 class="h3 text-primary mb-0">
                                    <i class="ni ni-archive-2"></i> {{ $category->name }}
                                    Category
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Item</th>
                                    <th scope="col" class="sort" data-sort="status">Description</th>
                                    <th scope="col" class="sort" data-sort="name">Price</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <tr colspan="3">
                                    <td>No items in {{ $category->name }} category</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('categories.edit-modal')
    @include('categories.delete-modal')
@endsection
