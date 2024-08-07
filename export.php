<?php
require_once "config.php";

if(isset($_GET['what'])){

            if($_GET['what']== "members"){

            $sql = "SELECT * from members";
            $csv_columns = [
                
            "first_name",
            "last_name"	,
            "email"	,
            "phone_number",	
            ];

            }elseif($_GET['what']== "trainers"){

                $sql = "SELECT * from trainers";
                $csv_columns = [
                
                    "first_name",
                    "last_name"	,
                    "email",
                    "phone_number"
                    ];

            }else{
            echo "nista"; 
            die();
            }
            $run = $conn->query($sql);
            $results = $run->fetch_all(MYSQLI_ASSOC);
            $output = fopen("php://output", "w");
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename = " . $_GET['what'] . ".csv");
            fputcsv($output, $csv_columns);
            foreach($results as $result){

                $filtered_result = array_intersect_key($result, array_flip($csv_columns));
                fputcsv($output, $filtered_result);

            }
            fclose($output);

};