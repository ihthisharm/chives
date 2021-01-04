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
                                <li class="breadcrumb-item"><a href="/attendances">Attendance</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ date('d F Y', strtotime($attendance->date)) }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-neutral">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <a href="#" data-target="#delete-attendance" data-toggle="modal"
                            class="btn btn-sm btn-neutral text-danger">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </div>
                    @include('attendances.delete-attendance')
                </div>
                {{-- @include('partials.dashboard-stats') --}}
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                @include('partials.calendar')
            </div>
            <div class="col-xl-8 order-xl-1" id="printable">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Human Resource Management</h6>
                                <h5 class="h3 text-primary mb-0">
                                    <i class="ni ni-money-coins"></i>
                                    Attendance of {{ date('d F Y', strtotime($attendance->date)) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="name">Attendance Status</th>
                                    <th scope="col" class="sort" data-sort="name">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if ($attendances)
                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <th scope="row">
                                                <a href="{{ route('users.show', $attendance->user->id_card) }}">
                                                    <div class="media align-items-center">
                                                        <div class="avatar rounded-circle bg-default mr-3">
                                                            <img alt="{{ $attendance->user->name }}"
                                                                src="{{ $attendance->user->image }}">
                                                        </div>
                                                        <div class="media-body">
                                                            <span
                                                                class="name mb-0 text-sm d-block">{{ $attendance->user->name }}</span>
                                                            <small class="text-muted">
                                                                {{ $attendance->user->title }}
                                                                {{ $attendance->user->level ? 'Level ' . $attendance->user->level : '' }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </th>
                                            <td>
                                                <span class="badge badge-dot mr-4">
                                                    <i class="{{ $attendance->LED }}"></i>
                                                    <span class="status">{{ $attendance->status }}</span>
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#edit-attendance-{{ $attendance->id }}">Edit</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('attendances.edit-attendance')
                                    @endforeach
                                @else
                                    <tr colspan="3">
                                        <td></td>
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
