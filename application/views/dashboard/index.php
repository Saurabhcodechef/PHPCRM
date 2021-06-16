<style>
    body {
        background-image: url("<?= base_url() . 'assets/img/bg1.jpg' ?>")
    }

    .shadow {
        background-image: url("<?= base_url() . 'assets/img/bg.jpg' ?>")
    }

    #userForm {
        margin-top: 20%;
        border-radius: 18px;
        padding-bottom: 20px;

    }

    #loginhead {
        height: 40px;
        width: 150px;
        position: relative;
        top: -20px;
        font-size: 27px;
        border-radius: 18px;
        left: 75px;

    }

    .form-control {
        border-radius: 18px;
    }
</style>

<div class="col-md-9">
    <div id="userForm" class="col-md-4 shadow offset-md-5 ">
        <?php echo form_open('usermaster/login') ?>
        <div id="loginhead" class="form-group bg-primary text-center">
            Login
        </div>
        <div class="form-group mb-3">
            <?php echo form_error('email') ?>
            <input type="text" id="email" class="form-control" value="<?php echo set_value('email'); ?>" name="email" placeholder="enter your email">
        </div>
        <div class="form-group mb-3">
            <?php echo form_error('password') ?>
            <input type="password" id="pass" class="form-control" name="password" placeholder="Enter your password">
        </div>
        <div class="form-group row mb-3">
            <button id="submit" class="col-md-3 offset-md-3 btn btn-primary" name="submit">Login</button>
            <div class="form-check mt-2 col-md-6">
                <input id="showpass" type="checkbox" class="form-check-input" id="submit">
                <label class="form-check-label ml-4" for="submit">Show Password</label>
            </div>
        </div>
        <div class="form-group text-right" style="margin-top:10px;">
            <a href="#" class=" alert text-primary">
                <span class="badge badge-info">New User</span>
                Create Account</a>
        </div>
        </form>
    </div>
</div>
<script>
    setTimeout(function() {
        $(".error").hide();
    }, 3000);
</script>
<script src="<?php echo base_url() . 'assets/js/user.js' ?>">