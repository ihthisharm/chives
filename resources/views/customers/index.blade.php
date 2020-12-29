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
                                <li class="breadcrumb-item active" aria-current="page">Customers</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="#" data-toggle="modal" data-target="#create-customer" class="btn btn-sm btn-neutral"><i
                                class="fa fa-plus"></i>
                            Add</a>
                    </div>
                    @include('customers.create-customer')
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
                                <h6 class="text-light text-uppercase ls-1 mb-1">Restaurant Mnagement</h6>
                                <h5 class="h3 text-primary mb-0"><i class="ni ni-satisfied"></i> Registered Customers</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">Customer</th>
                                    <th scope="col" class="sort">Contact</th>
                                    <th scope="col" class="sort">Credit</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($customers))
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->name }} <span
                                                    class="text-muted d-block">{{ $customer->account }}</span></td>
                                            <td>{{ $customer->contact }}</td>
                                            <td>MVR {!! number_format($customer->credit / 100, 2) !!}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="">View</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#edit-customer-{{ $customer->id }}">Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#clear-customer-{{ $customer->id }}">Clear</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#delete-customer-{{ $customer->id }}">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('customers.edit-customer')
                                        @include('customers.clear-customer')
                                        @include('customers.delete-customer')
                                    @endforeach
                                @else
                                    <tr colspan="7">No Payslips to display</tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 d-flex justify-content-end">
                        {{ $customers->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
