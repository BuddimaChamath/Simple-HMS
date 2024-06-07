<?php

//insert.php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$error = '';
$message = '';
$validation_error = '';
$first_name = '';
$last_name = '';

if($form_data->action == 'fetch_single_data')
{
	$query = "SELECT * FROM staff WHERE id='".$form_data->id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['id'] = $row['id'];
		$output['name'] = $row['name'];
		$output['job'] = $row['job'];
		$output['email'] = $row['email'];
		$output['phone'] = $row['phone'];
		$output['schedule'] = $row['schedule'];
	}
}
elseif($form_data->action == "Delete")
{
	$query = "
	DELETE FROM staff WHERE id='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$output['message'] = 'Data Deleted';
	}
}
else
{
	if(empty($form_data->id))
	{
		$error[] = 'ID is Required';
	}
	else
	{
		$id = $form_data->id;
	}

	if(empty($form_data->name))
	{
		$error[] = 'name is Required';
	}
	else
	{
		$name = $form_data->name;
	}

	if(empty($form_data->job))
	{
		$error[] = 'job is Required';
	}
	else
	{
		$job = $form_data->job;
	}

	if(empty($form_data->email))
	{
		$error[] = 'email is Required';
	}
	else
	{
		$email = $form_data->email;
	}

	if(empty($form_data->phone))
	{
		$error[] = 'phone is Required';
	}
	else
	{
		$phone = $form_data->phone;
	}

	if(empty($form_data->schedule))
	{
		$error[] = 'schedule is Required';
	}
	else
	{
		$schedule = $form_data->schedule;
	}

	if(empty($error))
	{
		if($form_data->action == 'Insert')
		{
			$data = array(
				':id'		=>	$id,
				':name'		=>	$name,
				':job'		=>	$job,
				':email'		=>	$email,
				':phone'		=>	$phone,
				':schedule'		=>	$schedule,
			);
			$query = "
			INSERT INTO staff 
				(id, name, job, email, phone, schedule) VALUES 
				(:id, :name, :job, :email, :phone, :schedule)
			";
			$statement = $connect->prepare($query);
			if($statement->execute($data))
			{
				$message = 'Data Inserted';
			}
		}
		if($form_data->action == 'Edit')
		{
			$data = array(
				':name'		=>	$name,
				':job'		=>	$job,
				':email'	=>	$email,
				':phone'	=>	$phone,
				':schedule'	=>	$schedule,
				':id'		=>	$form_data->id
			);
			$query = "
			UPDATE staff 
			SET name = :name, job = :job, email = :email, phone = :phone, schedule = :schedule
			WHERE id = :id
			";

			$statement = $connect->prepare($query);
			if($statement->execute($data))
			{
				$message = 'Data Edited';
			}
		}
	}
	else
	{
		$validation_error = implode(", ", $error);
	}

	$output = array(
		'error'		=>	$validation_error,
		'message'	=>	$message
	);

}



echo json_encode($output);

?>