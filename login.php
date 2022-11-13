<?php
    $title = 'Login'; 

    require_once 'includes/header.php'; 
    require_once 'db/conn.php'; 
    require_once 'db/conn.php'; 
    
    
    if (isset($_POST['username']) && isset($_POST['password'])) {
    
        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
    
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
    
        if (empty($username)) {
            header("Location: login.php?error=User Name is required");
            exit();
        }else if(empty($password)){
            header("Location: login.php?error=Password is required");
            exit();
        }else{
            $sql = "SELECT * FROM users WHERE user_name='$username' AND password='$password'";
    
            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['user_name'] === $username && $row['password'] === $password) {
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: home.php");
                    exit();
                }else{
                    header("Location: login.php?error=Incorect User name or password");
                    exit();
                }
            }else{
                header("Location: login.php?error=Incorect User name or password");
                exit();
            }
        }
        
    }else{
        header("Location: viewrecords.php");
        exit();
    }
?>
<h1 class="text-center"><?php echo $title ?> </h1>
   
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
       <table class="table table-sm">
           <tr>
               <td><label for="username">Username: * </label></td>
               <td><input type="text" name="username" class="form-control" id="username" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['username']; ?>">
               </td>
           </tr>
           <tr>
               <td><label for="password">Password: * </label></td>
               <td><input type="password" name="password" class="form-control" id="password">
               </td>
           </tr>
       </table><br/><br/>
       <input type="submit" value="Login" class="btn btn-primary btn-block"><br/>
       <a href="#"> Forgot Password </a>
    </form><br/><br/><br/><br/>

<?php include_once 'includes/footer.php'?>