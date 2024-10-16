@extends('layout.main')

@section('content')
    <div class="container">
        {{--  ALERT  --}}
        <div class="row mt-3">
            <div class="col">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                        {{ session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
        {{--  ALERT  --}}
        {{--  CONTENT  --}}
        <div class="row mt-3 mb-5">
            <div class="col">
                <div class="card mt-3 col-sm-6 col-md-12 mb-3">
                    <div class="card-body">
                        {{-- tables --}}
                        <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>File Name</th>
                                    <th>Original Size</th>
                                    <th>Compressed Size</th>
                                    <th>Directory</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historys as $history)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $history->name }}</td>
                                        <td>{{ number_format($history->ori / 1048576, 2) }} MB</td> <!-- Convert to MB -->
                                        <td>{{ number_format($history->comp / 1048576, 2) }} MB</td> <!-- Convert to MB -->
                                        <td>{{ $history->dir }}</td>
                                        <td>{{ $history->User->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--  CONTENT  --}}
    </div>
@endsection
