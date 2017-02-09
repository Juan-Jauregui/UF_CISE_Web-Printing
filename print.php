#!/usr/local/bin/php

<html>
<head>
   <title>PHP Test</title>
   <!-- Bootstrap-->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-sm-offset-3">

            <div class="page-header">
               <h1>Print Files</h1>
            </div>

            <form action="./do_print.php" method="post">
               <div class="form-group">
                  <label for="username_input">CISE Login</label>
                  <input name="username" type="username" class="form-control" id="username_input" placeholder="Username">
               </div>

               <div class="form-group">
                  <label for="password_input">Password</label>
                  <input name="password" type="password" class="form-control" id="password_input" placeholder="Password">
               </div>

               <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input name="upload" type="file" id="input_file">
               </div>

               <div class="checkbox">
                  <label>
                     <input name="is_evil" type="checkbox"> I'm not evil
                  </label>
               </div>

               <button type="submit" class="btn btn-default">Submit</button>
            </form>
         </div>

      </div>
   </div>


   <!-- Bootstrap JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
