<?php

// data train set
$connect = mysqli_connect("localhost", "root", "", "bayes"); // database connection
$sql = "SELECT * FROM buys_computer";
$query = mysqli_query($connect, $sql);

$x_train = [];
$y_train = [];
while($row = mysqli_fetch_array($query)){
  $temp = [$row["age"], $row["income"], $row["student"], $row["credit_rating"]];
  array_push($x_train, $temp);
  array_push($y_train, $row["buys_computer"]);
}

/*
parameter description:
1. $x = data test set
2. $c = class
3. $_x = data train set
*/

// count class prior probability
function class_prior_prob($c)
{
  $count_yes = 0;
  $count_no = 0;

  for($i = 0; $i < count($c); $i++){
    if($c[$i] == "yes"){
      $count_yes += 1;
    }else{
      $count_no += 1;
    }
  }

  $yes = $count_yes / count($c);
  $no = $count_no / count($c);

  return [$yes, $no];
}

// count likelihood
function likelihood($x, $c, $_x){
  $age_yes = 0;
  $income_yes = 0;
  $student_yes = 0;
  $credit_rating_yes = 0;

  $age_no = 0;
  $income_no = 0;
  $student_no = 0;
  $credit_rating_no = 0;

  $count_yes = 0;
  $count_no = 0;

  for($i = 0; $i < count($c); $i++){
    if($c[$i] == "yes"){
      $count_yes += 1;
    }else{
      $count_no += 1;
    }
  }

  for($i = 0; $i < count($_x); $i++){
    for($j = 0; $j < count($_x[0]); $j++){
      if($_x[$i][$j] == $x[$j]){
        if($c[$i] == "yes"){
          if($j == 0){
            $age_yes += 1;
          }elseif($j == 1){
            $income_yes += 1;
          }elseif($j == 2){
            $student_yes += 1;
          }else{
            $credit_rating_yes += 1;
          }
        }else{
          if($j == 0){
            $age_no += 1;
          }elseif($j == 1){
            $income_no += 1;
          }elseif($j == 2){
            $student_no += 1;
          }else{
            $credit_rating_no += 1;
          }
        }
      }
    }
  }

  $age_yes = $age_yes / $count_yes;
  $income_yes = $income_yes / $count_yes;
  $student_yes = $student_yes / $count_yes;
  $credit_rating_yes = $credit_rating_yes / $count_yes;

  $age_no = $age_no / $count_no;
  $income_no = $income_no / $count_no;
  $student_no = $student_no / $count_no;
  $credit_rating_no = $credit_rating_no / $count_no;

  $yes = $age_yes * $income_yes * $student_yes * $credit_rating_yes;
  $no = $age_no * $income_no * $student_no * $credit_rating_no;

  return [$yes, $no];
}

// count posterior probability
function posterior_prob($x, $c, $_x){
  $prior = class_prior_prob($c);
  $lklhood = likelihood($_x, $c, $x);

  $yes = $prior[0] * $lklhood[0];
  $no = $prior[1] * $lklhood[1];

  if($yes > $no){
    return "yes";
  }else{
    return "no";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Naive Bayes | Buys Computer</title>
</head>
<body>
  <h3>Naive Bayes | Predict Buys Computer</h3>
  <form action="index.php" method="POST">
    <table cellpadding="5">
      <tr>
        <td>Age</td>
        <td>:</td>
        <td>
          <select name="age" required>
            <option value="">Select Age</option>
            <option value="<=30"><=30</option>
            <option value="31...40">31...40</option>
            <option value=">40">>40</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Income</td>
        <td>:</td>
        <td>
          <select name="income" required>
            <option value="">Select Income</option>
            <option value="high">High</option>
            <option value="medium">Medium</option>
            <option value="low">Low</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Student</td>
        <td>:</td>
        <td>
          <select name="student" required>
            <option value="">Select Student</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Credit Rating</td>
        <td>:</td>
        <td>
          <select name="credit_rating" required>
            <option value="">Select Credit Rating</option>
            <option value="fair">Fair</option>
            <option value="excellent">Excellent</option>
          </select>
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><input type="submit" name="btn_predict" value="Start Predict"></td>
      </tr>
    </table>
  </form>
</body>
</html>

<?php 

// get form data
if(@$_POST["btn_predict"]){
  $x_test = [$_POST["age"], $_POST["income"], $_POST["student"], $_POST["credit_rating"]];
  $result = posterior_prob($x_train, $y_train, $x_test);
  echo "<p><strong>Buys Computer = $result</strong></p>";
}

?>