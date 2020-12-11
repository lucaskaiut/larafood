<div class="col">
    <h3>Cargos do Usuário <a href="{{ route('users.roles.available', $user->id) }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a></h3>
    <table class="table table-bordered col-md-9">
        <thead class="thead-light">
        <tr>
            <th width="50"><input type="checkbox" id="checkAll"></th>
            <th>Nome</th>
            <th>Descrição</th>
        </tr>
        </thead>
        <tbody>
        <form action="{{ route('users.roles.detach', $user->id) }}" method="post">
            @csrf
            @foreach($roles as $role)
                <tr>
                    <td class="text-left">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                    </td>
                    <td class="text-left">{{ $role->name }}</td>
                    <td class="text-left">{{ $role->description }}</td>
                </tr>
            @endforeach
            <td colspan="500">
                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
            </td>
        </form>
        </tbody>
    </table>
    {!! $roles->links("pagination::bootstrap-4") !!}
    <script src="{{ asset('/vendor/jquery/jquery.min.js')}} "></script>
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
</div>
