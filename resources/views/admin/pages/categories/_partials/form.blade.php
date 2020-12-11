@include('admin.includes.alerts')
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $category->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Descrição</label>
    <textarea name="description" class="form-control" cols="30" rows="5">{{ $category->description ?? old('description') }}</textarea>
</div>
<div class="form-group float-right">
    <button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i></button>
</div>
