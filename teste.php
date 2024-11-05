<?php
// Inclui os arquivos que contêm as classes FileEditor, CSVReport e PDFReport, necessários para o funcionamento do código
require 'FileEditor.php';
require 'CSVReport.php';
require 'PDFReport.php';

// Cria uma nova instância da classe FileEditor, que será usada para manipular o arquivo de usuários
$editor = new FileEditor();

// Adiciona um novo usuário ao arquivo, chamando o método writeUser da classe FileEditor com um array que representa o usuário
// Este método cria o arquivo "usuarios.txt" caso ele ainda não exista, ou adiciona os dados ao final do arquivo, caso ele já exista
$editor->writeUser(['1', 'Danilo Melo Silva', 'danilo@email.com']);
$editor->writeUser(['2', 'Carla Costa Azevedo', 'carla@email.com']);
$editor->writeUser(['3', 'Vinicius Ribeiro Castro', 'vinicius@email.com']);
$editor->writeUser(['4', 'Leila Pinto Araujo', 'leila@email.com']);

// Lê todos os usuários do arquivo usando o método readUsers da classe FileEditor e armazena-os na variável $usuarios
$usuarios = $editor->readUsers();
// Exibe o conteúdo do array $usuarios, que contém todos os usuários lidos do arquivo
print_r($usuarios);

// Cria uma nova instância da classe CSVReport, que será usada para gerar o relatório em formato CSV
$csvReport = new CSVReport();
// Chama o método createCSV da classe CSVReport para criar um arquivo CSV chamado "relatorio.csv" com os dados dos usuários e os cabeçalhos especificados
$csvReport->createCSV("relatorio.csv", $usuarios, ["ID", "Nome", "Email"]);

// Cria uma nova instância da classe PDFReport, que será usada para gerar o relatório em formato PDF
$pdfReport = new PDFReport();
// Chama o método generate da classe PDFReport para criar um arquivo PDF chamado "relatorio.pdf" com os dados dos usuários
$pdfReport->generate("relatorio.pdf", $usuarios);