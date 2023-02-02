<?php

session_start();
require "Request.php";

$request = new Request();

switch ($_REQUEST["operador"]) {

    case "listUsers":
        $data = $request->listUsers();

        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $list[] = array(
                    "nombre" => $data[$i]['name'],
                    "apellidos" => $data[$i]['lastname'],
                    "username" => $data[$i]['username'],
                    "rol" => $data[$i]['rol'],
                    "editar" => editUserButton($data[$i]['idusuario']),
                    "pass" => changePassButton($data[$i]['idusuario']),
                    "eliminar" => deleteUserButton($data[$i]['idusuario']),
                );
            }

            $result = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        } else {
            $list[] = array(
                "nombre" => 'No hay usuarios disponibles',
                "apellidos" => '',
                "username" => '',
                "rol" => '',
                "editar" => '',
                "pass" => '',
                "eliminar" => '',
            );

            $result = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        }

        break;

    case 'registerUser':
        if (isset($_POST['inputNombre'],$_POST['inputApellido'],$_POST['inputUserName'],$_POST['inputRol'],$_POST['inputPass1'],$_POST['inputPass2']) &&
            !empty($_POST['inputNombre']) &&  
            !empty($_POST['inputApellido']) &&  
            !empty($_POST['inputUserName']) &&  
            $_POST['inputRol'] != 'Elige un rol' &&  
            !empty($_POST['inputPass1']) &&  
            !empty($_POST['inputPass2'])
        ) {
            if ($_POST['inputPass1'] == $_POST['inputPass2']) {
                if ($request->registerUser($_POST['inputNombre'],$_POST['inputApellido'],$_POST['inputUserName'],$_POST['inputRol'],$request->encryption($_POST['inputPass1']))) {
                    $response = 'success';                    
                } else {
                    $response = 'error';
                }
                                
            } else {
                $response = 'nosamepass';
            }
                        
        } else {
            $response = 'requerid';
        }
        
        echo $response;
        break;

    case 'getUser':
        if (!empty($request->getUser($_POST['id']))) {
            echo json_encode($request->getUser($_POST['id']));
        } else {
            echo json_encode('empty');  
        }
        
        break;
    
    case 'editUser':
        if (isset($_POST['id'], $_POST['inputNombre'],$_POST['inputApellido'],$_POST['inputUserName'],$_POST['inputRol']) &&
            !empty($_POST['id']) &&  
            !empty($_POST['inputNombre']) &&  
            !empty($_POST['inputApellido']) &&  
            !empty($_POST['inputUserName']) &&  
            !empty($_POST['inputRol'])                    
        ) {
            if ($request->editUser($_POST['id'],$_POST['inputNombre'],$_POST['inputApellido'],$_POST['inputUserName'],$_POST['inputRol'])) {
                $response = 'success';               
            } else {
                $response = 'error';
            }
                        
        } else {
            $response = 'requerid';
        }
        
        echo $response;        
        break;

    case 'changePassUser':
        if (isset($_POST['id'], $_POST['inputPass1'], $_POST['inputPass2']) &&
            !empty($_POST['id']) &&
            !empty($_POST['inputPass1']) &&
            !empty($_POST['inputPass2'])
        ) {
            if ($_POST['inputPass1'] == $_POST['inputPass2']) {
                if ($request->isOldPass($_POST['id'],$request->encryption($_POST['inputPass1']))) {
                    $response = 'oldpass';
                } else {
                    if ($request->changePassUser($_POST['id'],$request->encryption($_POST['inputPass1']))) {
                        $response = 'success';
                    } else {
                        $response = 'error';
                    }
                                        
                }                
            } else {
                $response = 'nosamepass';
            }
            
            
        } else {
            $response = 'requerid';
        }

        echo $response;
        
        break;
    
    case 'deleteUser':
        if ($request->deleteUser($_POST['id'])) {
            $response = 'success';
        } else {
            $response = 'error';
        }
        
        echo $response;
        break;
}

function editUserButton($id)
{
    return "<input type='image' src='pictures/editar.png' alt='Submit' title='Editar' width='30' height='30' onclick='formEditUser(" . $id . ")'>";
}

function changePassButton($id)
{
    return "<input type='image' src='pictures/pass.png' alt='Submit' title='Cambiar contraseña' width='30' height='30' onclick='formChangeUser(" . $id . ")'>";
}

function deleteUserButton($id)
{
    return "<input type='image' src='pictures/eliminar.png' alt='Submit' title='Eliminar usuario' width='30' height='30' onclick='askDeleteUser(" . $id . ")'>";
}
