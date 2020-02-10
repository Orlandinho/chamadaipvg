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
            <h1>Adicionar Classe</h1>
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
                <h3 class="card-title">Adicione uma nova classe</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/salas" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputNome">Nome da Classe</label>
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" name="nome" value="{{ old('nome') }}" id="inputNome">
                    @error('nome')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" rows="3" name="descricao">{{ old('descricao') }}</textarea>
                        @error('descricao')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
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

            <!-- Lista das classes criadas -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Todas as classes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <ul class="list-group">
                @forelse($salas as $sala)
                    <li class="list-group-item d-flex align-items-center">{{ $sala->nome }}
                      <form method="POST" role="form" class="ml-auto" action="/salas/{{ $sala->id }}">
                        @method('DELETE')
                        @csrf
                        <a href="/salas/{{ $sala->id }}" class="btn btn-sm btn-secondary mr-1">
                          <i class="fas fa-user-graduate"></i> <span class="">Alunos</span>
                        </a>
                        <a href="/salas/{{ $sala->id }}/edit" class="btn btn-sm btn-primary mr-1">
                          <i class="far fa-edit"></i> <span class="">Editar</span>
                        </a>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Essa ação também irá excluir quaisquer alunos que estejam vinculados a essa classe e todas as informações relacionadas a eles. Deseja prosseguir?');">
                          <i class="fas fa-trash-alt"></i> <span class="">Excluir</span>
                        </button> 
                      </form>
                    </li>
                @empty
                  <p class="mx-auto">Nenhuma classe listada</p>
                @endforelse
              </ul>
          </div>
          <!-- /.lista das classes criadas -->
      </div>
    </section>
  </div>

  @endsection