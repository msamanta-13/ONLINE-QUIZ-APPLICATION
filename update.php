<?php
include_once 'database.php';
session_start();
$email = mysqli_real_escape_string($con, $_SESSION['email']); // Sanitize user input

// Delete user, rank, and history records
if(isset($_SESSION['key']) && @$_GET['demail'] && $_SESSION['key']=='admin') {
    $demail = mysqli_real_escape_string($con, $_GET['demail']); // Sanitize user input
    $r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die(mysqli_error($con));
    $r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die(mysqli_error($con));
    $result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die(mysqli_error($con));
    header("location:dashboard.php?q=1");
}

// Remove quiz
if(isset($_SESSION['key']) && @$_GET['q']== 'rmquiz' && $_SESSION['key']=='admin') {
    $eid = mysqli_real_escape_string($con, $_GET['eid']); // Sanitize user input
    $result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die(mysqli_error($con));
    while($row = mysqli_fetch_array($result)) {
        $qid = $row['qid'];
        $r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die(mysqli_error($con));
        $r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die(mysqli_error($con));
    }
    $r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die(mysqli_error($con));
    $r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die(mysqli_error($con));
    $r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die(mysqli_error($con));
    header("location:dashboard.php?q=5");
}

// Add quiz
if(isset($_SESSION['key']) && @$_GET['q']== 'addquiz' && $_SESSION['key']=='admin') {
    $name = mysqli_real_escape_string($con, ucwords(strtolower($_POST['name']))); // Sanitize user input
    $total = mysqli_real_escape_string($con, $_POST['total']); // Sanitize user input
    $sahi = mysqli_real_escape_string($con, $_POST['right']); // Sanitize user input
    $wrong = mysqli_real_escape_string($con, $_POST['wrong']); // Sanitize user input
    $id = uniqid();
    $q3 = mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name' , '$sahi' , '$wrong','$total', NOW())") or die(mysqli_error($con));
    header("location:dashboard.php?q=4&step=2&eid=$id&n=$total");
}

// Add questions
if(isset($_SESSION['key']) && @$_GET['q']== 'addqns' && $_SESSION['key']=='admin') {
    $n = mysqli_real_escape_string($con, $_GET['n']); // Sanitize user input
    $eid = mysqli_real_escape_string($con, $_GET['eid']); // Sanitize user input
    $ch = mysqli_real_escape_string($con, $_GET['ch']); // Sanitize user input
    for($i=1; $i<=$n; $i++) {
        $qid = uniqid();
        $qns = mysqli_real_escape_string($con, $_POST['qns'.$i]); // Sanitize user input
        $q3 = mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')") or die(mysqli_error($con));
        $oaid = uniqid();
        $obid = uniqid();
        $ocid = uniqid();
        $odid = uniqid();
        $a = mysqli_real_escape_string($con, $_POST[$i.'1']); // Sanitize user input
        $b = mysqli_real_escape_string($con, $_POST[$i.'2']); // Sanitize user input
        $c = mysqli_real_escape_string($con, $_POST[$i.'3']); // Sanitize user input
        $d = mysqli_real_escape_string($con, $_POST[$i.'4']); // Sanitize user input
        $qa = mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die(mysqli_error($con));
        $qb = mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die(mysqli_error($con));
        $qc = mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die(mysqli_error($con));
        $qd = mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die(mysqli_error($con));
        $e = $_POST['ans'.$i];
        switch($e) {
            case 'a': $ansid=$oaid; break;
            case 'b': $ansid=$obid; break;
            case 'c': $ansid=$ocid; break;
            case 'd': $ansid=$odid; break;
            default: $ansid=$oaid;
        }
        $qans = mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')") or die(mysqli_error($con));
    }
    header("location:dashboard.php?q=0");
}

// Process quiz
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
    $eid=@$_GET['eid'];
    $sn=@$_GET['n'];
    $total=@$_GET['t'];
    $ans=$_POST['ans'];
    $qid=@$_GET['qid'];
    $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
    while($row=mysqli_fetch_array($q) )
    {  $ansid=$row['ansid']; }
    if($ans == $ansid)
    {
      $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
      while($row=mysqli_fetch_array($q) )
      {
        $sahi=$row['sahi'];
      }
      if($sn == 1)
      {
        $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
      }
      $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
        $r=$row['sahi'];
      }
      $r++;
      $s=$s+$sahi;
      $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');
    } 
    else
    {
      $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');
      while($row=mysqli_fetch_array($q) )
      {
        $wrong=$row['wrong'];
      }
      if($sn == 1)
      {
        $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
      }
      $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
        $w=$row['wrong'];
      }
      $w++;
      $s=$s-$wrong;
      $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
    }
    if($sn != $total)
    {
      $sn++;
      header("location:welcome.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
    }
    else if( $_SESSION['key']!='admin')
    {
      $q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
      while($row=mysqli_fetch_array($q) )
      {
        $s=$row['score'];
      }
      $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
      $rowcount=mysqli_num_rows($q);
      if($rowcount == 0)
      {
        $q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
      }
      else
      {
        while($row=mysqli_fetch_array($q) )
        {
          $sun=$row['score'];
        }
        $sun=$s+$sun;
        $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
      }
      header("location:welcome.php?q=result&eid=$eid");
    }
    else
    {
      header("location:welcome.php?q=result&eid=$eid");
    }
}

// Quiz restart
if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
    $eid=@$_GET['eid'];
    $n=@$_GET['n'];
    $t=@$_GET['t'];
    $q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
    while($row=mysqli_fetch_array($q) )
    {
      $s=$row['score'];
    }
    $q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
    $q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
    while($row=mysqli_fetch_array($q) )
    {
      $sun=$row['score'];
    }
    $sun=$sun-$s;
    $q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
    header("location:welcome.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}
?>
