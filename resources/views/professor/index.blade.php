@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Professores
                  <a href="{{ route('professores.create') }}"
                    class="btn btn-success btn-sm float-right">
                    Novo
                  </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                      <table class="table table-striped table-hovered table-sm">
                          <thead>
                              <tr>
                                  <th>
                                    Nome
                                  </th>
                                  <th>
                                    Status
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                              @if ($professores->count() < 1)
                              <tr>
                                <td colspan="2">
                                  Nenhum registro encontrado
                                </td>
                              </tr>
                              @endif
                              @foreach ($professores as $professor)
                              <tr>
                                  <td>
                                      <a href="{{ route('professores.edit', ['professor' => $professor->id]) }}">
                                        {{ $professor->nome }}
                                      </a>
                                  </td>
                                  <td>
                                      {{ $professor->ativo ? 'Ativo' : 'Inativo' }}
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
