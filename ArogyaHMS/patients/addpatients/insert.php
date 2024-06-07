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
	$query = "SELECT * FROM patients WHERE id='".$form_data->id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['id'] = $row['id'];
		$output['name'] = $row['name'];
		$output['address'] = $row['address'];
		$output['phone'] = $row['phone'];
		$output['email'] = $row['email'];
		$output['gender'] = $row['gender'];
		$output['birthdate'] = $row['birthdate'];
		$output['insurance_provider'] = $row['insurance_provider'];
	}
}
elseif($form_data->action == "Delete")
{
	$query = "
	DELETE FROM patients WHERE id='".$form_data->id."'
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
		$error[] = 'Name is Required';
	}
	else
	{
		$name = $form_data->name;
	}

	if(empty($form_data->address))
	{
		$error[] = 'Address is Required';
	}
	else
	{
		$address = $form_data->address;
	}

	if(empty($form_data->phone))
	{
		$error[] = 'Phone Number is Required';
	}
	else
	{
		$phone = $form_data->phone;
	}

	if(empty($form_data->email))
	{
		$error[] = 'Email is Required';
	}
	else
	{
		$email = $form_data->email;
	}

	if(empty($form_data->gender))
	{
		$error[] = 'Gender is Required';
	}
	else
	{
		$gender = $form_data->gender;
	}

	if(empty($form_data->birthdate))
	{
		$error[] = 'Birthdate is Required';
	}
	else
	{
		$birthdate = $form_data->birthdate;
	}

	if(empty($form_data->insurance_provider))
	{
		$error[] = 'Insurance Provider is Required';
	}
	else
	{
		$insurance_provider = $form_data->insurance_provider;
	}

	if(empty($error))
	{
		if($form_data->action == 'Insert')
		{
			$data = array(
				':id'		=>	$id,
				':name'		=>	$name,
				':address'		=>	$address,
				':phone'		=>	$phone,
				':email'		=>	$email,
				':gender'		=>	$gender,
				':birthdate'		=>	$birthdate,
				':insurance_provider'		=>	$insurance_provider
			);
			$query = "
			INSERT INTO patients 
				(id, name, address, phone, email, gender, birthdate, insurance_provider) VALUES 
				(:id, :name, :address, :phone, :email, :gender, :birthdate, :insurance_provider)
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
				':name'	=>	$name,
				':address'	=>	$address,
				':phone'	=>	$phone,
				':email'	=>	$email,
				':gender'	=>	$gender,
				':birthdate'	=>	$birthdate,
				':insurance_provider'	=>	$insurance_provider,
				':id'			=>	$form_data->id
			);
			$query = "
			UPDATE patients 
			SET name = :name, address = :address, phone = :phone, email = :email, gender = :gender, birthdate = :birthdate, insurance_provider = :insurance_provider
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