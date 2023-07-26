<?php

include 'configur.php';
session_start();

if(isset($_POST['submit'])){

   $pass = test_input($_POST['password']);

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
		$row = mysqli_fetch_assoc($select);
		$_SESSION['user_id'] = $row['id'];
		$email=$row['email'];
      $name=$row['name'];
		$result=file_get_contents('https://script.googleusercontent.com/macros/echo?user_content_key=N2swyxKm8NpwCRymfwHgPz2TBBq7-OVwqgpT-pZ9m4YoQ3fMoxdLKFdSWD5RLGOf7wvFJTTolr_SDrY5Js48aBFRhuXQl5Ipm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnFX20B-5OShEGx7IRgZw6v5sMnF-7vqk841uYni5zOzyPOnYQeExwdpr0UGkArCjNXxdtE32NCr_u6iECXLn5Sz14qbJ0v1OKNz9Jw9Md8uu&lib=MIFZbxfGvR9TdwHoPkLnY0OKl9yBOyQre');
		$arr=json_decode($result,true);
		$data=$arr['content'];
      $math=-1;$bio=-1;$commerce=-1;$eng=-1;
      for($i=0;$i<4;$i++){
         $datain=$data[$i];
         $ind=count($datain);
         for($j=1;$j<$ind;$j++){
            if($datain[$j]['1']==$email){
               if($i==0){
                  $math=$datain[$j]['2'];
               }
               elseif($i==1){
                  $bio=$datain[$j]['2'];
               }
               elseif($i==2){
                  $commerce=$datain[$j]['2'];
               }
               else{
                  $eng=$datain[$j]['2'];
               }
               break;
            }
         }
      }
      if($math==-1){
         $math="Test not given yet!";
      }
      if($bio==-1){
         $bio="Test not given yet!";
      }
      if($commerce==-1){
         $commerce="Test not given yet!";
      }
      if($eng==-1){
         $eng="Test not given yet!";
      }
      $sub=array($math,$bio,$commerce,$eng);
      
   }else{
      $message[] = 'Incorrect password!';
   }
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style_form.css">
   <link rel="stylesheet" href="res.css">
</head>

<body>
<div id="remo0" class="result">
      <div class="result first">
         <?php
            if(isset($sub)){
               echo '<h4>Hi! '.$name.'</h4>';
            }
         ?>
      </div>
      <div class="result name">
         <?php
            if(isset($sub)){
               echo '<table>
                  <caption>Your Results</caption>
                  <tr>
                     <th>Subjects</th>
                     <th>Your Marks</th>
                  </tr>
                  <tr>
                     <td>Math</td>
                     <td>'.$sub[0].'</td>
                  </tr>
                  <tr>
                     <td>Biology</td>
                     <td>'.$sub[1].'</td>
                  </tr>
                  <tr>
                     <td>Commerce</td>
                     <td>'.$sub[2].'</td>
                  </tr>
                  <tr>
                     <td>English</td>
                     <td>'.$sub[3].'</td>
                  </tr>
               </table>';
               
            }
         ?>
      </div>
    </div>
    <div class="last">
      <?php
         if(isset($sub)){
            $val=max($sub[0],$sub[1],$sub[2],$sub[3]);
               if($val=="Test not given yet!"){
                  echo '<div style="font-weight:bold;">Sorry! First you have to give the test</div>';
               }
               elseif($val==$math){
                  echo '<div style="font-weight:bold;">Since you are strong in mathematics i would suggest you to choose Engineering as career.</div>';
               }
               elseif($val==$bio){
                  echo '<div style="font-weight:bold;">Since you are strong in Biology i would suggest you to choose Medical as career.</div>';
               }
               elseif($val==$commerce){
                  echo '<div style="font-weight:bold;">Since you are strong in Commerce i would suggest you to choose Business development as career.</div>';
               }else{
                  echo '<div style="font-weight:bold;">You are strong in English but you have to also focus on other subject.</div>';
               } 
         }
      ?>
    </div>
    <div id="remo" class="form-container">

        <form action="" method="post" enctype="multipart/form-data">
            <h2>Please enter your password</h2>
            <?php
                if(isset($message)){
                    foreach($message as $message){
                        echo '<div class="message">'.$message.'</div>';
                    }
                }
            ?>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <div style="display:flex;flex-direction:row;column-gap:5px;">
                <input style="width:50%;" type="submit" name="submit" value="My Score" class="btn" onclick="myfun()">
                <a style="width:50%;" href="index2.html" class="btn">Home</a>
            </div>
        </form>

   </div>
   
    <script>
      function myfun() {
         document.getElementById("remo").style.opacity = "0";
      }
   </script>
</body>

</html>