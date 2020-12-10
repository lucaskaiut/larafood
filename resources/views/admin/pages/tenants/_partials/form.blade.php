@include('admin.includes.alerts')
<div class="form-group float-right">
    <button type="submit" class="btn btn-outline-success"><i class="far fa-save"></i></button>
</div>
<div class="form-group">
    <label>Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $tenant->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>CNPJ</label>
    <input type="text" name="cnpj" class="form-control" placeholder="CNPJ" value="{{ $tenant->cnpj ?? old('cnpj') }}">
</div>
<div class="form-group">
    <label>E-Mail</label>
    <input type="email" name="email" class="form-control" placeholder="E-Mail" value="{{ $tenant->email ?? old('email') }}">
</div>
<div class="form-group">
    <label>Plano</label>
    <select name="subscription_suspended" class="form-control">
        @foreach($plans as $plan)
            <option value="{{ $plan->id }}" @if($tenant->plan->id == $plan->id) selected="selected" @endif>{{ $plan->name }} - R${{ number_format($plan->price, 2, ',', '.') }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Ativo</label>
    <select name="subscription_active" class="form-control">
        <option value="0">Não</option>
        <option value="1" @if(isset($tenant->subscription_active) && $tenant->subscription_active) selected="selected" @endif>Sim</option>
    </select>
</div>
<div class="form-group">
    <label>Inscrição Cancelada</label>
    <select name="subscription_suspended" class="form-control">
        <option value="0">Não</option>
        <option value="1" @if(isset($tenant->subscription_suspended) && $tenant->subscription_suspended) selected="selected" @endif>Sim</option>
    </select>
</div>
<div class="form-group">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control-file">
</div>
@if(isset($tenant->logo))
    <img src="{{ asset('storage/' . $tenant->logo) }}" width="600px">
@endif
