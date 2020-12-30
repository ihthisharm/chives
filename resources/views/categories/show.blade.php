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
                    @include('categories.edit-category')
                    @include('categories.delete-category')
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
                                    <th scope="col" class="sort" data-sort="name">Price</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($items))
                                    @foreach ($items as $item)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <a href="{{ route('items.show', $item->slug) }}"
                                                        class="bg-default mr-3">
                                                        <img alt="{{ $item->name }}" src="{{ $item->image }}" width="50">
                                                    </a>
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm"><a
                                                                href="{{ route('items.show', $item) }}">{{ $item->name }}</a></span>
                                                        <span class="d-block text-muted">
                                                            {!! strlen($item->description) > 40 ? substr($item->description,
                                                            0, 40) . '...' : $item->description !!}
                                                        </span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                MVR {!! number_format($item->price / 100, 2) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr colspan="3">
                                        <td>No items in {{ $category->name }} category</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('categories.edit-category')
    @include('categories.delete-category')
@endsection
