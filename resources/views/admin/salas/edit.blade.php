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
            <h1>Editar Classe</h1>
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
                <h3 class="card-title">Editar classe</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/salas/{{ $sala->id }}" method="POST">
                @method('PUT')
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputNome">Nome da Classe</label>
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" name="nome" value="{{ $sala->nome }}" id="inputNome">
                    @error('nome')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" rows="3" name="descricao">{{ $sala->descricao }}</textarea>
                        @error('descricao')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer float-right">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
      </div>
    </section>
  </div>

  @endsection