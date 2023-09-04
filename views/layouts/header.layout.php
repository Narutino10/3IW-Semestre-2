<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title><?=$title?> | <?=\Config\Core::APP_NAME?></title>
    <link rel="stylesheet" href="/css/app.css">

    <style>body {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  background: #f2f2f2;
  font-family: "Poppins", sans-serif;
}

a {
  color: #000;
  text-decoration: none;
}

a:hover {
  color: #4caf50;
}

header {
  padding: 30px 13px;
  background: #fff;
  box-shadow: rgba(149, 157, 165, 0.2) 0px 6px 14px;
}

.container {
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
}

.navbar ul {
  display: flex;
  column-gap: 40px;
  padding: 0px;
  margin: 0px;
}
.navbar ul li {
  list-style: none;
}
.navbar ul li a {
  text-decoration: none;
}
.navbar ul li a.activenav {
  color: #4caf50;
}

.main-banner {
  padding: 50px 0px;
}

.main-heading h1 {
  text-align: center;
  color: #4caf50;
  font-size: 45px;
  font-weight: 700;
  margin-top: 0px;
}

.form {
  max-width: 40%;
  margin: auto;
  padding: 30px;
  background: #fff;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  border-radius: 10px;
}
.form input {
  width: 94%;
  padding: 10px 12px;
  border-radius: 4px;
  border: 1px solid #7c7878;
}
.form select {
  width: 100%;
  padding: 10px 12px;
  border-radius: 4px;
}
.form label {
  color: #000;
  font-size: 17px;
  line-height: 35px;
}
.form .form-group {
  margin-bottom: 18px;
}
.form .form-btn button {
  color: #fff;
  font-size: 10px;
  font-weight: 700;
  width: 95%;
  background: #4caf50;
  padding: 10px 12px;
  text-align: center;
  margin-top: 15px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
}

.log-in h2 {
  font-size: 15px;
  margin: 0px;
  padding-top: 22px;
  text-align: center;
  font-weight: 500;
  color: #4caf50;
}

.forgot-pas a {
  color: #0000ff;
  text-decoration: underline;
}

.table-wrap {
  background: #fff;
  padding: 25px 27px;
  max-width: 63%;
  margin: auto;
  border-radius: 10px;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.table-wrap table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}
.table-wrap th {
  text-align: left;
  padding: 8px;
  font-size: 16px;
  font-weight: 500;
  color: #000;
  border: 1px solid #b5b2b2;
  background: #F2F2F2;
}
.table-wrap td {
  text-align: left;
  padding: 8px;
  font-size: 16px;
  font-weight: 500;
  color: #000;
  border: 1px solid #b5b2b2;
}

.form-content h3 {
  margin-top: 0px;
  font-size: 23px;
  font-weight: 500;
}

.form.form-players {
  max-width: 63%;
}

.players-list-wrap h4 {
  font-size: 25px;
  margin-bottom: 0px;
  font-weight: 600;
  color: #000;
}

.players-list-wrap p {
  font-size: 15px;
}

.home-page-wrap h5 {
  margin-top: 0px;
  font-size: 20px;
  margin-bottom: 0px;
  font-weight: 500;
}

.home-page-wrap p {
  font-size: 15px;
  margin: 0px;
  padding: 5px 0px;
}

.figure {
  max-width: 30px;
}

a.edit {
  color: #4caf50;
}

#w3review {
  width: 99% !important;
}


</style>

</head>

<body>
