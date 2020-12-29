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
                                <li class="breadcrumb-item active" aria-current="page">Payslips</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="/payslips/create" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Pay</a>
                    </div>
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
                                <h6 class="text-light text-uppercase ls-1 mb-1">Human Resource Mnagement</h6>
                                <h5 class="h3 text-primary mb-0"><i class="ni ni-money-coins"></i> Payslip History</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Staff</th>
                                    <th scope="col" class="sort" data-sort="name">Date</th>
                                    <th scope="col" class="sort" data-sort="budget">Type</th>
                                    <th scope="col" class="sort" data-sort="status">Amount</th>
                                    <th scope="col" class="sort" data-sort="status">Service Charge</th>
                                    <th scope="col" class="sort" data-sort="status">Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($payslips))
                                    @foreach ($payslips as $payslip)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <a href=" /users/{{ $payslip->user->id_card }}/payslips"
                                                        class="avatar rounded-circle bg-default mr-3">
                                                        <img alt="{{ $payslip->user->name }}"
                                                            src="{{ $payslip->user->image }}">
                                                    </a>
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm"> {{ $payslip->user->name }}</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                {{ $payslip->paid_on }}
                                            </td>
                                            <td>
                                                {{ $payslip->type }}
                                            </td>
                                            <td class="budget">
                                                MVR {!! number_format($payslip->amount / 100, 2) !!}
                                            </td>
                                            <td class="budget">
                                                MVR {!! number_format($payslip->service_charge / 100, 2) !!}
                                            </td>
                                            <td class="budget">
                                                MVR {!! number_format($payslip->total / 100, 2) !!}
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item"
                                                            href="{{ route('payslips.show', $payslip) }}">View</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('payslips.edit', $payslip) }}">Edit</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr colspan="7">No Payslips to display</tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 d-flex justify-content-end">
                        {{ $payslips->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
