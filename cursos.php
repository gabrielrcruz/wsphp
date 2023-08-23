<?php
if (isset($_GET['id'])){
    $id = $_GET['id'];
}

header("content-type: application/xml");
//preciso do arq de config da base
require_once "Database.php";

$db = new Database();
$conexao = $db->connect();

//var_dump($conexao);

//comando de consulta SQL 
//$sql = "select * from curso";
$sql = "SELECT curso.id, curso.nome, curso.semestres, professor.nome as coordenador FROM curso, professor where curso.id_coordenador=professor.id";

$stmt = $conexao->query($sql);

$cursos = $stmt->fetchAll(PDO::FETCH_OBJ);

//echo('<pre>');
// var_dump($cursos);


//criação do XML
$dom = new DOMDocument();
$dom->formatOutput = true;

$ifc = $dom->createElement('ifc');
$dom->appendChild($ifc);

foreach($cursos as $c){
    $curso = $dom->createElement('curso');
    $ifc->append($curso);

    $nome = $dom->createElement('nome', $c->nome);
    $curso->appendChild($nome);

    $semestres = $dom->createElement('semestres', $c->semestres);
    $curso->appendChild($semestres);

    $coord = $dom->createElement('coordenador', $c->coordenador);
    $curso->appendChild($coord);
}

$dom->save("arquivo.xml");
echo ($dom->saveXML());


// foreach($cursos as $curso){
//     echo("<nome>".$curso->id. "  ".   $curso->nome."</nome>");
//     echo('<br>');
// }