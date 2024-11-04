<?php
// Define uma classe chamada CSVReport para criar e manipular arquivos CSV
class CSVReport {
    // Propriedade privada para armazenar o recurso do arquivo aberto
    private $file;

    // Método para criar um arquivo CSV com um nome especificado, dados e cabeçalhos opcionais
    public function createCSV($filename, $data, $headers = null) {
        // Abre o arquivo especificado em modo de escrita ("w" - write), que cria um novo arquivo ou sobrescreve um existente
        $this->file = fopen($filename, 'w'); 
        // Verifica se a abertura do arquivo foi bem-sucedida; se não, lança uma exceção
        if (!$this->file) {
            throw new Exception("Erro ao criar o arquivo CSV.");
        }

        // Verifica se cabeçalhos foram fornecidos (não são nulos)
        if ($headers) { 
            // Escreve os cabeçalhos no arquivo CSV usando fputcsv, que converte um array em uma linha formatada como CSV
            fputcsv($this->file, $headers); 
        }

        // Itera sobre o array de dados, onde cada elemento representa uma linha de dados no CSV
        foreach ($data as $row) { 
            // Escreve cada linha de dados no arquivo CSV, formatando-a como uma linha separada por vírgulas
            fputcsv($this->file, $row); 
        }

        // Fecha o arquivo CSV para liberar o recurso e garantir que os dados sejam salvos corretamente
        fclose($this->file);
    }
}