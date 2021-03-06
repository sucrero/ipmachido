<?php
    require_once '../clases/Conexion.php';
    try {
        $where =" 1=1 ";
        $order_by="fcehaingreso DESC";
        $rows=10;
        $current=1;
        $limit_l=($current * $rows) - ($rows);
        $limit_h=$limit_lower + $rows;
        
        $campos = array("nombrepc","nombreusu","direccionip","ubicacion","departamento","observacion");
        $val = array("pc","usu","ip","ubi","dpto","obs");
       
        //Handles Sort querystring sent from Bootgrid
        if (isset($_REQUEST['sort']) && is_array($_REQUEST['sort']) ){
            $order_by="";
            foreach($_REQUEST['sort'] as $key => $value)
                for($i = 0;$i < count($val);$i++){
                    if($key == $val[$i]){
                        $key = $campos[$i];
                    }
                }
                $order_by.=" $key $value";
        }
        //Handles search querystring sent from Bootgrid
        if (isset($_REQUEST['searchPhrase']) ){
            $search = trim(strtoupper($_REQUEST['searchPhrase']));
            $where.= " AND ( nombrepc LIKE '".$search."%' OR nombreusu LIKE '".$search."%' OR ubicacion LIKE '".$search."%' OR departamento LIKE '".$search."%' ) ";
        }
        
        //Handles determines where in the paging count this result set falls in
        if (isset($_REQUEST['rowCount']) )
            $rows = $_REQUEST['rowCount'];
        
        //calculate the low and high limits for the SQL LIMIT x,y clause
        if (isset($_REQUEST['current']) ){
            $current = $_REQUEST['current'];
            $limit_l = ($current * $rows) - ($rows);
            $limit_h = $rows ;
        }
        
        if ($rows == -1)
            $limit = ""; //no limit
        else
            $limit = " LIMIT $limit_h offset $limit_l";
        
        
        $con = Conexion::enlaceBD();
        //NOTE: No security here please beef this up using a prepared statement - as is this is prone to SQL injection.
        $sql = "SELECT * FROM equipo WHERE $where ORDER BY $order_by $limit";
//        print_r($sql);        die();
        $query = $con->db->prepare($sql);
        $query->execute();
        $results_array = $query->fetchAll(PDO::FETCH_ASSOC);         
        
        $comments = $issue_json->fields->comment->comments;
        $result = array();
        $num = 0;
        foreach ($results_array as $valor) {
            $result[] = array(
                'num' => ++$num,
                'id' => $valor['id'],
                'pc' => $valor['nombrepc'],
                'usu' => $valor['nombreusu'],
                'mac' => $valor['mac'],
                'ip' => $valor['direccionip'],
                'ubi' => $valor['ubicacion'],
                'dpto' => $valor['departamento'],
                'obs' => $valor['observacion'],
            );
        }
        
        $json = json_encode( $result );
             
//        /* specific search then how many match */
        $nRows = $con->db->query("SELECT count(*) FROM equipo WHERE $where")->fetchColumn();
        
        header('Content-Type: application/json'); //tell the broswer JSON is coming
        if (isset($_REQUEST['rowCount']) ){ //Means we're using bootgrid library
            echo "{ \"current\": $current, \"rowCount\":$rows, \"rows\": ".$json.", \"total\": $nRows }";
        }else
            echo $json; //Just plain vanillat JSON output
        exit;
    }   
    catch(PDOException $e) {
        echo 'SQL PDO ERROR: ' . $e->getMessage();
    }
