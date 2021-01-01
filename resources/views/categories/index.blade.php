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
                                <li class="breadcrumb-item active" aria-current="page">Categories</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="#" data-target="#create-category" data-toggle="modal" class="btn btn-sm btn-neutral"><i
                                class="fa fa-plus"></i> Add</a>
                    </div>
                    @include('categories.create-category')
                </div>
                {{-- @include('partials.dashboard-stats') --}}
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Restaurant Management</h6>
                                <h5 class="h3 text-primary mb-0"><i class="ni ni-archive-2"></i> All Categories</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Category</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($categories))
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <a href="{{ route('categories.show', $category->slug) }}"
                                                        class="bg-default mr-3">
                                                        <img alt="{{ $category->name }}" src="{{ $category->image }}"
                                                            width="90">
                                                    </a>
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm"><a
                                                                href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></span>
                                                        <span class="d-block text-muted text-wrap">
                                                            {!! strlen($category->description) > 70 ?
                                                            substr($category->description, 0, 150) . '...' :
                                                            $category->description !!}
                                                        </span>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr colspan="4">
                                        <td>No Categories to display</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
