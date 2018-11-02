<?php
    function getEvents($year, $id){
        $res = array();
        $res["result"] = false;
        $econn = new mysqli("localhost", "root", "", "my_fowdeckhub");
        
        // Controllo che la connessione sia impostata.
        if(!isset($econn)) {
            $res["msg"] = "Problemi di connessione al server, contact the support.";
            return $res;
        }
        
        if(isset($econn) && $econn->connect_error) {
            $res["msg"] = "Problema di connessione instaurata al server, contact the support.";
            return $res;
        } 
        
        // Effettuo finalmente il caricamento della decklist.
        // Carico tutte le decklists.
        $query = "SELECT e.Id, e.Name, n.Name as Nation, e.Year, e.Date, e.Attendance
				FROM events e
				join nations n on e.Nation = n.Id
				where YEAR(e.Date) = ?";

         if(isset($id) && $id > 0) {
        // Carico una specifica decklist.
            $query .= " and d.Id = " . $id;
        }
		
		$query .= " order by e.Date";

        $stmt = $econn->prepare($query);
		$stmt->bind_param("i", $year_param);
		$year_param = mysql_real_escape_string($year);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $res["content"] = array();
            $res["msg"] = "There's some data to view";
            while($row = $result->fetch_assoc()) {
                $stringa["Id"] = $row["Id"];
                $stringa["Name"] = $row["Name"];
                $stringa["Nation"] = $row["Nation"];
                $stringa["Year"] = $row["Year"];
                $stringa["Attendance"] = $row["Attendance"];
                $stringa["Date"] = $row["Date"];
                array_push($res["content"], $stringa);
            }
        } else {
            $res["msg"] = "No data to view.";
            return $res;
        }
        
        $res["result"] = true;
        if(isset($econn)) {
            $econn->close();
        }
        return $res;
    }
?>