<!DOCTYPE html> 
<html lang="pt-br"> 
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>Histórico</title>     
    <style>         
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .table-container {
            margin: 0 20px;
        }
        .title {
            text-align: center;
            font-size: 2em;
            margin-top: 20px;
        }
        .logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100px;
        }
        .clickable {
            color: black;
            cursor: pointer;
            text-decoration: none;
        }
        .highlighted {
            background-color: yellow !important;
            transition: background-color 1s ease;
        }
    </style>
    <script>
        function highlightRow(id) {
            let row = document.getElementById(id);
            if (row) {
                row.classList.add("highlighted");
                setTimeout(() => {
                    row.classList.remove("highlighted");
                }, 3000);
            }
        }
    </script>
</head> 
<body>     
    <div class="table-container">         
        <h1 class="title">Histórico de Contribuições</h1>                  
        <h2>Contribuições</h2>         
        <table>             
            <thead>                 
                <tr>                     
                    <th>ID</th>                     
                    <th>Tipo</th>                     
                    <th>Valor</th>                     
                    <th>Data Início</th>                     
                    <th>Data Fim</th>                     
                    <th>Status</th>                     
                    <th>Contribuidor - Nome</th>                     
                    <th>Contribuidor - Email</th>                     
                    <th>Contribuidor - Telefone</th>                 
                </tr>             
            </thead>             
            <tbody>                 
                @foreach(collect($data)->unique('contribuicao.id') as $history)                     
                <tr id="contribuicao-{{ $history->contribuicao->id }}">                         
                    <td>{{ $history->contribuicao->id }}</td>                         
                    <td>{{ $history->contribuicao->tipo }}</td>                         
                    <td>R$ {{ number_format($history->contribuicao->valor, 2, ',', '.') }}</td>                         
                    <td>{{ \Carbon\Carbon::parse($history->contribuicao->data_inicio)->format('d/m/Y') }}</td>                         
                    <td>{{ \Carbon\Carbon::parse($history->contribuicao->data_fim)->format('d/m/Y') }}</td>                         
                    <td>{{ $history->contribuicao->status }}</td>                         
                    <td>{{ $history->contribuicao->contribuidor->nome }}</td>                         
                    <td>{{ $history->contribuicao->contribuidor->email }}</td>                         
                    <td>{{ $history->contribuicao->contribuidor->telefone }}</td>                     
                </tr>                 
                @endforeach             
            </tbody>         
        </table>                  
        <h2>Histórico de Pagamentos</h2>         
        <table>             
            <thead>                 
                <tr>                     
                    <th>Contribuição</th>                     
                    <th>Valor pago</th>                     
                    <th>Data de pagamento</th>                 
                </tr>             
            </thead>             
            <tbody>                 
                @foreach($data as $history)                     
                <tr>                         
                    <td><a href="#contribuicao-{{ $history->contribuicao->id }}" class="clickable" onclick="highlightRow('contribuicao-{{ $history->contribuicao->id }}')">{{ $history->contribuicao->id }}</a></td>                         
                    <td>R$ {{ number_format($history->historico->valor, 2, ',', '.') }}</td>                         
                    <td>{{ \Carbon\Carbon::parse($history->historico->data)->format('d/m/Y') }}</td>                     
                </tr>                 
                @endforeach             
            </tbody>         
        </table>     
    </div> 
</body> 
</html>
