<?
include "../../gy/gy.php"; // подключить ядро // include core

$result = array(
	'stat' => 'err'
);

$data = $_REQUEST;

global $user;

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel') && !empty($data['action'])){
	// действие удалить пользователя
	if (($data['action'] == 'user-del') && !empty($data['id-user'])  ) {
				
		$res = $user->deleteUserById($data['id-user']);
		if ($res){
			$result['stat'] = 'ok';
		}
	}
}

echo json_encode($result);

?>