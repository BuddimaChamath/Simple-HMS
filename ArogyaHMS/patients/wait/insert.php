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
	$query = "SELECT * FROM waiting_list WHERE id='".$form_data->id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['id'] = $row['id'];
		$output['patient_id'] = $row['patient_id'];
		$output['date_added'] = $row['date_added'];
		$output['doctor_name'] = $row['doctor_name'];
		$output['appointment_date'] = $row['appointment_date'];
		$output['status'] = $row['status'];
	}
}
elseif($form_data->action == "Delete")
{
	$query = "
	DELETE FROM waiting_list WHERE id='".$form_data->id."'
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

	if(empty($form_data->patient_id))
	{
		$error[] = 'patient_id is Required';
	}
	else
	{
		$patient_id = $form_data->patient_id;
	}

	if(empty($form_data->date_added))
	{
		$error[] = 'date_added is Required';
	}
	else
	{
		$date_added = $form_data->date_added;
	}

	if(empty($form_data->doctor_name))
	{
		$error[] = 'doctor_name is Required';
	}
	else
	{
		$doctor_name = $form_data->doctor_name;
	}

	if(empty($form_data->appointment_date))
	{
		$error[] = 'appointment_date is Required';
	}
	else
	{
		$appointment_date = $form_data->appointment_date;
	}

	if(empty($form_data->status))
	{
		$error[] = 'status is Required';
	}
	else
	{
		$status = $form_data->status;
	}

	if(empty($error))
	{
		if($form_data->action == 'Insert')
		{
			$data = array(
				':id'		=>	$id,
				':patient_id'		=>	$patient_id,
				':date_added'		=>	$date_added,
				':doctor_name'		=>	$doctor_name,
				':appointment_date'		=>	$appointment_date,
				':status'		=>	$status,
			);
			$query = "
			INSERT INTO waiting_list 
				(id, patient_id, date_added, doctor_name, appointment_date, status) VALUES 
				(:id, :patient_id, :date_added, :doctor_name, :appointment_date, :status)
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
				':patient_id'	=>	$patient_id,
				':date_added'	=>	$date_added,
				':doctor_name'	=>	$doctor_name,
				':appointment_date'	=>	$appointment_date,
				':status'	=>	$status,
				':id'			=>	$form_data->id
			);
			$query = "
			UPDATE waiting_list 
			SET patient_id = :patient_id, date_added = :date_added, doctor_name = :doctor_name, appointment_date = :appointment_date, status = :status
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