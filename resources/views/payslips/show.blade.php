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
                                <li class="breadcrumb-item"><a href="/payslips">Payslips</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $payslip->user->name }}</li>
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
                                <h6 class="text-light text-uppercase ls-1 mb-1">Manage Payslip</h6>
                                <h5 class="h3 text-primary mb-0">
                                    <i class="ni ni-money-coins"></i>
                                    Actions
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-block"><i class="fa fa-print"
                                onclick="window.print()"></i> Print</button>
                        <a href="{{ route('payslips.edit', $payslip) }}" class="btn btn-primary btn-block"><i
                                class="fa fa-edit"></i>
                            Edit</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                            data-target="#staticBackdrop">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">
                                            Delete Payslip
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <span class="text-muted">
                                            Are you sure you wish yo delete this payslip?
                                        </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <form action="{{ route('payslips.destroy', $payslip) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1" id="printable">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Human Resource Mnagement</h6>
                                <h5 class="h3 text-primary mb-0">
                                    <i class="ni ni-money-coins"></i>
                                    Payslip
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-around align-items-center">
                            <div>
                                <img src="{{ $payslip->user->image }}" class="rounded-circle bg-default" alt=""
                                    height="200">
                            </div>
                            <div>
                                <table class="table align-items-center table-flush">
                                    <tbody class="list">
                                        <tr>
                                            <th>Employee Name</th>
                                            <td>{{ $payslip->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Job Title</th>
                                            <td>{{ $payslip->user->title . ' Level ' . $payslip->user->level }}</td>
                                        </tr>
                                        <tr>
                                            <th>Employed Date</th>
                                            <td>{{ $payslip->user->created_at->format('jS F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Date</th>
                                            <td>{!! date('jS F Y', strtotime($payslip->paid_on)) !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Type</th>
                                            <td>{{ $payslip->type }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <tbody class="list">
                                    <tr>
                                        <th>Amount due</th>
                                        <td>MVR {!! number_format($payslip->amount / 100, 2) !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Service Charge</th>
                                        <td>MVR {!! number_format($payslip->service_charge / 100, 2) !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Payable</th>
                                        <td>MVR {!! number_format($payslip->total / 100, 2) !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="my-4" />
                        <div>
                            <h5>Remarks:</h5>
                            <small>{{ $payslip->remarks }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
