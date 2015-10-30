<table>
    <tr>
        <td class="TextControl">BU :</td>
        <td><?php echo $BU ?></td>
        <td class="TextControl">Level :</td>
        <td><?php echo $level ?></td>
        <td class="TextControl">Area :</td>
        <td id="area"><select class="TextControl"><?php ?></select></td>
        <td class="TextControl">Rep :</td>
        <td id="rep"><select class="TextControl"><?php ?></select></td>
    </tr>
    <tr>
        <td></td>
        <td><select></select></td>
        <td></td>
        <td><select></select></td>
        <td></td>
        <td><select></select></td>
        <td></td>
        <td class="TextControl"><input name="bntShowReort" type="button" class="Btnadd" value="SHOW" id="showdoctor"  width="30"></td>
    </tr>
</table>
<div id="result"></div>
<script>
    $("#id").change(function () {
        var level = $(this).val();
        var level_up = $('#div_id').val();
        var dataString = 'level=' + level + '&level_up=' + level_up;
        var url = '<?php echo site_url(); ?>' + '/Reports/processLocationRequest';
        sendRequest(dataString, '#area', url);
    });

    $("td").delegate("#ter_id", "change", function () {
        // $("#ter_id").change(function () {
        var ter_id = $(this).val();
        alert();
        var dataString = 'ter_id=' + ter_id;
        var url = '<?php echo site_url(); ?>' + '/Reports/getTM';
        sendRequest(dataString, '#rep', url);

    });

    $("#showdoctor").click(function () {
        var tm_id = $("#tm_id").val();
        var dataString = 'tm_id=' + tm_id;
        var url = '<?php echo site_url(); ?>' + '/Reports/getDoctor';
        sendRequest(dataString, '#result', url);
    });

    function sendRequest(dataString, container_id, url) {
        alert();
        console.log(dataString);
        console.log(container_id);
        console.log(url);

        var data = dataString;
        $("#img").show();
        $.ajax({
            //Send request

            type: 'get',
            data: data,
            url: url,
            success: function (data) {
                $(container_id).html(data);
            }
        });
    }
</script>
