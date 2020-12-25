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
                    <a href="#" data-target="#createmodal" data-toggle="modal" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i>Add</a>
                </div>
                @include('categories.create-modal')
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
                            <h5 class="h3 text-primary mb-0"><i class="ni ni-money-coins"></i> All Categories</h5>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Image</th>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="budget">Slug</th>
                                <th scope="col" class="sort" data-sort="status">Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($categories))
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <img src="{{$category->image}}" height="150px"/>
                                        </td>
                                        <td>
                                            {{$category->name}}
                                        </td>
                                        <td>
                                            {{$category->slug}}
                                        </td>
                                        <td>
                                            {!!substr($category->description, 0, 60)!!}
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"
                                                        href="{{-- route('payslips.show', $payslip) --}}">View</a>
                                                    <a class="dropdown-item"
                                                        href="{{-- route('payslips.edit', $payslip) --}}">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr colspan="4">No Categories to display</tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection