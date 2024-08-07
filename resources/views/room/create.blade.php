@extends('layouts.app')

@section('title', 'Tambah Ruang/Tempat')

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">@yield('title')</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" id="room-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Room Name</label>
                                    <input name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter room name" value="{{ old('name') }}" />
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input name="location" type="text"
                                        class="form-control @error('location') is-invalid @enderror"
                                        placeholder="Enter location" value="{{ old('location') }}" />
                                    @error('location')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Capacity</label>
                                    <input name="capacity" type="number"
                                        class="form-control @error('capacity') is-invalid @enderror"
                                        placeholder="Enter capacity" value="{{ old('capacity') }}" />
                                    @error('capacity')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Rate</label>
                                    <input name="rate" type="number" min="1" max="5"
                                        class="form-control @error('rate') is-invalid @enderror" placeholder="Enter rate"
                                        value="{{ old('rate') }}" />
                                    @error('rate')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select @error('type') error @enderror" name="type">
                                        <option value="">Type Choice</option>
                                        <option value="Recommended">Recommended</option>
                                        <option value="Popular">Popular</option>
                                    </select>
                                    @error('type')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Facility</label>
                                    <textarea name="facility" id="classic-editor" class="form-control">{{ old('facility') }}</textarea>
                                    @error('facility')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    {{-- <div id="dropzone" class="dropzone"></div> --}}
                                    <input name="image[]" type="file" multiple="multiple"
                                        class="form-control @error('image') is-invalid @enderror" />
                                    @error('image')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let dropzone = new Dropzone("#dropzone", {
                url: "{{ route('rooms.store') }}",
                paramName: "file",
                maxFilesize: 2, // MB
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(file, response) {
                    console.log(response);
                },
                error: function(file, response) {
                    console.log(response);
                }
            });
        });
    </script> --}}
@endsection
