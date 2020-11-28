@include('admin.includes.alerts')
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $detail->name ?? old('name') }}">
</div>
<div class="form-group float-right">
    <button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i></button>
</div>
