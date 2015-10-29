<table border="0" align="center">
    <tr>
        <td class="Caption10">BU :<?php echo $BU; ?></td>
        <td class="Caption10">Parent Level :<?php echo $parent_level; ?></td>
    </tr>
    <tr>
        <td class="Caption10">Parent Location : <span id="parent_loc"></span></td>
    </tr>
    <tr>
        <td align="center" colspan="4">
            <table>
                <tr>
                    <td><input type="button" id="show" value="Show"></td>
                    <td><input type="reset" id="clear" value="Clear"></td>
                    <td><input type="reset" class="excel" id="clear" value="Excel"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<div id="loadingarea">

</div>
<script>
    $("#parent_level").change(function () {
        var level = $(this).val();
        var level_up = $('#div_id').val();
        var dataString = 'level=' + level + '&level_up=' + level_up;
        var url = '<?php echo site_url(); ?>' + '/Master/processRequest';
        sendRequest(dataString, '#parent_loc', url);
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

    $("#show").click(function () {
        var level = $("#parent_level").val();
        var level_up = $('#div_id').val();
        var level_up_up;
        if (level == 1) {
            level_up_up = $("#country").val();
        } else if (level == 2) {
            level_up_up = $("#zone").val();
        } else if (level == 3) {
            level_up_up = $("#region").val();
        } else if (level == 4) {
            level_up_up = $("#area").val();
        } else if (level == 5) {
            level_up_up = $("#terrtory").val();
        }

        alert(level_up_up);
        var dataString = 'level=' + level + '&level_up=' + level_up + '&level_up_up=' + level_up_up;
        var url = '<?php echo site_url(); ?>' + '/Master/processLocationViewRequest';
        sendRequest(dataString, '#loadingarea', url);
    });
</script>