<?php echo validation_errors(); ?>

<?php echo form_open('Employee/add_details') ?>

<div class="col-lg-12 ">
    <h3 class="page-header">Enter Employee Detail</h3>
    <div class="panel">
        <div class="panel-body">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php
                    if (isset($user['name'])) {
                        echo $user['name'];
                    }
                    ?>" >
                </div>
                <div class="form-group">
                    <label class="control-label">Type</label>
                    <input type="text" name="type" class="form-control" value="<?php
                    if (isset($user['type'])) {
                        echo $user['type'];
                    }
                    ?>" >
                </div>

                <div class="form-group">
                    <label class="control-label">Industry Type</label>
                    <select class="form-control" name="industry_type"><?php echo $industry ?></select>
                </div>
                <div class="form-group">
                    <label class="control-label">Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" value="<?php
                    if (isset($user['contact_person'])) {
                        echo $user['contact_person'];
                    }
                    ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Address</label>
                    <textarea type="text" name="address1" class="form-control" ><?php
                        if (isset($user['address1'])) {
                            echo $user['address1'];
                        }
                        ?>
                    </textarea>
                </div>

                <div class="form-group">
                    <label class="control-label">Pincode</label>
                    <input type="text" name="pincode" class="form-control"  id="pincode"value="<?php
                    if (isset($user['pincode'])) {
                        echo $user['pincode'];
                    }
                    ?>">

                    <img src="../../assets/images/38-1.gif" id="img" style="display: none"/>
                </div>
                <div class="form-group">
                    <label class="control-label">State </label>
                    <input type="text" name="state" class="form-control" id="state" value="<?php
                    if (isset($user['state'])) {
                        echo $user['state'];
                    }
                    ?>">

                </div>
                <div class="form-group">
                    <label class="control-label">City </label>
                    <input type="text" name="city" class="form-control"  id="city" value="<?php
                    if (isset($user['city'])) {
                        echo $user['city'];
                    }
                    ?>">
                </div>
            </div>
            <input type="hidden" name="auth_id" class="form-control" value="<?php echo $user_id; ?> " >

        </div>




        <div class="panel-footer">
            <div class="form-group">

                <input type="submit" value="Register" class="btn btn-primary" />
            </div>
        </div>
    </div>

</div>
</div>
</form>
<script>
    jQuery(function () {

        var typingTimer; //timer identifier
        var doneTypingInterval = 1000;
        jQuery("#pincode ").keyup(function () {
            clearTimeout(typingTimer);
            if ($(this).val) {
                $(".mask").show();

                typingTimer = setTimeout(function () {
                    if ($("#pincode").val().length == 6) {

                        var search_term = $("#pincode").val();
                        var dataString = 'pincode=' + search_term;
                        sendRequest(dataString);
                    }


                }, doneTypingInterval);
            }

        });
    });
    function sendRequest(dataString) {

        var data = dataString;
        $("#img").show();
        $.ajax({
            //Send request

            type: 'get',
            data: data,
            url: '<?php echo site_url(); ?>/Employee/add_pincode',
            success: function (data) {

                var json = JSON.parse(data);
                $("#state").val(json[0].State);
                $("#city").val(json[0].District);
                $("#img").hide();

            }
        });
    }

</script>
