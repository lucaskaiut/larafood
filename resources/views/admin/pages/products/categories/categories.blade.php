<div class="col">
    <h3>Categorias <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a></h3>
    <table class="table table-bordered col-md-9">
        <thead class="thead-light">
        <tr>
            <th width="50"><input type="checkbox" id="checkAll"></th>
            <th>Nome</th>
            <th>Descrição</th>
        </tr>
        </thead>
        <tbody>
        <form action="{{ route('products.categories.detach', $product->id) }}" method="post">
            @csrf
            @foreach($categories as $category)
                <tr>
                    <td class="text-left">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                    </td>
                    <td class="text-left">{{ $category->name }}</td>
                    <td class="text-left">{{ $category->description }}</td>
                </tr>
            @endforeach
            <td colspan="500">
                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
            </td>
        </form>
        </tbody>
    </table>
    {!! $categories->links("pagination::bootstrap-4") !!}
    <script src="{{ asset('/vendor/jquery/jquery.min.js')}} "></script>
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
</div>
