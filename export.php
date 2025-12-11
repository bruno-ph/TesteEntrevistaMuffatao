<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
$options = new Options();
$options->set('isHtml5ParserEnabled',true);
$dompdf = new Dompdf($options);

include('connect.php');
$sql="SELECT * from produtos";
$result=$conn->query($sql);
$conn->close();

$outputDOM = "
<h1>Lista de Produtos</h1>
    <table style='width: 100%; margin: 0'>
            <tr>
                <th style='border:solid; margin:0; text-align: center'>Nome</th>
                <th style='border:solid; margin:0; text-align: center'>Preço</th>
            </tr>
";
        while ($row = $result->fetch_assoc()):
            
            $outputDOM .= "<tr>";
                $outputDOM .= "<td style='border:solid; margin:0; text-align: center'>" . htmlspecialchars($row['nome']) ; "</td>";
                $outputDOM .= "<td style='border:solid; margin:0; text-align: center'>" . htmlspecialchars($row['preco']) ; "</td>";
            $outputDOM .= "<tr>";
        endwhile;
        if ($result->num_rows == 0):
            $outputDOM .= "<p>Não há produtos cadastrados</p>";
        endif;
    $outputDOM.= "</table>";


$dompdf->loadHtml($outputDOM);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream('lista.pdf')
?>