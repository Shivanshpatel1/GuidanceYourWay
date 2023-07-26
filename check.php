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
<div class="result">
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

    </body>

</html>
