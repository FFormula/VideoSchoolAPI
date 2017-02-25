{include file="head.tpl"}

<div class="container">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">{$lang->word("user.Register new User")}</h3>
        </div>
        <form class="form-horizontal" method="post" onsubmit="
    if (document.getElementById('phone_id').value.substr(0, 2) != '+7' ||
        document.getElementById('phone_id').value.length < 10)
    {
        alert ('{$lang->word("user.enter phone digits")}');
        document.getElementById('phone_id').focus();
        return false;
    }
    return true;">
            <div class="panel-body">
                {$lang->word("Hello")}
            {if $err}
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">{$err}</h3>
                    </div>
                </div>
            {/if}
                <div class="form-group">
                    <label class="col-md-2 control-label">{$lang->word("user.Park")}:</label>
                    <div class="col-md-10"><input type="text" name="park" class="form-control" value="{$arr.park}" /></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">{$lang->word("user.Name")}:</label>
                    <div class="col-md-10"><input type="text" name="name" class="form-control" value="{$arr.name}" /></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">{$lang->word("user.Phone")}:</label>
                    <div class="col-md-10"><input type="text" id="phone_id" name="phone" class="form-control" value="{$arr.phone}" placeholder="+79000000000" /></div>
                </div>
            </div>
            <div class="panel-body bg-warning">
                <div class="form-group">
                    <label class="col-md-2 control-label">{$lang->word("user.E-mail")}:</label>
                    <div class="col-md-10"><input type="email" name="email" class="form-control" value="{$arr.email}" /></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">{$lang->word("user.Password")}:</label>
                    <div class="col-md-10"><input type="text" name="password" class="form-control"  value="" /></div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-5 col-md-7">
                        <div class="col-md-2 text-center">
                            <button type="submit" title="{$lang->word("user.Add user")}" class="btn btn-primary" />
                                <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;{$lang->word("user.Add user")}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{include file="tail.tpl"}



