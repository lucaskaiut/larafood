<div class="col">
    <h3>Permissões do Perfil <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a></h3>
    <table class="table table-bordered col-md-9">
        <thead class="thead-light">
        <tr>
            <th width="50"><input type="checkbox" id="checkAll"></th>
            <th>Nome</th>
            <th>Descrição</th>
        </tr>
        </thead>
        <tbody>
        <form action="{{ route('profiles.permissions.detach', $profile->id) }}" method="post">
            @csrf
            @foreach($permissions as $permission)
                <tr>
                    <td class="text-left">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                    </td>
                    <td class="text-left">{{ $permission->name }}</td>
                    <td class="text-left">{{ $permission->description }}</td>
                </tr>
            @endforeach
            <td colspan="500">
                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
            </td>
        </form>
        </tbody>
    </table>
    {!! $permissions->links("pagination::bootstrap-4") !!}
    <script src="{{ asset('/vendor/jquery/jquery.min.js')}} "></script>
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
</div>
