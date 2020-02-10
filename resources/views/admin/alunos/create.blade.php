@extends('admin.layout')

@section('title', 'IPVG Admin')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="mx-auto">
            <h1>Adicionar Aluno</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 mx-auto">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/alunos" id="myForm" method="POST" enctype="">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputNome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="inputNome">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Selecionar Foto</label>
                    <small class="form-text text-muted">Foto não obrigatória. Somente arquivos com a extensão .jpg/.jpeg ou .png</small>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="avatar" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile"></label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <label>Selecione a classe</label>
                    <select name="sala_id" class="form-control">
                      <option> -- </option>
                      @forelse($salas as $sala)
                      <option value="{{ $sala->id }}">{{ $sala->nome }}</option>
                      @empty
                      <option>Nenhuma sala criada</option>
                      @endforelse
                    </select>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="visitante" value=1 class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Visitante</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer float-right">
                  <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection