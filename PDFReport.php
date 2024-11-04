<?php
// Inclui a biblioteca FPDF para gerar arquivos PDF
require 'fpdf/fpdf.php';

// Define uma classe chamada PDFReport que estende a classe FPDF, permitindo criar relatórios PDF personalizados
class PDFReport extends FPDF {

    // Função para definir o cabeçalho do documento PDF
    function Header() {
        // Define a fonte para Arial, em negrito, tamanho 12, para o título
        $this->SetFont('Arial', 'B', 12); 
        // Cria uma célula (retângulo) que abrange a largura da página (0) com 10 de altura, contendo o título "Relatório de Usuários" centralizado (alinhamento 'C')
        $this->Cell(0, 10, 'Relatório de Usuários', 0, 1, 'C'); 
        // Define a fonte para Arial, normal, tamanho 10, para a data
        $this->SetFont('Arial', '', 10); 
        // Adiciona outra célula para exibir a data atual, também centralizada na página
        $this->Cell(0, 10, 'Data: ' . date('d/m/Y'), 0, 1, 'C'); 
        // Adiciona uma linha em branco (10 de altura) para separar o cabeçalho do conteúdo
        $this->Ln(10); 
    }

    // Função para adicionar uma linha (linha de dados) no relatório PDF
    function addRow($data) {
        // Define a fonte para Arial, normal, tamanho 10, para as linhas de dados
        $this->SetFont('Arial', '', 10);
        // Percorre cada coluna de dados na linha
        foreach ($data as $col) {
            // Cria uma célula para cada coluna com largura de 40, altura de 10, com uma borda e contendo o dado da coluna
            $this->Cell(40, 10, $col, 1);
        }
        // Move o cursor para a próxima linha após adicionar todas as colunas
        $this->Ln();
    }

    // Função para gerar o arquivo PDF com o nome e os dados fornecidos
    function generate($filename, $data) {
        // Adiciona uma nova página ao documento PDF
        $this->AddPage();
        // Percorre cada linha de dados e chama a função addRow para adicioná-la ao PDF
        foreach ($data as $row) {
            $this->addRow($row);
        }
        // Salva o PDF gerado com o nome especificado no parâmetro $filename, usando o modo 'F' (salvar no sistema de arquivos)
        $this->Output('F', $filename);
    }
}