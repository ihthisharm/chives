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
                                <li class="breadcrumb-item active" aria-current="page">Staff</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="/users/create" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Hire</a>
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
                                <h5 class="h3 text-primary mb-0"><i class="ni ni-single-02"></i> Staff Information</h5>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="name">Job Title</th>
                                    <th scope="col" class="sort" data-sort="budget">Contact</th>
                                    <th scope="col" class="sort" data-sort="status">Employed Since</th>
                                    <th scope="col" class="sort" data-sort="status">Salary</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($users))
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <a href="{{ route('users.show', $user->id_card) }}"
                                                        class="avatar rounded-circle bg-default mr-3">
                                                        <img alt="{{ $user->name }}" src="{{ $user->image }}">
                                                    </a>
                                                    <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{ $user->name }}</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                {{ $user->title }} {{ $user->level ? 'Level ' . $user->level : '' }}
                                            </td>
                                            <td>
                                                {{ $user->phone }}
                                            </td>
                                            <td>
                                                {!! $user->employed
                                                ? $user->created_at->diffForHumans()
                                                : "<span class='text-danger'>Terminated</span>" !!}
                                            </td>
                                            <td class="budget">
                                                MVR {!! number_format($user->salary/100, 2) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else

                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 d-flex justify-content-end">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
