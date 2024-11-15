@extends('layouts.app')

@section('title','Editar categoría')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Categoría</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categorias.index')}}">Categorías</a></li>
        <li class="breadcrumb-item active">Editar categoría</li>
    </ol>

    <div class="card text-bg-light">
        <form action="{{ route('categorias.update',['categoria'=>$categoria]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card-body">
                <div class="row g-4">

                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" oninput="this.value = this.value.toUpperCase();" pattern="[A-Za-z\s]+" required value="{{old('nombre',$categoria->caracteristica->nombre)}}">
                        @error('nombre')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" required class="form-control">{{old('descripcion',$categoria->caracteristica->descripcion)}}</textarea>
                        @error('descripcion')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="reset" class="btn btn-secondary">Reiniciar</button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nombreInput = document.getElementById("nombre");
        const descripcionInput = document.getElementById("descripcion");
        const nombreError = document.createElement("small");
        const descripcionError = document.createElement("small");
        nombreError.classList.add("text-danger");
        descripcionError.classList.add("text-danger");

        // Validar campo de nombre
        nombreInput.addEventListener("input", function() {
            const regex = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/;
            if (!regex.test(nombreInput.value) || nombreInput.value.length > 30) {
                nombreError.textContent = "El nombre solo debe contener letras y un máximo de 30 caracteres.";
                nombreInput.classList.add("is-invalid");
                nombreInput.parentNode.appendChild(nombreError);
            } else {
                nombreInput.classList.remove("is-invalid");
                nombreError.textContent = "";
            }
        });

        // Validar campo de descripción
        descripcionInput.addEventListener("input", function() {
            if (descripcionInput.value.length > 80) {
                descripcionError.textContent = "La descripción no debe exceder los 80 caracteres.";
                descripcionInput.classList.add("is-invalid");
                descripcionInput.parentNode.appendChild(descripcionError);
            } else {
                descripcionInput.classList.remove("is-invalid");
                descripcionError.textContent = "";
            }
        });
    });
</script>

@endpush
