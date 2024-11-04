<?php
// Define uma classe chamada FileEditor para manipular um arquivo de usuários
class FileEditor {
    // Propriedade privada para armazenar o recurso do arquivo aberto
    private $file;
    // Nome do arquivo de texto onde os dados dos usuários serão armazenados
    private $filename = "usuarios.txt";

    // Método para abrir o arquivo com o modo de acesso especificado
    public function openFile($mode) {
        // Abre o arquivo especificado na propriedade $filename com o modo fornecido ($mode)
        $this->file = fopen($this->filename, $mode);
        // Verifica se a abertura do arquivo foi bem-sucedida; se não, lança uma exceção
        if (!$this->file) {
            throw new Exception("Erro ao abrir o arquivo.");
        }
    }

    // Método para escrever dados de um usuário no arquivo
    public function writeUser($data) {
        // Chama o método openFile para abrir o arquivo no modo de "append" (a), que permite adicionar dados ao final
        $this->openFile("a");
        // Escreve os dados do usuário no arquivo, transformando o array $data em uma string separada por vírgulas e adicionando uma nova linha
        fwrite($this->file, implode(",", $data) . PHP_EOL);
        // Fecha o arquivo após a escrita, chamando o método closeFile
        $this->closeFile();
    }

    // Método para ler todos os usuários do arquivo
    public function readUsers() {
        // Chama o método openFile para abrir o arquivo no modo de leitura ("r")
        $this->openFile("r");
        // Cria um array vazio para armazenar o conteúdo do arquivo
        $content = [];
        // Lê o arquivo linha por linha até o final (feof indica o final do arquivo)
        while (!feof($this->file)) {
            // Obtém uma linha do arquivo
            $line = fgets($this->file);
            // Verifica se a linha contém dados (não é nula ou vazia)
            if ($line) {
                // Remove espaços em branco das extremidades e separa a linha em elementos de um array, adicionando-o ao array $content
                $content[] = explode(",", trim($line));
            }
        }
        // Fecha o arquivo após a leitura, chamando o método closeFile
        $this->closeFile();
        // Retorna o conteúdo lido, agora armazenado no array $content
        return $content;
    }

    // Método para fechar o arquivo
    public function closeFile() {
        // Fecha o recurso do arquivo para liberar a memória e garantir que o arquivo não permaneça aberto
        fclose($this->file);
    }
}