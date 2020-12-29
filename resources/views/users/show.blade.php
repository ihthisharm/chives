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
                                <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-neutral"><i class="fa fa-arrow-left"></i>
                            Back</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-neutral" data-toggle="modal"
                            data-target="#staticBackdrop">
                            {!! $user->employed ? "<span class='text-danger'><i class='fa fa-times'></i> Fire</span>" :
                            "<span class='text-primary'><i class='fa fa-plus' s></i> Hire</span>" !!}
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">
                                            {!! $user->employed ? 'Termination' : 'Re-employment' !!}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <span class="text-muted">
                                            {!! $user->employed ? 'Are you sure you wish to terminate ' . $user->name . '?'
                                            : 'Are you sure you wish to re-employ ' . $user->name . '?' !!}
                                        </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <form action="/users/{{ $user->id_card }}/fire" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Proceed</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <span class="description">Job Title</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $user->level }}</span>
                                        <span class="description">Level</span>
                                    </div>
                                    <div>
                                        <span class="heading">{!! number_format($user->salary / 100) !!}</span>
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
                                <h5 class="h3 text-primary mb-0"><i class="ni ni-single-02"></i> Edit {{ $user->name }}'s
                                    Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user) }}">
                            @csrf
                            @method('PUT')
                            <!-- Personal -->
                            <h6 class="heading-small text-muted mb-4">Personal information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Full Name</label>
                                            <input name="name" id="input-address" class="form-control"
                                                placeholder="Full Name" type="text" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-id-card">ID Card Number</label>
                                            <input name="id_card" type="text" id="input-id-card" class="form-control"
                                                placeholder="ID Card Number" value="{{ $user->id_card }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-phone">Phone Number</label>
                                            <input name="phone" type="text" id="input-phone" class="form-control"
                                                placeholder="Phone Number" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-dob">Date of Birth</label>
                                            <input name="birthday" type="date" id="input-dob" class="form-control"
                                                value="{{ $user->birthday }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Personal -->
                            <h6 class="heading-small text-muted mb-4">Employement Details</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Job Title</label>
                                            <input name="title" id="input-address" class="form-control"
                                                placeholder="Job Title" type="text" value="{{ $user->title }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-id-card">Level</label>
                                            <input name="level" type="text" id="input-id-card" class="form-control"
                                                placeholder="Level" value="{{ $user->level }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-phone">Salary</label>
                                            <input name="salary" type="text" id="input-phone" class="form-control"
                                                placeholder="Salary" value="{{ $user->salary }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <div class="pl-lg-4 text-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
