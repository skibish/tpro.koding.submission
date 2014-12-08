<?o()?>
<div class="authBox">
    <div class="header">Authorization</div>
    <form action="<?=$this->go()?>" method="POST">
        <table class="authentication" cellpadding="0" cellspacing="0">
            <tr>
                <td align="right" colspan="3" style="padding-right: 20px;">
                    <a href="javascript:void(0)" class="forgotPass">
                        Forgot password?
                    </a>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <span class="label">Login:</span>
                </td>
                <td colspan="2" style="padding-right: 24px;">
                    <input type="text" name="login" class="field login">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <span class="label">Password:</span>
                </td>
                <td colspan="2" style="padding-right: 24px;">
                    <input type="password" name="password" class="field password">
                </td>
            </tr>
            <tr>
                <td><?//=$this->scope->auth->getCurrentUser()?></td>
                <td>
                    <a href="javascript:void(0)" class="button" style="float: left; margin-right: 14px;">Registration</a>
                </td>
                <td>
                    <input type="submit" class="button" style="float: right; margin-right: 14px; border: none; cursor: pointer;" value="Enter">
                </td>
            </tr>
        </table>
    </form>
</div>