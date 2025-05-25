@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Pièces jointes</h4>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('dossiers.index') }}">
                        <i class="fas fa-undo-alt"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if ($files->isNotEmpty())
                        <div class="col-sm-12 mb-2">
                            <h5>Fichiers existants :</h5>
                            <div id="file-list" class="row">
                                @foreach ($files as $file)
                                    <div class="col-md-3 mb-3 file-item" data-id="{{ $file->id }}">
                                        <div class="card">
                                            <embed src="{{ asset('uploads/' . $file->file_path) }}" height="400px"
                                                width="100%"></embed>
                                            <div class="card-body text-right">
                                                <form action="{{ route('delete-file', $file->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Vous êtes sur ?')"
                                                        class="btn btn-outline-danger btn-sm">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="col-sm-12 mb-2">
                            <p>Aucun fichiers</p>
                        </div>
                    @endif

                    <div class="col-sm-12">
                        <h5>Nouveaux fichiers :</h5>
                        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_dossier" value="{{ $dossier->id }}">
                            <input type="file" name="files[]" multiple>
                            <button type="submit" class="btn btn-success">Charger</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById('file-list');
        var sortable = Sortable.create(el, {
            animation: 150,
            onEnd: function(evt) {
                var order = [];
                document.querySelectorAll('.file-item').forEach(function(item) {
                    order.push(item.getAttribute('data-id'));
                });

                // Send the order array to the server
                fetch('{{ route('update-file-order') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            order: order
                        })
                    }).then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // Handle success response
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });
</script>
