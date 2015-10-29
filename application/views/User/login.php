<div class="row">
    <div class="col-lg-4 col-lg-offset-8 panel signin">
        <h3 class="page-header">Sign In</h3>

        <?php echo validation_errors(); ?>
        <?php echo isset($error) ? $error : ''; ?>
        <?php echo form_open('User/login') ?>
        <div class="form-group">
            <label class="control-label">Code</label>
            <input type="text" class="form-control input-lg" name="code"/>
        </div>
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" class="form-control input-lg" name="repname"/>
        </div>
        <div class="form-group">
            <label class="control-label">Password</label>
            <input type="text" class="form-control input-lg" name="password"/>
        </div>
        <input type="submit" class="btn btn-info btn-lg" value="Log In" />

        </form>
    </div>
</div>