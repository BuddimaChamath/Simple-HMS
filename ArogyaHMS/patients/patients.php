<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <title>Arogya Health Care Hospital - Patients</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
        }
        /* Style the container for the cards */
        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        /* Style the cards */
        .card {
            width: 300px;
            height: 300px;
            margin: 20px;
            border: 1px solid gray;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        /* Style the card titles */
        .card h4 {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        /* Style the card buttons */
        .card a {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: aquamarine
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
  </head>
  <body>
  <div class="container" >
  <h1 class="text-center">PATIENTS</h1>
  <div class="row">
    <div class="col-md-4">
      <div class="card" style="width: 350px; height: 250px; display: flex; align-items: center; justify-content: center;">
        <div class="card-body">
          <h4 class="card-title">Patients Information</h4>
          <p class="card-text">View and manage patient information, including personal details and medical history.</p>
          <a href="addpatients/index.html" class="btn btn-primary">View Table</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card" style="width: 350px; height: 250px; display: flex; align-items: center; justify-content: center;">
        <div class="card-body">
          <h4 class="card-title">Patients Invoices</h4>
          <p class="card-text">View and manage patient invoices, including payments and billing <br>details.</p>
          <a href="invo/index.html" class="btn btn-primary">View Invoices</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card" style="width: 350px; height: 250px; display: flex; align-items: center; justify-content: center;">
        <div class="card-body">
          <h4 class="card-title">Waiting List</h4>
          <p class="card-text">View and manage patients waiting list, including the status and priority of each patient.</p>
          <a href="wait/index.html" class="btn btn-primary">View List</a>
        </div>
      </div>
    </div>
  </body>
</html>
