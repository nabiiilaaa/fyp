<?php

//fetch_user.php

include('database_connection.php');

session_start();

$query = "
SELECT DISTINCT *
FROM (SELECT CASE WHEN FromUser.Id = '".$_SESSION['UserId']."' THEN ToUser.Id ELSE FromUser.Id END AS UserId, CASE WHEN FromUser.Id = '".$_SESSION['UserId']."' THEN ToUser.UserName ELSE FromUser.UserName END AS UserName 
FROM chat_message JOIN users as FromUser ON chat_message.from_user_id = FromUser.Id JOIN users AS ToUser ON chat_message.to_user_id = ToUser.Id
WHERE FromUser.Id = '".$_SESSION['UserId']."' OR ToUser.Id = '".$_SESSION['UserId']."'
ORDER BY chat_message.chat_message_id DESC) AS Data";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="70%">Username</td>
		<th width="20%">Status</td>
		<th width="10%">Action</td>
	</tr>
';

foreach($result as $row)
{
	$status = '';
	$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
	$user_last_activity = fetch_user_last_activity($row['UserId'], $connect);
	if($user_last_activity > $current_timestamp)
	{
		$status = '<span class="label label-success">Online</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Offline</span>';
	}
	$output .= '
	<tr>
		<td>'.$row['UserName'].' '.count_unseen_message($row['UserId'], $_SESSION['UserId'], $connect).' '.fetch_is_type_status($row['UserId'], $connect).'</td>
		<td>'.$status.'</td>
		<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['UserId'].'" data-tousername="'.$row['UserName'].'">Start Chat</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>