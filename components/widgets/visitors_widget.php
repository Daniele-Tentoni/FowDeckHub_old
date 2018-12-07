<!-- START VISITORS WIDGET SLIDER -->
<div class="widget widget-default widget-carousel">
    <div class="owl-carousel" id="owl-example">
        <div>
            <div class="widget-title">Total Visitors</div>
            <div class="widget-subtitle"><?php echo date("H:i:s"); ?></div>
            <div class="widget-int">
                <?php
                // Recupero il timestamp
                $now = time();
                // Recupero il numero di tutti i login effettuari nell'ultimo giorno.
                $valid_attempts = $now - (24 * 60 * 60); 
                if ($stmt = $mysqli->prepare("SELECT COUNT(*) as 'Count' FROM login_attempts WHERE dataaccesso > '$valid_attempts' AND Risultato = 1")) {
                    // Eseguo la query creata.
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($count);
                    $stmt->fetch();
                    echo $count;
                } else {
                    echo "cinque";
                }
                ?>
            </div>
        </div>
        <div>
            <div class="widget-title">Month</div>
            <div class="widget-subtitle">Visitors</div>
            <div class="widget-int">
                <?php
                // Recupero il timestamp
                $now = time();
                // Recupero il numero di tutti i login effettuari nell'ultimo mese.
                $valid_attempts = $now - (30 * 24 * 60 * 60); 
                if ($stmt = $mysqli->prepare("SELECT COUNT(*) as 'Count' FROM login_attempts WHERE dataaccesso > '$valid_attempts' AND Risultato = 1")) {
                    // Eseguo la query creata.
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($count);
                    $stmt->fetch();
                    echo $count;
                } else {
                    echo "cinque";
                }
                ?>
            </div>
        </div>
        <div>                                    
            <div class="widget-title">Today</div>
            <div class="widget-subtitle">Visitors</div>
            <div class="widget-int">
                <?php
                // Recupero il numero totale di tutti i visitatori.
                if ($stmt = $mysqli->prepare("SELECT COUNT(*) as 'Count' FROM login_attempts WHERE Risultato = 1")) { 
                    // Eseguo la query creata.
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($count);
                    $stmt->fetch();
                    echo $count;
                } else {
                    echo "cinque";
                }
                ?>
            </div>
        </div>
    </div>                            
    <div class="widget-controls">                                
        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
    </div>                             
</div>  
<!-- END WIDGET SLIDER -->