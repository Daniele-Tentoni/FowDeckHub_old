<!-- START BUG REPORTS WIDGET SLIDER -->
<div class="widget widget-default widget-carousel">
    <div class="owl-carousel" id="owl-example">
		<?php
		// Faccio una query unica per caricare tutti i numeri degli stati dei bug.
		$query = "select bs.Name, Number
                    from bug_report_states bs
                    left join (select s.Name as State, count(*) as Number
                            from bug_report_states s 
                            join bug_reports b on b.BugState = s.Id
                            group by s.Name
                            order by s.Ordine
                         ) as Stati
                     on bs.Name = Stati.State";

		$stmt = $mysqli->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                $number = $row["Number"] > 0 ? $row["Number"] : 0;
				echo "<div>";
				echo "	<div class=\"widget-title\">" . $row["Name"] . "</div>";
				echo "	<div class=\"widget-subtitle\">Bug Number</div>";
				echo "	<div class=\"widget-int\">" . $number . "</div>";
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