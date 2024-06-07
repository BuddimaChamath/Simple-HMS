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
	$query = "SELECT * FROM invoices WHERE id='".$form_data->id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['id'] = $row['id'];
		$output['patient_id'] = $row['patient_id'];
		$output['date'] = $row['date'];
		$output['amount'] = $row['amount'];
		$output['description'] = $row['description'];
		$output['payment_method'] = $row['payment_method'];
		$output['status'] = $row['status'];
	}
}
elseif($form_data->action == "Delete")
{
	$query = "
	DELETE FROM invoices WHERE id='".$form_data->id."'
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
		$error[] = 'Patient ID is Required';
	}
	else
	{
		$patient_id = $form_data->patient_id;
	}

	if(empty($form_data->date))
	{
		$error[] = 'Date is Required';
	}
	else
	{
		$date = $form_data->date;
	}

	if(empty($form_data->amount))
	{
		$error[] = 'Amount is Required';
	}
	else
	{
		$amount = $form_data->amount;
	}

	if(empty($form_data->description))
	{
		$error[] = 'Description is Required';
	}
	else
	{
		$description = $form_data->description;
	}

	if(empty($form_data->payment_method))
	{
		$error[] = 'Payment Method is Required';
	}
	else
	{
		$payment_method = $form_data->payment_method;
	}

	if(empty($form_data->status))
	{
		$error[] = 'Status is Required';
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
				':date'		=>	$date,
				':amount'		=>	$amount,
				':description'		=>	$description,
				':payment_method'		=>	$payment_method,
				':status'		=>	$status
			);
			$query = "
			INSERT INTO invoices 
				(id, patient_id, date, amount, description, payment_method, status ) VALUES 
				(:id, :patient_id, :date, :amount, :description, :payment_method, :status )
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
				':date'	=>	$date,
				':amount'	=>	$amount,
				':description'	=>	$description,
				':payment_method'	=>	$payment_method,
				':status'	=>	$status,
				':id'			=>	$form_data->id
			);
			$query = "
			UPDATE invoices 
			SET patient_id = :patient_id, date = :date, amount = :amount, description = :description, payment_method = :payment_method, status = :status
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