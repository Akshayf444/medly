

<h2 align="center">Enter Employee Detail</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('Employee/register') ?>
<div align="center">
    <label>Email</label>
    <input type="text" name="email"/>
    <label>Password</label>
    <input type="text" name="password"/>
    <label>mobile</label>
    <input type="text" name="mobile"/>
    <input type="submit" value="Register" />
    </div>

</form>