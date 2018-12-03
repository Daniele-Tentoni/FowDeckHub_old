<?php
	// Funzione di aggiunta del bug.
	function new_bug($name, $email, $bug){
		$msg = array();
		$msg["result"] = false;
		$msg["error"] = "nothing";
		$content = "";
		try {
			$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
			if($conn->connect_error){
				$msg["error"] = "Connection Error";
			} else {
				$query = "insert into bug_reports(Name, Email, Bug) values (?, ?, ?)";
				$stmt = $conn->prepare($query);
				if(!$stmt) {
					$msg["data"] = $conn->error_list;
					$msg["error"] = "Boolean value in \$stmt";
				} else {
					$stmt->bind_param("sss", $name_sql, $nation_sql, $year_sql);
					$name_sql = mysql_real_escape_string($name);
					$nation_sql = mysql_real_escape_string($email);
					$year_sql = mysql_real_escape_string($bug);
					if($stmt->execute()) {
						$msg["result"] = true;
						$content .= "Inserimento del bug $name effettuato con successo.";
						$msg["id"] = $conn->insert_id;
					} else {
						$msg["data"] = $conn->error_list;
						$content .= "Riscontrato problema nell'inserimento del bug $name, contattare il supporto.";
					}
				}
			}
		} catch (Exception $e) {
			// Posso effettuare un rollback di tutte le query fatte finora sul db.
			$msg["error"] = "Eccezione";
			$msg["msg"] = $e;
		}

		$msg["content"] = $content;
		return $msg;
	}
	
	function change_state_bug($id, $state) {
		$msg = array();
		$msg["result"] = false;
		$msg["error"] = "nothing";
		$content = "";
		try {
			$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
			if($conn->connect_error){
				$msg["error"] = "Connection Error";
			} else {
				$query = "update bug_reports set State = ? where Id = ?";
				$stmt = $conn->prepare($query);
				if(!$stmt) {
					$msg["data"] = $conn->error_list;
					$msg["error"] = "Boolean value in \$stmt";
				} else {
					$stmt->bind_param("ii", $id_sql, $state_sql);
					$id_sql = mysql_real_escape_string($id);
					$state_sql = mysql_real_escape_string($state);
					if($stmt->execute()) {
						$msg["result"] = true;
						$content .= "Cambiamento del bug $id effettuato con successo.";
						$msg["id"] = $conn->insert_id;
					} else {
						$msg["data"] = $conn->error_list;
						$content .= "Riscontrato problema nel cambiamento del bug $id, contattare il supporto.";
					}
				}
			}
		} catch (Exception $e) {
			// Posso effettuare un rollback di tutte le query fatte finora sul db.
			$msg["error"] = "Eccezione";
			$msg["msg"] = $e;
		}

		$msg["content"] = $content;
		return $msg;
	}
	
	function get_bug_by_id($id) {
		return "This bug by $id";
	}
	
	function get_bug_list() {
		return "This bug list.";
	}
	
	function get_bug_state_list(){
		return "Ahah";
	}
?>