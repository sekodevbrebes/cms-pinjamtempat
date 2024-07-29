@extends('layouts.app')

@section('title', 'Data Tempat/Ruangan')

@section('contents')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="border rounded p-3">
                                <h6 class="mb-1">From:</h6>
                                <h5>{{ $agenda->user->instansi }}</h5>
                                <p class="mb-0">{{ $agenda->user->name }}</p>
                                <p class="mb-0">{{ $agenda->user->telephone }}</p>
                                <p class="mb-0">
                                <div class="__cf_email__" data-cfemail="a5c7d7c4cbc1cacb9592e5d5ccc0d7c6c08bc6cac8">
                                    {{ $agenda->user->email }}</div>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="border rounded p-3">
                                <h6 class="mb-1">Status : </h6>
                                <h5>
                                    <span
                                        class="badge 
                                        @if ($agenda->status == 'Pending') bg-light-warning 
                                        @elseif($agenda->status == 'Accept') bg-light-primary
                                        @elseif($agenda->status == 'Decline') bg-light-dark
                                        @elseif($agenda->status == 'Cancelled') bg-light-danger @endif">
                                        {{ $agenda->status }}
                                    </span>
                                </h5>

                                @if ($agenda->status == 'Cancelled' || $agenda->status == 'Decline')
                                    <p class="mb-0">Alasan : <br /> {{ $agenda->reason }}</p>
                                @endif
                            </div>
                        </div>




                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>ROOM</th>
                                            <th>DATE</th>
                                            <th>TIME</th>
                                            <th>PESERTA</th>
                                            <th>ACTIVITY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $agenda->room->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($agenda->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                            <td>{{ $agenda->waktu_mulai }} - {{ $agenda->waktu_selesai }}</td>
                                            <td>300</td>
                                            <td>{{ $agenda->activities }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-start">
                                <hr class="mb-2 mt-1 border-secondary border-opacity-50" />
                            </div>
                        </div>

                        @if ($agenda->status == 'Decline' || $agenda->status == 'Cancelled')
                            <div class="col-12">
                                <div class="border rounded p-3">

                                    <form method="POST" action="{{ route('agenda.updateReason', $agenda->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="reason" class="form-label">Reason</label>
                                            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        <div class="col-12 text-end">
                            Change :
                            <a href="{{ route('agenda.changeStatus', ['id' => $agenda->id, 'status' => 'Accept']) }}"
                                class="btn btn-outline-primary btn-print-invoice btn-sm @if ($agenda->status == 'Accept') disabled @endif">
                                <span class="">Accept</span>
                            </a>

                            <a href="{{ route('agenda.changeStatus', ['id' => $agenda->id, 'status' => 'Decline']) }}"
                                class="btn btn-outline-dark btn-print-invoice btn-sm @if ($agenda->status == 'Decline') disabled @endif">
                                Decline
                            </a>

                            <a href="{{ route('agenda.changeStatus', ['id' => $agenda->id, 'status' => 'Cancelled']) }}"
                                class="btn btn-outline-danger btn-print-invoice btn-sm @if ($agenda->status == 'Cancelled') disabled @endif">
                                Cancelled
                            </a>

                            <a href="{{ route('agenda.changeStatus', ['id' => $agenda->id, 'status' => 'Pending']) }}"
                                class="btn btn-outline-warning btn-print-invoice btn-sm @if ($agenda->status == 'Pending') disabled @endif">
                                Pending
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
