<!-- START BUG REPORTS WIDGET SLIDER -->
<div class="widget widget-default widget-carousel">
    <div class="owl-carousel" id="owl-example">
	
		<?php
		// Faccio una query unica per caricare tutti i numeri degli stati dei bug.
		$query = "select s.Name as State, count(*) as Numero
				from bug_reports b
				join bug_report_states s on b.State = s.Id
				order by b.Id";

		$stmt = $conn->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<div>";
				echo "	<div class=\"widget-title\">" . $row["Stato"] . "</div>";
				echo "	<div class=\"widget-subtitle\">Bug Reports Number</div>";
				echo "	<div class=\"widget-int\">" . $row["Numero"] . "</div>";
				echo "</div>";
			}
		} else {
			echo "<div>No data to view.</div>";
		}
		?>
        
    </div>                            
    <div class="widget-controls">                                
        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
    </div>                             
</div>        
<!-- END WIDGET SLIDER -->