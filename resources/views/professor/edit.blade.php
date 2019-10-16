@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Editar
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('professores.update', ['professor' => $professor->id]) }}"
                        method="POST" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">
                                Nome
                            </label>
                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome', $professor->nome) }}" required autofocus>
                                @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nome" class="col-md-4 col-form-label text-md-right">
                                Status
                            </label>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="radio1" name="radioStatus"
                                        class="custom-control-input" value="1"
                                        {{ $professor->ativo ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="radio1">
                                        Ativo
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="radio2" name="radioStatus"
                                        class="custom-control-input" value="0"
                                        {{ !$professor->ativo ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="radio2">
                                        Inativo
                                    </label>
                                </div>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Gravar
                                </button>
                                <button id="button-excluir" type="button" class="btn btn-danger" onclick="clickButtonExcluir()">
                                    Excluir
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
function clickButtonExcluir() {
    Swal.fire({
      title: 'Tem certeza que deseja excluir?',
      text: 'Essa ação não poderá ser revertida',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, excluir',
      cancelButtonText: 'Cancelar'
    }).then(function (result) {
      if (result.value) {
        axios({
            method: 'delete',
            url: '{{ route('professores.destroy', ['professor' => $professor->id]) }}'
        }).then(function (response) {
            Swal.fire(
                'Excluído!',
                'O professor foi excluído.',
                'success'
            ).then(function (result) {
                window.location.href = '{{ route('professores.index') }}';
            });
        });
      }
    });
}
</script>
@endsection
