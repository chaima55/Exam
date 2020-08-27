
                    <?php
                              session_start();
                              if(!isset($_SESSION['UserId']) || $_SESSION["UserRoles"]=="ROLE_ETUDIANT"){
                        $errMsg="You cant add exam";

                        header("location:login.php?errMsg=".$errMsg);
                    }
                    
                   
                    ?>
                     <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Cosmetics & Beauty Products</title>
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
                              integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

                        <!-- JS, Popper.js, and jQuery -->
                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                                crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                                crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
                                integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
                                crossorigin="anonymous"></script>
                    </head>

                    <body class="text-center">
                    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
                          <main role="main" class="inner cover">
                             <form action="addAction.php" method="post" enctype="multipart/form-data">
                                                   <div class="form-group">
                                                       <label for="exampleInputEmail1">name</label>
                                                       <input type="text" class="form-control" id="exampleInputEmail1"
                                                              name="name"
                                                              aria-describedby="emailHelp" placeholder="cours name">
                                                       <small id="emailHelp" class="form-text text-muted">enter the cours name</small>
                                                   </div>
                                                   <div class="form-group">
                                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                                   </div>
                                                   <button type="submit" class="btn btn-primary">Submit</button>
                                               </form>


                        </main>
                    </div>


                    </body>
                    </html>