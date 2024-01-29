<?php  
 require_once "config.php";
 require_once "fpdf/fpdf.php";
require_once "session_check.php";


 if ($_SERVER['REQUEST_METHOD'] == "POST"){
     $first_name = $_POST['first_name'];

     $last_name = $_POST['last_name'];
     $email = $_POST['email'];
     $phone_number = $_POST['phone_number'];
     $photo_path = $_POST['photo_path'];
     $training_plan_id = $_POST['training_plan_id'];
     $trainer_id =0;
     $access_card_pdf_path = "";
 }


 $select_training_plan = "SELECT * from training_plans where plan_id = $training_plan_id";
 $trainig_plan = $conn->query($select_training_plan);
 $results_trining_plan = $trainig_plan->fetch_object();

 $sql = "INSERT INTO members
        (first_name, last_name, email, phone_number, photo_path,trainer_id, training_plan_id, access_card_pdf_path)
            VALUES (?,?,?,?,?,?,?,?)";
       $run = $conn ->prepare($sql);
       $run -> bind_param("sssisiis",  $first_name, $last_name ,$email,  $phone_number, $photo_path, $trainer_id, $training_plan_id, $access_card_pdf_path);
       $run-> execute();
       $member_id = $conn->insert_id;

       $pdf = new FPDF();
       $pdf->AddPage();
       $pdf->SetFont('Arial', "B", 16);
       $pdf->Ln();
       $pdf->Cell(40,10, 'Member ID: ' . $member_id);
       $pdf->Ln();
       $pdf->Cell(40,10, 'Name: ' . $first_name . " " . $last_name);
       $pdf->Ln();
       $pdf->Cell(40,10, 'Email: ' . $email);
       $pdf->Ln();
       $pdf->Cell(40,10, 'Phone number : ' . $phone_number);
       $pdf->Ln();
       $pdf->Cell(40,10, 'training plan name: ' . $results_trining_plan->name);
       $pdf->Ln();
       $pdf->Cell(40,10, 'number of training per week: ' . $results_trining_plan->sessions);
       $pdf->Ln();
       $pdf->Cell(40,10, 'Price per month: ' . $results_trining_plan->price . " $");
       
       $filename = "access_cards/access_card_" . $member_id . ".pdf";
       $pdf-> Output('F', $filename);
      $sql = "UPDATE members SET access_card_pdf_path = '$filename'  WHERE member_id = $member_id";
      $conn->query($sql);
      $conn->close();

       $_SESSION['success_message'] = "New Member <b>"  . $first_name . ' '. $last_name  . "</b> added successfully!";

       echo '<script type="text/javascript">window.location = "admin-dashboard-members.php"</script>';
       exit();
?>

