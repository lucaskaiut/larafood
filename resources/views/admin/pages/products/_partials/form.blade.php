@include('admin.includes.alerts')
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $product->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Descrição</label>
    <input name="description" class="form-control" placeholder="Descrição" value="{{ $product->description ?? old('description') }}">
</div>
<div class="form-group">
    <label>Preço</label>
    <input name="price" class="form-control" placeholder="Preço" value="{{ $product->price ?? old('price') }}">
</div>
<div class="form-group float-right">
    <button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i></button>
</div>
