<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <br/>
    <div class="container">
    <div class="row">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <form id="reg" name="myForm" method="POST" >
                <h3>Registration form</h3>
                <br/>
            <input type="hidden" name="HI"/>
            <div class="form-group col-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label">Username</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <input class="form-control" type="text" name="username" id="username"/>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label">Password</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <input class="form-control" type="password" name="password" id="password"/>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label">Confirm password</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <input class="form-control" type="password" name="confirmpass" id="confirmpass"/>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label">Email</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <input class="form-control" type="email" name="email" id="email"/>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label">Gender</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <label class="form-check-label">Male</label>
                        <input type="radio" class="form-check-input" name="gender"  id="male" value="male" >
                        <label class="form-check-label">Female</label>
                        <input type="radio" class="form-check-input" name="gender" id="female" value="female">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label">Address</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <label class="control-label">Declaration</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 declaration">
                        <input type="checkbox" class="form-check-input" name="declaration" id="declaration" value="checked">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-8">&nbsp;</div>
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <button type="reset" class="btn btn-danger reset">Reset</button>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                        <button type="submit" class="btn btn-primary" data-action='save' name="save" id="save_button">Save</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="col-3">&nbsp;</div>
    </div>
    </div>
<hr>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Declaration</th>
        <th>Created</th>
        <!-- <th>Updated</th> -->
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>

    <!-- Table rendering from database -->
    <tbody id="table_data">

    </tbody>
    </table>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/register.js"></script>
</body>
</html>
