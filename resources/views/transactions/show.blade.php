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
                                <li class="breadcrumb-item"><a href="/transactions">Transactions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $transaction->id }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-neutral"><i class="fa fa-arrow-left"></i>
                            Back</a>
                    </div>
                </div>
                {{-- @include('partials.dashboard-stats') --}}
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Manage Transaction</h6>
                                <h5 class="h3 text-primary mb-0">
                                    <i class="ni ni-money-coins"></i>
                                    Actions
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#edit-transaction"><i
                                class="fa fa-edit"></i>
                            Edit</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                            data-target="#delete-transaction">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        @include('transactions.edit-transaction')
                        @include('transactions.delete-transaction')
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1" id="printable">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Financial Management</h6>
                                <h5 class="h3 text-primary mb-0">
                                    <i class="ni ni-money-coins"></i>
                                    Transaction
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <h5 class="d-inline">Staff Name:</h5>
                            <p class="d-inline text-muted">{{ $transaction->user->name }}</p>
                        </div>
                        <div>
                            <h5 class="d-inline">Transaction Date:</h5>
                            <p class="d-inline text-muted">{{ date('l, d F Y', strtotime($transaction->date)) }}</p>
                        </div>
                        <div>
                            <h5 class="d-inline">Transaction Title:</h5>
                            <p class="d-inline text-muted">{{ $transaction->title }}</p>
                        </div>
                        <div>
                            <h5 class="d-inline">Remarks:</h5>
                            <p class="d-inline text-muted">{{ $transaction->remarks }}</p>
                        </div>
                        <hr class="my-4">
                        <h5 class="h2 text-right">
                            Amount: MVR {!! $transaction->income ? number_format($transaction->income / 100, 2) :
                            number_format(-$transaction->expense / 100, 2) !!}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
