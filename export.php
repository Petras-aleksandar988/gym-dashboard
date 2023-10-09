<?php
require_once "config.php";

if(isset($_GET['what'])){

            if($_GET['what']== "members"){

            $sql = "SELECT * from members";
            $csv_columns = [
                
            "member_id"	,
            "first_name	",
            "last_name"	,
            "email"	,
            "phone_number",	
            "photo_path",	
            "trainer_id",	
            "training_plan_id"	,
            "access_card_pdf_path",	
            "created_at"
            ];

            }elseif($_GET['what']== "trainers"){
                $sql = "SELECT * from trainers";
                $csv_columns = [
                
                    "trainer_id"	,
                    "first_name	",
                    "last_name"	,
                    "email"	,
                    "phone_number",		
                    "created_at"
                    ];

            }else{
            echo "nista"; 
            die();
            }
            $run = $conn->query($sql);
            $results = $run->fetch_all(MYSQLI_ASSOC);
            $output = fopen("php://output", "w");
            header("Content-type : text/csv");
            header("Content-Disposition: attachment; filename = " . $_GET['what'] . ".csv");
            fputcsv($output, $csv_columns);
            foreach($results as $result){
                
                fputcsv($output, $result);

            }
            fclose($output);

};