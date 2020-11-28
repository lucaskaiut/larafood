<div class="col">
    <h3>Detalhes do Plano <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a></h3>
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th>Nome</th>
            <th width="150">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($details as $detail)
            <tr>
                <td class="text-left">{{ $detail->name }}</td>
                <td>
                    <a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                    <a href="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $details->links("pagination::bootstrap-4") !!}
</div>

