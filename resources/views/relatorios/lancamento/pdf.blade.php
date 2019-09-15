<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Relatório de lançamento</title>
</head>
<body>
<table width="100%" style="width:100%" class="table table-hover">
    <thead>
    <tr>
        <th>ID Item</th>
        <th>Evento</th>
        <th>Dados</th>
        <th>Data ocorrência</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($relatorios as $relatorio)
        <tr>
            <td>{{ $relatorio->classe_id }}</td>
            <td>
                @if ($relatorio->evento === 'created')
                    Criado
                @elseif ($relatorio->evento === 'updated')
                    Atualizado para
                @else
                    Excluído
                @endif
            </td>
            <td>{{ $relatorio->dados }}</td>
            <td>{{ $relatorio->created_at->format('d/m/Y H:i:s') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</body>
</html>
