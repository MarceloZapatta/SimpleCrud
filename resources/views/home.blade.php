@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Início</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-deck mb-3 text-center">
                        <div class="card mb-4 shadow-sm">
                          <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Professores</h4>
                          </div>
                          <div class="card-body">
                            <a href="/professores" class="btn btn-lg btn-block btn-outline-primary">
                                Acessar
                            </a>
                          </div>
                        </div>
                        <div class="card mb-4 shadow-sm">
                          <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Alunos</h4>
                          </div>
                          <div class="card-body">
                            <a href="/alunos" class="btn btn-lg btn-block btn-outline-primary">
                                Acessar
                            </a>
                          </div>
                        </div>
                    </div>
                    <div class="card-deck mb-3 text-center">
                        <div class="card mb-4 shadow-sm">
                          <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Turmas</h4>
                          </div>
                          <div class="card-body">
                            <button href="/turmas" class="btn btn-lg btn-block btn-outline-primary">
                                Acessar
                            </button>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
