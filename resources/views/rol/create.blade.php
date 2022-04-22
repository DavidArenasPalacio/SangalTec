@extends('layouts.app')
@section('content')
    <form action="/rol/guardar">
       <div>
           <label for="">Rol</label>
           <input type="text" name="rol" class="form-control @error('rol') is-invalid @enderror">
           @error('rol')
           <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
           </span>
           @enderror
       </div>
       <button type="button" class="button bg-theme-1 text-white mt-5">Login</button>
    </form>
@endsection
