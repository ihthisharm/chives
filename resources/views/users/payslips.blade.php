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
                                <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="/users">Staff</a></li>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
                                </li>
                                <li class="breadcrumb-item active">Payslips</li>
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
                <div class="card card-profile">
                    <img src="{!!  asset('app-assets/img/brand/' . strtolower($user->title) . '.png') !!}"
                        alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ $user->image }}" class="rounded-circle bg-default">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">{{ $user->title }}</span>
                                        <span class="description">Title</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $user->level }}</span>
                                        <span class="description">Level</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $user->salary }}</span>
                                        <span class="description">Salary</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="h3">
                                {{ $user->name }}<span class="font-weight-light">, {{ $user->age }}</span>
                            </h5>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ $user->email }}
                            </div>
                            <h5>{{ $user->id_card }}</h5>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i> Phone: {{ $user->phone }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>
                                <small
                                    class="text-muted">{{ $user->employed ? 'Employed Since ' . $user->created_at->diffForHumans() : 'Terminated' }}</small>
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
                                <h6 class="text-light text-uppercase ls-1 mb-1">Human Resource Mnagement</h6>
                                <h5 class="h3 text-primary mb-0"><i class="ni ni-single-02"></i>
                                    {{ $user->title . ' ' . $user->name }}'s
                                    Payslips
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Date</th>
                                        <th scope="col" class="sort" data-sort="name">Payment Type</th>
                                        <th scope="col" class="sort" data-sort="budget">Amount</th>
                                        <th scope="col" class="sort" data-sort="status">Service Charge</th>
                                        <th scope="col" class="sort" data-sort="status">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($user->payslips))
                                        @foreach ($user->payslips as $payslip)
                                            <tr>
                                                <td><a href="{{ route('payslips.show', $payslip) }}"><i
                                                            class="fa fa-eye mr-1"></i></a>{{ $payslip->paid_on }}</td>
                                                <td>{{ $payslip->type }}</td>
                                                <td>MVR {!! number_format($payslip->amount / 100, 2) !!}</td>
                                                <td>MVR {!! number_format($payslip->service_charge / 100, 2) !!}</td>
                                                <td>MVR {!! number_format($payslip->total / 100, 2) !!}</td>
                                            </tr>
                                        @endforeach
                                    @else

                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
