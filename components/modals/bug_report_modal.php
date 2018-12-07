<div class="message-box animated fadeIn" data-sound="alert" id="mb-bugreport">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><i class="fa fa-bug" aria-hidden="true"></i> Report a <strong>bug</strong>!</div>
            <div class="mb-content">
                <p>We can improve only with cooperation!</p>                    
                <p>Press Send when you are ready to send a bug report. We'll notificate with an email when the bug will be resolved.</p>
                <p></p>
                <div id="log_bug_report"><!--
                    Name
                    --><div class="form-group">
                        <label for="Name" class="col-md-3 control-label">Name*: </label>
                        <div class="col-md-9">
                            <input id="Name" name="Name" type="text" class="form-control add-item" placeholder="Name" />
                        </div>
                    </div><!--
                    Email
                    --><div class="form-group">
                        <label for="Email" class="col-md-3 control-label">Email*:</label>
                        <div class="col-md-9">
                            <input id="Email" name="Email" type="text" class="form-control add-item" placeholder="Email" />
                        </div>
                    </div><!--
                    Bug Explanation
                    --><div class="form-group">
                        <label for="BugExplation" class="col-md-3 control-label">Bug explation*:</label>
                        <div class="col-md-9">
                            <textarea id="BugExplation" name="BugExplation" type="text" class="form-control add-item" placeholder="Bug explation" maxlength="1000"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-footer">
                <div class="pull-right" id="log_bug_report_buttons">
                    <button id="new-bug" type="submit" class="btn btn-success btn-lg" value="Send">Send</button>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#new-bug").on("click", function (e) {
                        e.preventDefault();
                        var string_data = "name=" + $("#Name").val() + "&email=" + $("#Email").val() + "&bug=" + $("#BugExplation").val();
                        var dialog = $("#mb-bugreport");
                        new_bug(string_data, dialog);
                    });
                });
            </script>
        </div>
    </div>
</div>