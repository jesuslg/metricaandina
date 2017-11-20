<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;
$app->get('/', function (Request $request, Response $response) {

	$employees_json = realpath(dirname(__FILE__).'/employees.json');
	$jsondata = file_get_contents($employees_json);
	$jsondata = json_decode($jsondata);

	$html = '<div>';
	$html .= '<form action="buscar" method="post">';
	$html .= '<input type="email" id="" name="email"  required placeholder="Buscar por email">';
	$html .= '<input type="submit" value="buscar">';
	$html .= '</form>';
	$html .= '<table>';
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Name</th>';
	$html .= '<th>email</th>';
	$html .= '<th>Position</th>';
	$html .= '<th>Salary</th>';
	$html .= '<th>Detalles</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
foreach ($jsondata as $key => $data) {
	$data = get_object_vars($data);
	$html .= '<tr>';
	$html .= '<td>'.$data['name'].'</td>';
	$html .= '<td>'.$data['email'].'</td>';
	$html .= '<td>'.$data['position'].'</td>';
	$html .= '<td>'.$data['salary'].'</td>';
	$html .= '<td><a href="detalles/'.$data['id'].'">Detalles aquí</a></td>';
	$html .= '</tr>';
}
	$html .= '</tbody>';
	$html .= '</table>';	
	$html .= '</div>';
 return $html;
});

$app->post('/buscar', function(Request $resuest, Response $response){

	if ($_POST['email']) {
	$employees_json = realpath(dirname(__FILE__).'/employees.json');
	$jsondata = file_get_contents($employees_json);
	$jsondata = json_decode($jsondata);

	$html = '<div>';
	$html .= '<form action="buscar" method="post">';
	$html .= '<input type="email" id="" name="email" required placeholder="Buscar por email">';
	$html .= '<input type="submit" value="buscar">';
	$html .= '</form>';
	$html .= '<table>';
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Name</th>';
	$html .= '<th>email</th>';
	$html .= '<th>Position</th>';
	$html .= '<th>Salary</th>';
	$html .= '<th>Detalles</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
foreach ($jsondata as $key => $data) {
	$data = get_object_vars($data);
	if ($_POST['email'] == $data['email']) {
	$html .= '<tr>';
	$html .= '<td>'.$data['name'].'</td>';
	$html .= '<td>'.$data['email'].'</td>';
	$html .= '<td>'.$data['position'].'</td>';
	$html .= '<td>'.$data['salary'].'</td>';
	$html .= '<td><a href="detalles/'.$data['id'].'">Detalles aquí</a></td>';
	$html .= '</tr>';
	break;
	}else{
		$html .= "<tr><td>Result no found</td></tr>";
	break;
	}
}
	$html .= '</tbody>';
	$html .= '</table>';	
	$html .= '</div>';
	$result = $html;
	}else{
		$result = $response->withRedirect('/metrica_andina/nuevaparte2/');
	}

 return $result;
});

$app->get('/detalles/{id}', function (Request $request, Response $response) {
	$id = $request->getAttribute('id');
	$employees_json = realpath(dirname(__FILE__).'/employees.json');
	$jsondata = file_get_contents($employees_json);
	$jsondata = json_decode($jsondata);

	$html = '<div>';
	$html .= '<h2>Detalles</h2>';
	$html .= '<table border="1" >';
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>name</th>';
	$html .= '<th>email</th>';
	$html .= '<th>phone</th>';
	$html .= '<th>address</th>';
	$html .= '<th>position</th>';
	$html .= '<th>salary</th>';
	$html .= '<th>skills</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
foreach ($jsondata as $key => $data) {
	$data = get_object_vars($data);
	if ($id == $data['id']) {
		$skilles = '<ul>';
		foreach ($data['skills'] as $key => $skill) {
			$skill = get_object_vars($skill);
			$skilles .= '<li>'.$skill['skill'].'</li>';
		}
		$skilles .= '</ul>';
	$html .= '<tr>';
	$html .= '<td>'.$data['name'].'</td>';
	$html .= '<td>'.$data['email'].'</td>';
	$html .= '<td>'.$data['phone'].'</td>';
	$html .= '<td>'.$data['address'].'</td>';
	$html .= '<td>'.$data['position'].'</td>';
	$html .= '<td>'.$data['salary'].'</td>';
	$html .= '<td>'.$skilles.'</td>';
	$html .= '</tr>';
	break;
	}
}
	$html .= '</tbody>';
	$html .= '</table>';	
	$html .= '</div>';
	return $html;

});

$app->get('/search/min/{min}/max/{max}', function (Request $request, Response $response) {
	// setlocale(LC_MONETARY, 'en_US');
	$min = number_format($request->getAttribute('min'));
	$max = number_format($request->getAttribute('max'));

	$employees_json = realpath(dirname(__FILE__).'/employees.json');
	$jsondata = file_get_contents($employees_json);
	$jsondata = json_decode($jsondata);
	$data_total = array();
	foreach ($jsondata as $key => $data) {
		$data = get_object_vars($data);
		$salario = explode('$', $data['salary']);
		$salario = $salario[1];
		if (($salario <= $max) && ($salario >= $min) ) {
			array_push($data_total, $data);
		}
	}
	
	return json_encode($data_total);

  });



$app->run();

